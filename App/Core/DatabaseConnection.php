<?php

class DatabaseConnection {

	private static $conn = null;

	public static function getInstance() {
		if ( self::$conn == null) {
			self::$conn = new mysqli("localhost","root","","dulappmd");
		}

		if(self::$conn->connect_errno){
			echo "failed to connect to MySql: " . $conn->connect_error . "<br>";
		} 
		//echo "Connected successfully. <br>";
		return self::$conn;
	}
}
?>