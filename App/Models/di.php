<?php
	class DI{
		
		private $drawerID;
		private $itemID;

		public function __construct() {
			$this->drawerID = NULL;
			$this->itemID = NULL;
		}

		public function setItemID($itemID){
			$this->itemID = $itemID;
		}

		public function getItemID(){
			return $this->itemID;
		}

		public function setDrawerID($drawerID){
			$this->drawerID = $drawerID;
		}

		public function getDrawerID(){
			return $this->drawerID;
		}
	}
?>