<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/DatabaseConnection.php");

class UserMapper {

	
	private $db;
	public function __construct() {
		$this->db = DatabaseConnection::getInstance();
	}

	//Saves a User into the database
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO user (username,password,admin) values (?,?,?)");
		$username=$user->getUsername();
		$password=$user->getPassword();
		$admin=$user->getAdmin();
		if($stmt->bind_param("ssi", $username,$password,$admin))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					return true;
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		else
			{
				echo "Couldn't bind params for stmt: " . $stmt->error . "<br>";
			}
		return false;
	}

	// Checks if a given username is already in the database
	public function usernameExists($user) {
		$stmt = $this->db->prepare("SELECT * FROM user where username=?");
		$username= $user->getUsername();
		if($stmt->bind_param("s", $username))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					echo "Nr of records: ".mysqli_num_rows($result) . "<br>";
					if(mysqli_num_rows($result) == 1){
						return true;
					}
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		return false;
	}

	// Checks if a given pair of username/password exists in the database
	public function isValidUser($user) {
		$stmt = $this->db->prepare("SELECT * FROM user where username=? and password=?");
		echo "username: ".$user->getUsername();
		echo "password: ". $user->getPassword();
		$username= $user->getUsername();
		$password =  $user->getPassword();
		if($stmt->bind_param("ss", $username,$password))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					echo "Nr of records: ".mysqli_num_rows($result) . "<br>";
					if(mysqli_num_rows($result) == 1){
						return "exists";
					}
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		return "doesn't exists";
	}
}
