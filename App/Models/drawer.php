<?php
	class Drawer{
		
		private $drawerID;
		private $drawerKey;
		private $createdAt;

		public function __construct($drawerID, $drawerKey, $createdAt) {
			$this->drawerID = $drawerID;
			$this->drawerKey = $drawerKey;
			$this->createdAt = $createdAt;
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
	}
?>