<?php
	class Drawer{
		
		private $drawerID;
		private $drawerKey;
		private $createdAt;

		public function __construct() {
			$this->drawerID = NULL;
			$this->drawerKey = NULL;
			$this->createdAt = NULL;
		}

		public function getDrawerKey(){
			return $this->drawerKey;
		}

		public function setDrawerKey($drawerKey){
			$this->drawerKey = $drawerKey;
		}

		public function getCreatedAt(){
			return $this->createdAt;
		}

		public function setCreatedAt($createdAt){
			$this->createdAt = $createdAt;
		}

		public function getDrawerID(){
			return $this->drawerID;
		}

		public function setDrawerID($drawerID){
			$this->drawerID = $drawerID;
		}
	}
?>