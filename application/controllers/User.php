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
		$name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email') ?? $mobile . '@example.com';  // Use mobile as fallback
		$password = md5($this->input->post('password'));
		$gender = $this->input->post('gender');

		$query = "INSERT INTO users(name, mobile, email, password, gender) VALUES (?, ?, ?, ?, ?)";

		$this->db->query($query , array($name, $mobile, $email, $password, $gender));

		echo json_encode(["status" => "success" , "message" => "Signup successful"]);

	}

	public function login()
	{

		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');

		// Check for hardcoded admin credentials
		if ($mobile === 'admin' && $password === 'admin@123') {
			$adminData = [
				'id' => 0,
				'name' => 'Administrator',
				'mobile' => 'admin',
				'is_admin' => true
			];

			$this->session->set_userdata('userdata', $adminData);
			echo json_encode(["status" => "success" , "message" => "Admin login successful", "is_admin" => true]);
			return;
		}

		// Regular user login
		$password = md5($password);
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
