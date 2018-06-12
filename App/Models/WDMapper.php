<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

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

		public function getWardrobeNameDrawerIDs(){
			//select name,drawerID from wardrobe join wd on wardrobe.wardrobeID = wd.wardrobeID order by 1
			//$string = row[0] . '-' . row[1];
			//array1.push($string);
			//return array1;


			$test=array();
			array_push($test,"de iarna-3");
			array_push($test,"Miruna-1");
			return $test;

			
	}
?>