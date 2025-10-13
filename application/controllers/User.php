<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public $db; 
	public $session; 

	public function signup()
	{
		// Get input data
		$name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');
		$gender = $this->input->post('gender');

		// Validate required fields
		if (empty($name) || empty($mobile) || empty($password) || empty($gender)) {
			echo json_encode([
				"status" => "error",
				"message" => "All fields are required"
			]);
			return;
		}

		// Validate mobile number (10 digits)
		if (!preg_match('/^[0-9]{10}$/', $mobile)) {
			echo json_encode([
				"status" => "error",
				"message" => "Invalid mobile number format"
			]);
			return;
		}

		// Check if mobile number already exists
		$existing = $this->db->get_where('users', ['mobile' => $mobile])->row();
		if ($existing) {
			echo json_encode([
				"status" => "error",
				"message" => "Mobile number already registered"
			]);
			return;
		}

		// Create email from mobile if not provided
		$email = $this->input->post('email') ?? $mobile . '@example.com';

		// Hash password
		$hashedPassword = md5($password);

		// Insert user
		$query = "INSERT INTO users(name, mobile, email, password, gender) VALUES (?, ?, ?, ?, ?)";
		
		try {
			$this->db->query($query, array($name, $mobile, $email, $hashedPassword, $gender));
			echo json_encode([
				"status" => "success",
				"message" => "Signup successful"
			]);
		} catch (Exception $e) {
			echo json_encode([
				"status" => "error",
				"message" => "Registration failed. Please try again."
			]);
		}

	}

	public function login()
	{
		// Get and validate input
		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');

		// Input validation
		if (empty($mobile) || empty($password)) {
			echo json_encode([
				"status" => "error",
				"message" => "Mobile/Username and password are required"
			]);
			return;
		}

		// Check for hardcoded admin credentials
		if ($mobile === 'admin' && $password === 'admin@123') {
			$adminData = [
				'id' => 0,
				'name' => 'Administrator',
				'mobile' => 'admin',
				'is_admin' => true
			];

			$this->session->set_userdata('userdata', $adminData);
			echo json_encode([
				"status" => "success",
				"message" => "Admin login successful",
				"is_admin" => true
			]);
			return;
		}

		// Regular user login - only hash password if it's not empty
		$hashedPassword = md5($password);
		$query = "SELECT * FROM users WHERE mobile = ? AND password = ?";

		$result = $this->db->query($query , array($mobile , $password))->row_array();

		if ($result) {
			$userData = [
				'id' => $result['id'],
				'name' => $result['name'],
				'mobile' => $result['mobile'],
				'email' => $result['email'] ?? $result['mobile'] . '@example.com', // Fallback email if not set
				'is_admin' => false
			];

			$this->session->set_userdata('userdata', $userData);
			echo json_encode(["status" => "success" , "message" => "Login successful", "is_admin" => false]);
		} else {
			echo json_encode(["status" => "error" , "message" => "Invalid mobile or password"]);
		}
		


	}


	public function logout()
	{
		$this->session->sess_destroy();
		echo json_encode(["status" => "success" , "message" => "Logout successful"]);
	}
	
}
