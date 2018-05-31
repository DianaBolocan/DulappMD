<?php
	class User{
		public $userID;
		private $username;
		private $password;
		private $admin;

		public function __construct(){
			$this->username = NULL;
			$this->password = NULL;
			$this->admin = NULL;
		}

		public function getUsername() {
			return $this->username;
		}

		public function setUsername($username) {
			$this->username = $username;
		}

		public function getPassword() {
			return $this->password;
		}
		
		public function setPassword($password) {
			$this->password = $password;
		}

		public function getAdmin() {
			return $this->admin;
		}

		public function setAdmin($admin) {
			$this->admin = $admin;
		}


		//	public function checkUser(){
		//		echo 'A mers: ' . $this->username . ' ' . $this->password;
		//	}
		}
?>