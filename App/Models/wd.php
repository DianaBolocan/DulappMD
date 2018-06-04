<?php
	class WD{
		
		private $wardrobeID;
		private $drawerID;

		public function __construct() {
			$this->wardrobeID = NULL;
			$this->drawerID = NULL;			
		}

		public function setWardrobeID($wardrobeID){
			$this->wardrobeID = $wardrobeID;
		}

		public function getWardrobeID(){
			return $this->wardrobeID;
		}

		public function setDrawerID($drawerID){
			$this->drawerID = $drawerID;
		}

		public function getDrawerID(){
			return $this->drawerID;
		}
	}
?>