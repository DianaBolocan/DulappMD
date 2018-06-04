<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/DatabaseConnection.php");

class UserMapper {

	
	private $db;
	public function __construct() {
		$this->db = DatabaseConnection::getInstance();
	}

	//Saves a User into the database and returns his ID
	public function save($user) {
		if($stmt = $this->db->prepare("INSERT INTO user (username,password,admin) values (?,?,?)"))
		{
			$username=$user->getUsername();
			$password=$user->getPassword();
			$phash=sha1(sha1($password . "salt") . "salt");
			$admin=$user->getAdmin();
			if($stmt->bind_param("ssi", $username,$phash,$admin))
				{
					if($stmt->execute()){
						$result = $stmt->get_result();
						//trying to return userID
						if($stmtSelect = $this->db->prepare("Select userID from user where username=?"))
						{
							echo $username;
							if($stmtSelect->bind_param("s", $username))
							{
								if($stmtSelect->execute()){
									$resultSelect = $stmtSelect->get_result();
									$row = $resultSelect->fetch_row();
									$userID = (int)$row[0];
									//echo $userID;
									return $userID;
								}
								else
									error_log("Couldn't execute the stmt: " . $stmtSelect->error,3,"errors.txt");
							}
							else
							{
								echo 'am intrat in else';
								error_log("Couldn't bind params for stmt: " . $stmtSelect->error,3,"errors.txt");
							}

						}
						else
						{
							error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
						}	
					}
					else
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
				}
			else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
		}
		else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
			}	
		return false;
	}

	// Checks if a given username is already in the database
	public function usernameExists($user) {
		if($stmt = $this->db->prepare("SELECT * FROM user where username=?"))
		{
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
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
				}
			else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
		}
		else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
			}
		return false;
	}

	// Checks if a given pair of username/password exists in the database(Login)
	public function isValidUser($user) {
		if($stmt = $this->db->prepare("SELECT * FROM user where username=? and password=?"))
		{
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
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
			}
			else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
		}
		//userName or password is wrong
		return 'false';
	}
}
