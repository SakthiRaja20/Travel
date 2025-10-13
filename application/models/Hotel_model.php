<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hotel Model - FIXED VERSION
 * Handles hotel and room data operations with case-insensitive city search
 */
class Hotel_model extends CI_Model {
    
    /**
     * Find hotel by ID (used in booking page)
     * @param int $hotelId - Hotel ID
     * @return array - Hotel details or error
     */
    public function find_hotel_by_id($hotelId) {
        if (!is_numeric($hotelId) || $hotelId < 1) {
            return ["status" => "error", "message" => "Invalid hotel ID"];
        }

        $query = "SELECT * FROM hotels WHERE id = ?";
        $result = $this->db->query($query, [$hotelId]);

        if ($result->num_rows() == 0) {
            return [
                "status" => "error",
                "message" => "Hotel not found",
                "hotelId" => $hotelId
            ];
        }

        return [
            "status" => "success",
            "hotels" => $result->result_array()
        ];
    }

    /**
     * Find hotels by ID and city (original hotelFind endpoint)
     * Now with case-insensitive city matching
     * @param int $id - Hotel ID
     * @param string $city - City name
     * @return array - Hotel details or error
     */
    public function find_hotel($id, $city = '') {
        if (!is_numeric($id) || $id < 1) {
            return ["status" => "error", "message" => "Invalid hotel ID"];
        }

        $query = "SELECT * FROM hotels WHERE id = ?";
        $params = [$id];

        // If city is provided, add case-insensitive city filter
        if (!empty($city)) {
            $query .= " AND LOWER(city) = LOWER(?)";
            $params[] = trim($city);
        }

        $result = $this->db->query($query, $params);

        if ($result->num_rows() == 0) {
            return [
                "status" => "error",
                "message" => "Hotel not found",
                "debug" => [
                    "hotelId" => $id,
                    "city" => $city
                ]
            ];
        }

        return [
            "status" => "success",
            "hotels" => $result->result_array()
        ];
    }
    
