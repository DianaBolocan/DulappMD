<?php
	class UW{
		
		private $userID;
		private $wardrobeID;

		public function __construct() {
			$this->userID = NULL;
			$this->wardrobeID = NULL;	
		}

		public function setWardrobeID($wardrobeID){
			$this->wardrobeID = $wardrobeID;
		}

		public function getWardrobeID(){
			return $this->wardrobeID;
		}

		public function setUserID($userID){
			$this->userID = $userID;
		}

		public function getUserID(){
			return $this->userID;
		}
	}
?>