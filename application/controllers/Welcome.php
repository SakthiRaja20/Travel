<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 public $db; 
	 public $session; 

	public function index()
	{
		$this->load->view('index');
	}

	public function result()
	{
		$this->load->view('result');
	}

	public function book()
	{
		$this->load->view('book');
	}
	public function order()
	{
		$this->load->view('order');
	}

	public function destinations()
	{
		$this->load->view('destinations');
	}

	public function hotelAmenities()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		$city = $inputData['city'];
		
		$query = "SELECT services FROM hotels WHERE city = ?";
		$result = $this->db->query($query , array($city))->result_array();

		if ($result) {
			echo json_encode([$result]);
		} else {
			echo json_encode(["status"=> "error", "message" => "No amenities found for then given city"]);
		}
		
	}

	public function hotels()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		// echo json_encode($inputData);

		if (empty($inputData['city'])) {
			echo json_encode(["status" => "error" , "message" => "city is required"]);
		}
		
		$amenities = isset($inputData['amenities']) ? $inputData['amenities'] : [];
		$price = isset($inputData['price']) ? $inputData['price'] : [];
		$rate = isset($inputData['rating']) ? $inputData['rating'] : [];
		$city = $inputData['city'];


		// Start Query 
		$query = "SELECT * FROM hotels WHERE city = ?";
		$queryPramas = [$city];

		// Add Amenities 
		if (!empty($amenities)) {
			$likeConditions = [];

			foreach($amenities as $aminty) {
				$likeConditions[] = "services LIKE ?";
				$queryPramas[] = '%'. $aminty .'%';
			}

			$query .= " AND (" . implode(" AND " , $likeConditions) . ")";

		}

		// ADD Price

		if (!empty($price)) {
			$query .= " AND mrp <= ?";
			$queryPramas[] = $price;
		}


		// ADD Rate

		if (!empty($rate)) {
			$query .= " AND rate <= ?";
			$queryPramas[] = $rate;
		}


		$result = $this->db->query($query , $queryPramas)->result_array();

		if ($result) {
			echo json_encode([$result]);
		} else {
			echo json_encode(["status" => "error" , "message" => "Data not found"]);
		}

	}


	public function hotelFind()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		$hotelID = $inputData['hotelID'];
		
		$query = "SELECT * FROM hotels WHERE id = ?";
		$result = $this->db->query($query , array($hotelID))->result_array();

		if ($result) {
			echo json_encode([$result]);
		} else {
			echo json_encode(["status"=> "error", "message" => "No hotels found for then given id"]);
		}
		
	}

	public function getHotelRooms()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		$hotelID = $inputData['hotelID'];
		
		$query = "SELECT * FROM rooms WHERE hotel_id = ? AND available_rooms > 0 ORDER BY price_per_night ASC";
		$result = $this->db->query($query , array($hotelID))->result_array();

		if ($result) {
			echo json_encode([$result]);
		} else {
			echo json_encode(["status"=> "error", "message" => "No rooms available for this hotel"]);
		}
		
	}


	public function bookRoom()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		$hotelID = $inputData['hotelID'];
		$roomID = $inputData['roomId'];
		$hotelName = $inputData['hotelName'];
		$roomType = $inputData['roomType'];
		$startDate = $inputData['startDate'];
		$endDate = $inputData['endDate'];
		$userID = $inputData['userID'];
		$price = $inputData['price'];
		$peopleValue = (int)$inputData['peopleValue']; // Ensure it's an integer
		$discount = $inputData['discount'];
		$bookingName = $inputData['bookingName'];
		$bookingEmail = $inputData['bookingEmail'];
		$bookingPhone = $inputData['bookingPhone'];
		$nights = $inputData['nights'];
		
		// Log incoming data for debugging
		error_log("Booking Request - Hotel: {$hotelID}, Room: {$roomID}, People: {$peopleValue}, Price: {$price}, Nights: {$nights}");

		// Check if room exists and has availability
		$roomQuery = "SELECT * FROM rooms WHERE id = ? AND hotel_id = ? AND available_rooms > 0";
		$roomResult = $this->db->query($roomQuery, [$roomID, $hotelID]);

		if ($roomResult->num_rows() == 0) {
			echo json_encode(["status"=> "error", "message" => "Room not available or does not exist"]);
			return;
		}

		$roomData = $roomResult->row();

		// Calculate number of rooms needed
		$capacity = (int)$roomData->capacity;
		$roomsNeeded = ceil($peopleValue / $capacity);

		// Only allow booking if peopleValue <= room capacity
		if ($peopleValue > $capacity) {
			echo json_encode(["status"=> "error", "message" => "Selected room can only accommodate {$capacity} guests. Please select a suitable room."]);
			return;
		}

		// Log for debugging
		error_log("Booking Debug - People: {$peopleValue}, Capacity: {$capacity}, Rooms Needed: {$roomsNeeded}, Available: {$roomData->available_rooms}");

		// Price is already the total price from frontend (price per night * nights)
		$totalPrice = $price;

		// Check if enough rooms are available
		if ($roomData->available_rooms < 1) {
			echo json_encode(["status"=> "error", "message" => "Not enough rooms available. Only {$roomData->available_rooms} left."]);
			return;
		}

		// Start transaction for atomic operation
		$this->db->trans_start();

		// Insert booking with total price (already calculated on frontend)
		$query = "INSERT INTO book( hotelID, room_id, hotelName, room_type, startDate, endDate, userID, price, peopleValue, nights, discount, bookingName, bookingEmail, bookingPhone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($query , [
			$hotelID,
			$roomID,
			$hotelName,
			$roomType,
			$startDate,
			$endDate,
			$userID,
			$totalPrice, // Store total price (already includes all rooms)
			$peopleValue,
			$nights,
			$discount,
			$bookingName,
			$bookingEmail,
			$bookingPhone,
		]);

		// Update room availability (decrement by 1 room per booking)
		if ($result) {
			error_log("Updating room availability - Decrementing 1 room from room ID: {$roomID}");
			$updateQuery = "UPDATE rooms SET available_rooms = available_rooms - 1 WHERE id = ?";
			$updateResult = $this->db->query($updateQuery, [$roomID]);
			error_log("Update result: " . ($updateResult ? "Success" : "Failed"));
		}

		// Complete transaction
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo json_encode(["status"=> "error", "message" => "Booking failed. Please try again."]);
		} else {
			echo json_encode(["status"=> "success", "message" => "Booking successful! {$roomType} reserved for {$nights} night(s)."]);
		}
		
	}



	public function hotelBooking()
	{
		$inputData = json_decode(file_get_contents('php://input'), true);
		$id = $inputData['id'];
		
		$query = "SELECT b.* , h.*, r.room_type, r.capacity, r.amenities, r.images as room_images FROM `book` as b INNER JOIN hotels as h ON b.hotelID = h.id INNER JOIN rooms as r ON b.room_id = r.id WHERE b.userID = ? ORDER BY b.id DESC";
		$result = $this->db->query($query , array($id))->result_array();

		if ($result) {
			echo json_encode([$result]);
		} else {
			echo json_encode(["status"=> "error", "message" => "No booking found"]);
		}
		
	}


	
}