    /**
     * Update room availability after booking
     * Uses database transactions and row locking for data consistency
     */
    public function update_room_availability($hotelId, $roomId, $roomsNeeded) {
        // Validate input parameters
        if (!$this->validate_ids($hotelId, $roomId)) {
            return $this->error_response("Invalid hotel or room ID");
        }
        
        if (!is_numeric($roomsNeeded) || $roomsNeeded < 1) {
            return $this->error_response("Rooms needed must be a positive number");
        }
        
        // Start transaction
        $this->db->trans_start();
        
        try {
            // Get current room availability with row lock
            $query = "SELECT r.*, h.name as hotel_name 
                     FROM rooms r 
                     INNER JOIN hotels h ON r.hotel_id = h.id 
                     WHERE r.id = ? AND r.hotel_id = ? 
                     FOR UPDATE";
            $result = $this->db->query($query, [$roomId, $hotelId]);
            
            if ($result->num_rows() == 0) {
                $this->db->trans_rollback();
                return $this->error_response("Room not found for the specified hotel");
            }
            
            $roomData = $result->row();
            $availableRooms = intval($roomData->available_rooms);
            
            // Validate available rooms
            if ($availableRooms < $roomsNeeded) {
                $this->db->trans_rollback();
                return $this->error_response(
                    "Not enough rooms available. Only {$availableRooms} rooms of this type left.",
                    "insufficient_rooms",
                    ["available" => $availableRooms, "requested" => $roomsNeeded]
                );
            }
            
            // Update room availability
            $updateQuery = "UPDATE rooms 
                           SET available_rooms = available_rooms - ?,
                               updated_at = NOW()
                           WHERE id = ? AND hotel_id = ? AND available_rooms >= ?";
            $this->db->query($updateQuery, [$roomsNeeded, $roomId, $hotelId, $roomsNeeded]);
            
            if ($this->db->affected_rows() == 0) {
                $this->db->trans_rollback();
                return $this->error_response("Failed to update room availability. Please try again.");
            }
            
            // Complete transaction
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                return $this->error_response("Database transaction failed");
            }
            
            return $this->success_response([
                "rooms_reserved" => $roomsNeeded,
                "room_type" => $roomData->room_type,
                "hotel_name" => $roomData->hotel_name,
                "previous_available" => $availableRooms,
                "remaining_available" => $availableRooms - $roomsNeeded
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Room availability update error: ' . $e->getMessage());
            return $this->error_response("An error occurred while updating room availability");
        }
    }
    
    /**
     * Get available rooms for a hotel
     */
    public function get_room_availability($hotelId, $filters = []) {
        if (!is_numeric($hotelId) || $hotelId < 1) {
            return $this->error_response("Invalid hotel ID");
        }
        
        $query = "SELECT r.*, h.name as hotel_name 
                 FROM rooms r 
                 INNER JOIN hotels h ON r.hotel_id = h.id 
                 WHERE r.hotel_id = ? 
                 AND r.available_rooms > 0";
        
        $params = [$hotelId];
        
        // Add optional filters
        if (!empty($filters['room_type'])) {
            $query .= " AND r.room_type = ?";
            $params[] = $filters['room_type'];
        }
        
        if (!empty($filters['min_price'])) {
            $query .= " AND r.price_per_night >= ?";
            $params[] = floatval($filters['min_price']);
        }
        
        if (!empty($filters['max_price'])) {
            $query .= " AND r.price_per_night <= ?";
            $params[] = floatval($filters['max_price']);
        }
        
        $query .= " ORDER BY r.price_per_night ASC";
        
        $result = $this->db->query($query, $params);
        
        if ($result->num_rows() == 0) {
            return $this->error_response("No available rooms found");
        }
        
        return $this->success_response([
            "rooms" => $result->result_array(),
            "count" => $result->num_rows()
        ]);
    }

    /**
     * Get hotels with room information, optionally filtered by city (CASE-INSENSITIVE)
     */
    public function get_hotels_with_rooms($city = null, $checkIn = null, $checkOut = null) {
        $query = "SELECT h.*, 
                        (SELECT SUM(available_rooms) 
                         FROM rooms 
                         WHERE hotel_id = h.id) as total_available_rooms,
                        (SELECT GROUP_CONCAT(CONCAT(room_type, ' (', available_rooms, ' left)'))
                         FROM rooms 
                         WHERE hotel_id = h.id AND available_rooms > 0) as room_availability
                 FROM hotels h
                 WHERE h.is_active = 1 OR h.is_active IS NULL";
        
        $queryParams = [];
        
        // Add CASE-INSENSITIVE city filter
        if (!empty($city)) {
            $city = trim($city);
            if (strlen($city) < 2 || strlen($city) > 100) {
                return $this->error_response("Invalid city name");
            }
            $query .= " AND LOWER(h.city) = LOWER(?)";
            $queryParams[] = $city;
        }
        
        $query .= " ORDER BY h.rate DESC, h.name ASC";
        
        $result = $this->db->query($query, $queryParams);
        
        if ($result->num_rows() == 0) {
            return $this->error_response("No hotels found");
        }
        
        $hotels = $result->result_array();
        $hotels = $this->process_hotel_results($hotels);
        
        if (empty($hotels)) {
            return $this->error_response("No valid hotel data found");
        }
        
        return $this->success_response([
            "hotels" => $hotels,
            "count" => count($hotels)
        ]);
    }

    /**
     * Process hotel results - format and validate data
     */
    private function process_hotel_results($hotels) {
        $processed = [];
        
        foreach ($hotels as $hotel) {
            $total_rooms = intval($hotel['total_available_rooms']) ?: 0;
            
            $processed_hotel = [
                'id' => intval($hotel['id']),
                'name' => htmlspecialchars($hotel['name'], ENT_QUOTES, 'UTF-8'),
                'city' => htmlspecialchars($hotel['city'], ENT_QUOTES, 'UTF-8'),
                'address' => htmlspecialchars($hotel['location'] ?? '', ENT_QUOTES, 'UTF-8'),
                'location' => htmlspecialchars($hotel['location'] ?? '', ENT_QUOTES, 'UTF-8'),
                'rate' => floatval($hotel['rate']),
                'mrp' => floatval($hotel['mrp']),
                'discount' => floatval($hotel['discount'] ?? 0),
                'description' => htmlspecialchars($hotel['description'] ?? '', ENT_QUOTES, 'UTF-8'),
                'services' => $hotel['services'],
                'poster' => $hotel['poster'],
                'room_andHotelImages' => $hotel['room_andHotelImages'],
                'total_available_rooms' => $total_rooms,
                'rooms' => $total_rooms,
                'room_details' => $hotel['room_availability'],
                'rooms_detail' => $this->format_room_availability($hotel['room_availability'])
            ];
            
            $processed[] = $processed_hotel;
        }
        
        return $processed;
    }

    /**
     * Format room availability string
     */
    private function format_room_availability($roomAvailability) {
        if (empty($roomAvailability)) {
            return 'No rooms available';
        }
        
        return htmlspecialchars($roomAvailability, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate numeric IDs
     */
    private function validate_ids($hotelId, $roomId) {
        return is_numeric($hotelId) && is_numeric($roomId) && 
               $hotelId > 0 && $roomId > 0;
    }

    /**
     * Generate success response
     */
    private function success_response($data) {
        return [
            "status" => "success",
            "data" => $data,
            "timestamp" => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Generate error response
     */
    private function error_response($message, $code = "error", $details = []) {
        return [
            "status" => "error",
            "message" => $message,
            "code" => $code,
            "details" => $details,
            "timestamp" => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Get all rooms for a hotel
     */
    public function get_hotel_rooms($hotelId) {
        if (!is_numeric($hotelId) || $hotelId < 1) {
            return $this->error_response("Invalid hotel ID");
        }
        
        $query = "SELECT r.* 
                 FROM rooms r
                 WHERE r.hotel_id = ?
                 ORDER BY r.room_type ASC, r.price_per_night ASC";
        
        $result = $this->db->query($query, [$hotelId]);
        
        if ($result->num_rows() == 0) {
            return $this->error_response("No rooms found for this hotel");
        }
        
        return $this->success_response([
            "rooms" => $result->result_array(),
            "count" => $result->num_rows()
        ]);
    }
}