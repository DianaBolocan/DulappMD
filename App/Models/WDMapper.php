<?php
	class WDMapper {
		private $db;
		
		public function __construct() {
			$this->db = DatabaseConnection::getInstance();
		}

		private function getCountDrawers($wardrobeID){
			//$count = select count($drawerID) from UW where wardrobeID = $this->wardrobeID;
			if($stmt = $this->db->prepare("SELECT COUNT(drawerID) FROM UW WHERE wardrobeID = ?")){

			} else {
				error_log("Couldn't prepare stmt:" . $stmt->error,3,'errors.txt');
			}

			return $count;
		}
	}
?>