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
		$phash=sha1(sha1($password . "salt") . "salt");
		$admin=$user->getAdmin();
		if($stmt->bind_param("ssi", $username,$phash,$admin))
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
					//echo "Nr of records: ".mysqli_num_rows($result) . "<br>";
					if(mysqli_num_rows($result) == 1){
						return true;
					}
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		return false;
	}

	// Checks if a given pair of username/password exists in the database(Login)
	public function isValidUser($user) {
		$stmt = $this->db->prepare("SELECT * FROM user where username=? and password=?");
		echo "username: ".$user->getUsername();
		echo "password: ". $user->getPassword();
		$username= $user->getUsername();
		$password =  $user->getPassword();
		$phash=sha1(sha1($password . "salt") . "salt");
		//echo "Phash:" . $phash . "<br>";
		$encyptedPass= substr($phash, 0, 20);
		if($stmt->bind_param("ss", $username,$encyptedPass))
		{
			if($stmt->execute())
				{
					$result = $stmt->get_result();
					if($rowId = $result->fetch_row())
						{
							$userID = (int)$rowId[0];
							echo "userID: " . $userID . "<br>";
						}
					else 
						{
							echo "No rows to fetch. <br>";
						}
					echo "Nr of records: ".mysqli_num_rows($result) . "<br>";
					if(mysqli_num_rows($result) == 1){
						return $userID;
					}
				}
				else
				{
					echo "Couldn't execute stmt: " . $stmt->error . "<br>";
				}
		}
		else
			{
				echo "Couldn't bind param for stmt: " . $stmt->error . "<br>";
			}
		//userName or password is wrong
		return "wrong";
	}
}
