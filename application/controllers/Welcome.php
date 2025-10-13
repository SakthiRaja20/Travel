<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public $db;
    public $session;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('index');
    }

    public function result() {
        $this->load->view('result');
    }

    public function book() {
        // Get query parameters
        $hotel_id = $this->input->get('hotel_id');
        $city = $this->input->get('city');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $guests = $this->input->get('guests');

        // Pass them to the view
        $data = array(
            'hotel_id' => $hotel_id,
            'city' => $city,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'guests' => $guests
        );

        $this->load->view('book', $data);
    }

    public function order() {
        $this->load->view('order');
    }

    public function destinations() {
        $this->load->view('destinations');
    }

    public function hotelAmenities() {
        header('Content-Type: application/json');
        try {
            $inputData = json_decode(file_get_contents('php://input'), true);
            if (!isset($inputData['city'])) {
                throw new Exception("City is required");
            }
            $city = $inputData['city'];
            
            $query = "SELECT services FROM hotels WHERE city = ?";
            $result = $this->db->query($query, array($city))->result_array();

            if ($result) {
                echo json_encode([$result]);
            } else {
                echo json_encode(["status" => "error", "message" => "No amenities found for the given city"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function hotels() {
        header('Content-Type: application/json');
        try {
            $inputData = json_decode(file_get_contents('php://input'), true);
            if (empty($inputData['city'])) {
                throw new Exception("City is required");
            }
            
            $amenities = isset($inputData['amenities']) ? $inputData['amenities'] : [];
            $price = isset($inputData['price']) ? $inputData['price'] : [];
            $rate = isset($inputData['rating']) ? $inputData['rating'] : [];
            $city = $inputData['city'];

            $query = "SELECT * FROM hotels WHERE city = ?";
            $queryParams = [$city];

            if (!empty($amenities)) {
                $likeConditions = [];
                foreach($amenities as $amenity) {
                    $likeConditions[] = "services LIKE ?";
                    $queryParams[] = '%'. $amenity .'%';
                }
                $query .= " AND (" . implode(" AND ", $likeConditions) . ")";
            }

            if (!empty($price)) {
                $query .= " AND mrp <= ?";
                $queryParams[] = $price;
            }

            $result = $this->db->query($query, $queryParams)->result_array();
            echo json_encode([$result]);
            
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getHotelRooms() {
        header('Content-Type: application/json');
        try {
            // Try to get ID from request body first
            $inputData = json_decode(file_get_contents('php://input'), true);
            $id = isset($inputData['id']) ? $inputData['id'] : null;
            
            // If not in request body, try GET parameter
            if (!$id) {
                $id = $this->input->get('id');
            }

            if (!$id) {
                throw new Exception("Hotel ID is required");
            }

            $query = "SELECT * FROM rooms WHERE hotel_id = ?";
            $result = $this->db->query($query, array($id))->result_array();

            if ($result) {
                echo json_encode([$result]);
            } else {
                echo json_encode(["status" => "error", "message" => "No rooms found"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function bookRoom() {
        header('Content-Type: application/json');
        try {
            error_log("🔵 Starting bookRoom function");
            
            // Check if user is logged in
            $userData = $this->session->userdata('userdata');
            if (!$userData) {
                throw new Exception("User must be logged in to book a room");
            }
            
            $rawInput = file_get_contents('php://input');
            error_log("📥 Raw input: " . $rawInput);
            
            $inputData = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("JSON decode error: " . json_last_error_msg());
            }

            // Add user data from session
            $inputData['userID'] = $userData['id'];
            $inputData['bookingName'] = $userData['name'];
            $inputData['bookingEmail'] = $userData['email'] ?? '';  // You might need to add email to your users table
            $inputData['bookingPhone'] = $userData['mobile'];

            // Extract and validate required fields
            $requiredFields = ['hotelID', 'roomId', 'hotelName', 'roomType', 'startDate', 
                             'endDate', 'price', 'peopleValue', 'discount', 'nights'];
            
            foreach ($requiredFields as $field) {
                if (!isset($inputData[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            // Start transaction
            $this->db->trans_start();

            // Check room availability
            $roomQuery = "SELECT * FROM rooms WHERE id = ? AND hotel_id = ? AND available_rooms > 0 FOR UPDATE";
            $roomResult = $this->db->query($roomQuery, [
                $inputData['roomId'], 
                $inputData['hotelID']
            ]);
            
            if ($roomResult->num_rows() == 0) {
                throw new Exception("Room not available or does not exist");
            }

            // Insert booking
            $query = "INSERT INTO book (
                hotelID, room_id, hotelName, room_type, startDate, endDate, 
                userID, price, peopleValue, nights, discount, 
                bookingName, bookingEmail, bookingPhone
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $params = [
                $inputData['hotelID'],
                $inputData['roomId'],
                $inputData['hotelName'],
                $inputData['roomType'],
                $inputData['startDate'],
                $inputData['endDate'],
                $inputData['userID'],
                $inputData['price'],
                $inputData['peopleValue'],
                $inputData['nights'],
                $inputData['discount'],
                $inputData['bookingName'],
                $inputData['bookingEmail'],
                $inputData['bookingPhone']
            ];
            
            $result = $this->db->query($query, $params);
            if (!$result) {
                throw new Exception("Failed to create booking");
            }

            // Update room availability
            $updateQuery = "UPDATE rooms SET available_rooms = available_rooms - 1 
                          WHERE id = ? AND available_rooms > 0";
            $updateResult = $this->db->query($updateQuery, [$inputData['roomId']]);
            
            if (!$updateResult || $this->db->affected_rows() == 0) {
                throw new Exception("Failed to update room availability");
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception("Transaction failed");
            }

            echo json_encode([
                "status" => "success",
                "message" => "Booking successful! {$inputData['roomType']} reserved for {$inputData['nights']} night(s)."
            ]);

        } catch (Exception $e) {
            error_log("❌ Error in bookRoom: " . $e->getMessage());
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }
            echo json_encode([
                "status" => "error",
                "message" => "Booking failed: " . $e->getMessage()
            ]);
        }
    }

    public function hotelBooking() {
        header('Content-Type: application/json');
        try {
            $inputData = json_decode(file_get_contents('php://input'), true);
            if (!isset($inputData['id'])) {
                throw new Exception("User ID is required");
            }
            
            $query = "SELECT b.*, h.*, r.room_type, r.capacity, r.amenities, r.images as room_images 
                     FROM `book` as b 
                     INNER JOIN hotels as h ON b.hotelID = h.id 
                     INNER JOIN rooms as r ON b.room_id = r.id 
                     WHERE b.userID = ? 
                     ORDER BY b.id DESC";
                     
            $result = $this->db->query($query, array($inputData['id']))->result_array();

            if ($result) {
                echo json_encode([$result]);
            } else {
                echo json_encode(["status" => "error", "message" => "No booking found"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function hotelFind() {
        header('Content-Type: application/json');
        try {
            // Try to get ID from request body first
            $inputData = json_decode(file_get_contents('php://input'), true);
            $id = isset($inputData['id']) ? $inputData['id'] : null;
            
            // If not in request body, try GET parameter
            if (!$id) {
                $id = $this->input->get('id');
            }
            
            if (!$id) {
                throw new Exception("Hotel ID is required");
            }
            
            $query = "SELECT * FROM hotels WHERE id = ?";
            $result = $this->db->query($query, array($id))->result_array();

            if ($result) {
                echo json_encode([$result]);
            } else {
                echo json_encode(["status" => "error", "message" => "Hotel not found"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}