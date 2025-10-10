<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	 public $upload;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		
		// Check if user is logged in
		if (!$this->session->userdata('userdata')) {
			redirect(base_url());
			exit();
		}
		
		// Check if user is admin
		$userdata = $this->session->userdata('userdata');
		if (!isset($userdata['is_admin']) || $userdata['is_admin'] !== true) {
			// Redirect non-admin users to their orders page
			redirect(base_url('Welcome/order'));
			exit();
		}
	}

	public function dashboard()
	{
		$this->load->view('Dashboard/dashboard');
	}


	public function hotels()
	{
		$this->load->view('Dashboard/hotels');
	}


	public function bookings()
	{
		$this->load->view('Dashboard/bookings');
	}


	public function users()
	{
		$this->load->view('Dashboard/users');
	}


	public function data_count()
	{
		$query = "SELECT COUNT(id) as user , (SELECT COUNT(id) FROM hotels) as hotel , (SELECT COUNT(id) FROM book) as bookings , (SELECT SUM(price*nights) FROM book) as revenue FROM `users`";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}


	public function booking_per()
	{
		$query = "SELECT h.poster , b.hotelID , b.hotelName , COUNT(b.id) as count , (SELECT COUNT(id) FROM book) as totel FROM book as b INNER JOIN hotels as h ON b.hotelID = h.id GROUP BY b.hotelID;";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}

	public function new_hotels()
	{
		$query = "SELECT name , poster , city FROM hotels ORDER BY id DESC  LIMIT 5";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}

	public function all_bookings()
	{
		$query = "SELECT b.* , h.poster , b.id as booking_id , (SELECT name FROM users WHERE id = b.userID) as booking_username FROM book as b INNER JOIN hotels as h ON  b.hotelID = h.id;";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}

	public function hotel_cityes()
	{
		$query = "SELECT city , lat , log FROM hotels;";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}


	public function all_bookings_monthly()
	{
		$query = "SELECT  m.month_short,
    IFNULL(b.booking_count , 0) as booking_count  FROM (
  
    SELECT 1 as month_num , 'Jan' as  month_short UNION ALL
    SELECT 2, 'Feb' UNION ALL
    SELECT 3, 'Mar' UNION ALL
    SELECT 4, 'Apr' UNION ALL
    SELECT 5, 'May' UNION ALL
    SELECT 6, 'Jun' UNION ALL
    SELECT 7, 'Jul' UNION ALL
    SELECT 8, 'Aug' UNION ALL
    SELECT 9, 'Sep' UNION ALL
    SELECT 10, 'Oct' UNION ALL
    SELECT 11, 'Nov' UNION ALL
    SELECT 12, 'Dec'

) as m
LEFT JOIN (
SELECT MONTH(create_at) as month_num,
    COUNT(*) as booking_count
FROM book GROUP BY MONTH(create_at)
) as b

ON  m.month_num = b.month_num ORDER BY m.month_num;";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}



	public function all_hotels()
	{
		$query = "SELECT * FROM hotels;";
		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}



	public function find_hotels()
	{

		$data = json_decode(file_get_contents('php://input'), true);

		$value = $data['value'];

		$query = "SELECT * FROM hotels
		WHERE `name` LIKE '%$value%'
		OR  `city` LIKE '%$value%'
		OR  `location` LIKE '%$value%'
		";


		$result = $this->db->query($query)->result_array();
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}


	public function img_uplaod() {
		header('Content-Type: application/json');


		$config['upload_path'] = './assets/img/Hotels-photos/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$config['encrypt_name'] = TRUE;


		$this->load->library('upload', $config);


		if (!$this->upload->do_upload('userfile')) {
			echo json_encode([
				'status' => 'error',
				'message' => strip_tags($this->upload->display_errors())
			]);
		} else {
			$data = $this->upload->data();
			echo json_encode([
				'status' => 'success',
				'img_url' => base_url(('assets/img/hotels-photos/' . $data['file_name']))
			]);
		}
		
	}


	public function insert_hotel() {
		$data = json_decode(file_get_contents('php://input'), true);

		if (!$data) {
			echo json_encode(["status"=> "error" , "message" => "Invalid Input"]);
			return;
		}

		$roomPoster = $data['preview1'] . ',' .$data['preview2'];

		$values = [
			$data['name'],
			$data['dec'],
			$data['city'],
			$data['rate'],
			$data['mrp'],
			$data['discount'],
			$data['loc'],
			$data['lat'],
			$data['log'],
			$data['services'],
			$data['food'],
			$data['preview'],
			$roomPoster ,
			$data['room']
		];

		$sql = "INSERT INTO hotels( name, description, city, rate, mrp, discount, location, lat, log, services, food, poster, room_andHotelImages, rooms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

		$inserted = $this->db->query($sql, $values);

		// echo $this->db->last_query();

		if ($inserted) {
			echo json_encode(["status"=> "success" , "message" => "Hotel inserted successfully"]);
		} else {
			echo json_encode(["status"=> "error" , "message" => "failed to insert hotels"]);
		}
		

	}



	public function update_hotel() {
		$data = json_decode(file_get_contents('php://input'), true);

		if (!$data) {
			echo json_encode(["status"=> "error" , "message" => "Invalid Input"]);
			return;
		}

		$roomPoster = $data['preview1'] . ',' .$data['preview2'];

		$values = [
			$data['name'],
			$data['dec'],
			$data['city'],
			$data['rate'],
			$data['mrp'],
			$data['discount'],
			$data['loc'],
			$data['lat'],
			$data['log'],
			$data['services'],
			$data['food'],
			$data['preview'],
			$roomPoster ,
			$data['room'],
			$data['id']
		];

		$sql = "UPDATE hotels SET 
         `name` = ?, 
         `description` = ?, 
         `city` = ?, 
         `rate` = ?, 
         `mrp` = ?, 
         `discount` = ?, 
         `location` = ?, 
         `lat` = ?, 
         `log` = ?, 
         `services` = ?, 
         `food` = ?, 
         `poster` = ?, 
         `room_andHotelImages` = ?, 
         `rooms` = ?
         WHERE `id` = ?";

		$updated = $this->db->query($sql, $values);

		// echo $this->db->last_query();

		if ($updated) {
			echo json_encode(["status"=> "success" , "message" => "Hotel updated successfully"]);
		} else {
			echo json_encode(["status"=> "error" , "message" => "failed to update hotels"]);
		}
		

	}
	


	public function all_booking_types()
	{

		$data = json_decode(file_get_contents('php://input'), true);

		$value = $data['type'];

		

		if ($value == 'All') {
			$query = 'SELECT b.* , h.* , b.id as booking_id , (SELECT name FROM users WHERE id = b.userID) as booking_username FROM  book as b INNER JOIN hotels as h ON b.hotelID = h.id';

			$result = $this->db->query($query)->result_array();
		} else {
			$query = 'SELECT b.* , h.* , b.id as booking_id , (SELECT name FROM users WHERE id = b.userID) as booking_username FROM  book as b INNER JOIN hotels as h ON b.hotelID = h.id 
			WHERE b.type = ?
			';

			$result = $this->db->query($query , [$value])->result_array();
		}

	
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}


	public function find_bookings()
	{

		$data = json_decode(file_get_contents('php://input'), true);

		$value = $data['value'];


		$value = '%' . $value . '%';

		$prams = array_fill(0, 6 , $value);


		$query = 'SELECT b.* , h.* , b.id as booking_id , (SELECT name FROM users WHERE id = b.userID) as booking_username FROM  book as b INNER JOIN hotels as h ON b.hotelID = h.id 
		WHERE 
		(SELECT name FROM users WHERE id = b.userID) LIKE ?
		OR b.hotelName LIKE ?
		OR b.bookingPhone LIKE ?
		OR b.type LIKE ?
		OR b.bookingEmail LIKE ?
		OR b.bookingName LIKE ?';

		$result = $this->db->query($query , $prams)->result_array();

	
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "No Found Deatils"]);
		}
	}



	public function update_booking()
	{

		$data = json_decode(file_get_contents('php://input'), true);

		$value = $data['value'];


		$values = [
			$data['value'],
			$data['id']
		];


		$query = 'UPDATE book SET type = ? WHERE id = ?';

		$result = $this->db->query($query , $values);

	
		if ($result) {
			echo json_encode(["status" => "error" , "message" => "Booking Updated"]);
		} else {
			echo json_encode(["status" => "error" , "message" => "Failed to update"]);
		}
	}



	public function userDataSearch()
	{

		$data = json_decode(file_get_contents('php://input'), true);

		$value = $data['value'];


		$this->db->select('*');
		$this->db->from('users');

		if ($value != 'All') {
			$this->db->group_start();
			$this->db->like('name', $value);
			$this->db->or_like('gender', $value);
			$this->db->or_like('mobile', $value);
			$this->db->or_like('timestamp', $value);
			$this->db->group_end();
		}


		$query = $this->db->get();
		$result = $query->result_array();

	
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(["status" => "error" , "message" => "Data Not Found"]);
		}
	}

	
}
