<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public $db;
    public $session;
    public $Hotel_model;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Hotel_model');
    }

    public function index() {
        $this->load->view('index');
    }

    public function result() {
        $this->load->view('result');
    }

    public function book() {
        // Log raw request data
        log_message('debug', 'Raw REQUEST: ' . json_encode($_REQUEST));
        log_message('debug', 'Raw GET: ' . json_encode($_GET));
        log_message('debug', 'Raw SERVER: ' . json_encode([
            'QUERY_STRING' => $_SERVER['QUERY_STRING'] ?? '',
            'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? '',
            'PATH_INFO' => $_SERVER['PATH_INFO'] ?? ''
        ]));

        // Parse URL manually to debug
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $parts = parse_url($uri);
        log_message('debug', 'Parsed URL parts: ' . json_encode($parts));

        // Get query parameters with proper names
        $hotel_id = $this->input->get('hotel_id');
        $city = $this->input->get('city');
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $guests = $this->input->get('guests');

        // Log each parameter individually
        log_message('debug', 'Individual parameters from input->get:');
        log_message('debug', 'hotel_id: ' . var_export($this->input->get('hotel_id'), true));
        log_message('debug', 'city: ' . var_export($this->input->get('city'), true));
        log_message('debug', 'checkin: ' . var_export($this->input->get('checkin'), true));
        log_message('debug', 'checkout: ' . var_export($this->input->get('checkout'), true));
        log_message('debug', 'guests: ' . var_export($this->input->get('guests'), true));

        // Also try alternative parameter names
        log_message('debug', 'Alternative parameter names:');
        log_message('debug', 'id: ' . var_export($this->input->get('id'), true));
        log_message('debug', 'start_date: ' . var_export($this->input->get('start_date'), true));
        log_message('debug', 'end_date: ' . var_export($this->input->get('end_date'), true));

        // Pass them to the view with consistent naming
        $data = array(
            'hotel_id' => $hotel_id,
            'city' => $city,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'guests' => $guests,
            'debug_request' => $_REQUEST,
            'debug_get' => $_GET,
            'debug_server' => $_SERVER
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
            // Log the raw input for debugging
            $rawInput = file_get_contents('php://input');
            log_message('debug', 'Raw amenities input: ' . $rawInput);

            $inputData = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON input: " . json_last_error_msg());
            }

            if (!isset($inputData['city'])) {
                throw new Exception("City parameter is required");
            }

            $city = trim($inputData['city']);
            if (empty($city)) {
                throw new Exception("City cannot be empty");
            }
            
            log_message('debug', 'Searching amenities for city: ' . $city);
            
            $query = "SELECT services FROM hotels WHERE city = ?";
            $result = $this->db->query($query, array($city))->result_array();
            
            log_message('debug', 'Query result: ' . json_encode($result));

            if (!empty($result)) {
                echo json_encode([$result]);
            } else {
                echo json_encode(["status" => "success", "data" => [], "message" => "No amenities found for " . $city]);
            }
        } catch (Exception $e) {
            log_message('error', 'Amenities error: ' . $e->getMessage());
            echo json_encode([
                "status" => "error",
                "message" => $e->getMessage(),
                "debug_info" => [
                    "error" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine()
                ]
            ]);
        }
    }

    public function hotelFind()
    {
        // Set headers first, before any output
        header('Content-Type: application/json');
        
        try {
            // Get the POST data
            $rawInput = file_get_contents('php://input');
            
            // Handle both POST data and query parameters
            if ($rawInput) {
                $inputData = json_decode($rawInput, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => "Invalid JSON input: " . json_last_error_msg()
                    ]);
                    return;
                }
            } else {
                // Try to get data from query parameters or POST
                $inputData = [];
                if ($this->input->get('id')) {
                    $inputData['id'] = $this->input->get('id');
                }
                if ($this->input->post('city')) {
                    $inputData['city'] = $this->input->post('city');
                }
                if ($this->input->post('amenities')) {
                    $inputData['amenities'] = $this->input->post('amenities');
                }
            }
            
            // Extract filter parameters
            $city = isset($inputData['city']) ? trim($inputData['city']) : null;
            $amenities = isset($inputData['amenities']) ? $inputData['amenities'] : [];
            $price = isset($inputData['price']) ? $inputData['price'] : '';
            $rating = isset($inputData['rating']) ? $inputData['rating'] : '';
            $hotelId = isset($inputData['id']) ? $inputData['id'] : null;
            
            log_message('debug', 'hotelFind called with - ID: ' . $hotelId . ', City: ' . $city);
            
            // Load the model
            $this->load->model('Hotel_model');
            
            // ===== CASE 1: Specific hotel by ID (for booking page) =====
            if ($hotelId) {
                $result = $this->Hotel_model->find_hotel($hotelId, $city);
                
                // Return the result directly (already has status and hotels array)
                echo json_encode($result);
                return;
            }
            
            // ===== CASE 2: Search hotels by city/filters (for results page) =====
            // Build query for search
            $query = "SELECT h.*, 
                     (SELECT COUNT(*) FROM rooms r WHERE r.hotel_id = h.id) as room_types,
                     (SELECT SUM(r.available_rooms) FROM rooms r WHERE r.hotel_id = h.id) as total_rooms,
                     (SELECT GROUP_CONCAT(CONCAT(r.room_type, ': ', r.available_rooms, ' available') SEPARATOR ', ')
                      FROM rooms r 
                      WHERE r.hotel_id = h.id AND r.available_rooms > 0) as room_details
                     FROM hotels h";
            
            $where = [];
            $params = [];
            
            // Add city filter if provided
            if ($city) {
                $where[] = "LOWER(h.city) = LOWER(?)";
                $params[] = $city;
            }
            
            if (!empty($where)) {
                $query .= " WHERE " . implode(" AND ", $where);
            }
            
            // Execute query
            $result = $this->db->query($query, $params);
            if ($result === FALSE) {
                throw new Exception("Database error: " . $this->db->error()['message']);
            }
            
            $hotels = $result->result_array();
            log_message('debug', 'Found ' . count($hotels) . ' hotels for city: ' . $city);
            
            // Apply additional filters (amenities, price, rating)
            if (!empty($amenities) || $price || $rating) {
                $hotels = array_filter($hotels, function($hotel) use ($amenities, $price, $rating) {
                    // Check amenities
                    if (!empty($amenities)) {
                        $hotelAmenities = explode(',', $hotel['services']);
                        foreach ($amenities as $amenity) {
                            if (!in_array(trim($amenity), array_map('trim', $hotelAmenities))) {
                                return false;
                            }
                        }
                    }
                    
                    // Check price
                    if ($price && $hotel['mrp'] > (float)$price) {
                        return false;
                    }
                    
                    // Check rating
                    if ($rating && $hotel['rate'] < (float)$rating) {
                        return false;
                    }
                    
                    return true;
                });
            }
            
            // Format results
            $hotels = array_map(function($hotel) {
                $hotel['total_rooms'] = (int)($hotel['total_rooms'] ?? 0);
                $hotel['room_types'] = (int)($hotel['room_types'] ?? 0);
                $hotel['rooms'] = $hotel['total_rooms']; // For backward compatibility
                
                if (empty($hotel['room_details'])) {
                    $hotel['room_details'] = 'No rooms available';
                }
                
                return $hotel;
            }, array_values($hotels));
            
            // Return hotels array wrapped in array (for results page compatibility)
            echo json_encode([$hotels]);
            
        } catch (Exception $e) {
            log_message('error', 'hotelFind error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getHotelRooms()
    {
        header('Content-Type: application/json');
        
        try {
            // Get POST data
            $rawInput = file_get_contents('php://input');
            
            // Log the raw input for debugging
            log_message('debug', 'getHotelRooms - Raw Input: ' . $rawInput);
            
            if (empty($rawInput)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No input data received'
                ]);
                return;
            }
            
            $inputData = json_decode($rawInput, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid JSON input: ' . json_last_error_msg()
                ]);
                return;
            }
            
            log_message('debug', 'getHotelRooms - Parsed Data: ' . print_r($inputData, true));
            
            // Get hotel_id from the decoded data
            $hotelId = isset($inputData['hotel_id']) ? $inputData['hotel_id'] : null;
            
            // Also check for alternative parameter names
            if (!$hotelId) {
                $hotelId = isset($inputData['hotelId']) ? $inputData['hotelId'] : null;
            }
            if (!$hotelId) {
                $hotelId = isset($inputData['id']) ? $inputData['id'] : null;
            }
            
            if (!$hotelId) {
                log_message('error', 'Hotel ID not found in: ' . print_r($inputData, true));
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hotel ID is required',
                    'debug' => [
                        'received_data' => $inputData,
                        'raw_input' => $rawInput
                    ]
                ]);
                return;
            }
            
            log_message('debug', 'Getting rooms for hotel ID: ' . $hotelId);
            
            // Load model
            $this->load->model('Hotel_model');
            
            // Get rooms using the model method
            $result = $this->Hotel_model->get_hotel_rooms($hotelId);
            
            log_message('debug', 'Room query result: ' . print_r($result, true));
            
            // Return the result (already properly formatted with status)
            echo json_encode($result);
            
        } catch (Exception $e) {
            log_message('error', 'getHotelRooms error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function bookRoom()
    {
        header('Content-Type: application/json');
        log_message('debug', '====== Starting bookRoom ======');
        
        try {
            // Log headers and request details
            log_message('debug', 'Request Headers: ' . json_encode(getallheaders()));
            log_message('debug', 'Session Data: ' . json_encode($this->session->all_userdata()));
            log_message('debug', 'POST data: ' . json_encode($_POST));
            
            // Get raw JSON input
            $rawInput = file_get_contents('php://input');
            log_message('debug', 'Raw Input: ' . $rawInput);
            
            // Parse JSON data
            $inputData = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE && empty($_POST)) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid request data'
                ]);
                return;
            }
            
            // Use JSON data if available, otherwise fall back to POST
            $data = !empty($inputData) ? $inputData : $_POST;
            log_message('debug', 'Parsed booking data: ' . json_encode($data));
            
            // Check if user is logged in
            $userData = $this->session->userdata('userdata');
            log_message('debug', 'User Data from Session: ' . json_encode($userData));
            
            if (!$userData || !isset($userData['id'])) {
                log_message('error', 'No user data found in session');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Please log in to book a room',
                    'code' => 'LOGIN_REQUIRED'
                ]);
                return;
            }
            
            // Enable query logging
            $this->db->db_debug = TRUE;
            
            // Get data from parsed input
            $hotelId = $data['hotelId'] ?? null;
            $roomId = $data['roomId'] ?? null;
            $checkIn = $data['checkIn'] ?? null;
            $checkOut = $data['checkOut'] ?? null;
            $guests = $data['guests'] ?? null;
            $price = $data['price'] ?? null;
            $nights = $data['nights'] ?? null;
            $discount = $data['discount'] ?? 0;
            
            log_message('debug', 'Received booking data: ' . json_encode([
                'hotelId' => $hotelId,
                'roomId' => $roomId,
                'checkIn' => $checkIn,
                'checkOut' => $checkOut,
                'guests' => $guests,
                'price' => $price,
                'nights' => $nights,
                'discount' => $discount
            ]));
            
            // Validate required fields
            if (!$hotelId) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hotel ID is required'
                ]);
                return;
            }
            
            if (!$roomId) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Room ID is required'
                ]);
                return;
            }
            
            if (!$checkIn || !$checkOut) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Check-in and check-out dates are required'
                ]);
                return;
            }
            
            if (!$guests || !$price || !$nights) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required booking fields (guests, price, or nights)'
                ]);
                return;
            }
            
            // Start transaction
            $this->db->trans_start();
            
            // Get hotel and room data
            $hotel = $this->db->get_where('hotels', ['id' => $hotelId])->row_array();
            $room = $this->db->get_where('rooms', ['id' => $roomId])->row_array();
            
            if (!$hotel || !$room) {
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid hotel or room'
                ]);
                return;
            }
            
            // Format dates properly for MySQL
            $formattedCheckIn = date('Y-m-d', strtotime($checkIn));
            $formattedCheckOut = date('Y-m-d', strtotime($checkOut));
            
            // Validate dates
            if (!$formattedCheckIn || !$formattedCheckOut) {
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid date format'
                ]);
                return;
            }
            
            // Check if room is still available
            $room_query = "SELECT available_rooms FROM rooms WHERE id = ? AND hotel_id = ? FOR UPDATE";
            $room_result = $this->db->query($room_query, array($roomId, $hotelId))->row();
            
            if (!$room_result || $room_result->available_rooms < 1) {
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Room is no longer available'
                ]);
                return;
            }
            
            // Prepare booking data for database
            $bookingInsertData = [
                'hotelID' => intval($hotelId),
                'room_id' => intval($roomId),
                'hotelName' => $hotel['name'],
                'room_type' => $room['room_type'],
                'startDate' => $formattedCheckIn,
                'endDate' => $formattedCheckOut,
                'userID' => intval($userData['id']),
                'price' => intval($price),
                'peopleValue' => intval($guests),
                'nights' => intval($nights),
                'discount' => intval($discount),
                'bookingName' => $userData['name'] ?? 'Guest',
                'bookingEmail' => $userData['email'] ?? '',
                'bookingPhone' => $userData['mobile'] ?? '',
                'type' => 'Pending'
            ];
            
            // Log final booking data
            log_message('debug', 'Final booking data: ' . json_encode($bookingInsertData));
            
            // Insert booking
            $inserted = $this->db->insert('book', $bookingInsertData);
            $bookingId = $this->db->insert_id();
            
            if (!$inserted || !$bookingId) {
                $dbError = $this->db->error();
                log_message('error', 'Database insert error: ' . print_r($dbError, true));
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to insert booking: ' . $dbError['message']
                ]);
                return;
            }
            
            // Update room availability
            $update_query = "UPDATE rooms SET available_rooms = available_rooms - 1 WHERE id = ? AND hotel_id = ? AND available_rooms > 0";
            $updated = $this->db->query($update_query, array($roomId, $hotelId));
            
            if (!$updated) {
                $dbError = $this->db->error();
                log_message('error', 'Failed to update room availability: ' . print_r($dbError, true));
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update room availability'
                ]);
                return;
            }
            
            // Commit transaction
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Transaction failed'
                ]);
                return;
            }
            
            log_message('debug', 'Booking created successfully with ID: ' . $bookingId);
            
            echo json_encode([
                'status' => 'success',
                'success' => true,
                'message' => 'Booking created successfully',
                'bookingId' => $bookingId,
                'data' => [
                    'booking_id' => $bookingId,
                    'hotel' => $hotel['name'],
                    'room' => $room['room_type'],
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'nights' => $nights,
                    'guests' => $guests,
                    'total_price' => $price
                ]
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'bookRoom exception: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            echo json_encode([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
        
        log_message('debug', '====== Ending bookRoom ======');
    }

    // Alias for bookRoom to support legacy/alternative endpoint name
    public function hotelBooking()
    {
        header('Content-Type: application/json');
        
        // Check if this is a GET request for fetching bookings (order page)
        // or a POST request for creating a booking (book page)
        $rawInput = file_get_contents('php://input');
        $inputData = json_decode($rawInput, true);
        
        // If input has only 'id' field, this is a fetch request for order page
        if ($inputData && isset($inputData['id']) && count($inputData) === 1) {
            return $this->getUserBookings($inputData['id']);
        }
        
        // Otherwise, this is a booking creation request
        return $this->bookRoom();
    }
    
    /**
     * Get user bookings for order page
     */
    private function getUserBookings($userId)
    {
        try {
            log_message('debug', 'Fetching bookings for user ID: ' . $userId);
            
            if (!$userId) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User ID is required'
                ]);
                return;
            }
            
            // Query to get user bookings with hotel details
            $query = "SELECT 
                        b.*,
                        h.name,
                        h.location,
                        h.poster,
                        h.rate,
                        h.mrp,
                        h.discount,
                        r.capacity,
                        r.room_type
                      FROM book b
                      JOIN hotels h ON b.hotelID = h.id
                      LEFT JOIN rooms r ON b.room_id = r.id
                      WHERE b.userID = ?
                      ORDER BY b.startDate DESC";
            
            $result = $this->db->query($query, array($userId));
            
            if ($result === FALSE) {
                throw new Exception("Database error: " . $this->db->error()['message']);
            }
            
            $bookings = $result->result_array();
            
            log_message('debug', 'Found ' . count($bookings) . ' bookings for user: ' . $userId);
            
            // Return in the format expected by order.php
            echo json_encode([$bookings]);
            
        } catch (Exception $e) {
            log_message('error', 'getUserBookings error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}