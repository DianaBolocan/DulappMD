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
			if($stmt = $this->db->prepare("select name,drawerID from wardrobe join wd on wardrobe.wardrobeID = wd.wardrobeID order by 1"))
			{
						if($stmt->execute()){
							$result = $stmt->get_result();
							$infos= array();
							while($row = $result->fetch_row())
							{
								$drawerName = $row[0];
								$drawerID = $row[1];
								//as to move an item, it should be specified all the combinations wardrobe name- drawer id
								array_push($infos, $drawerName . "-".$drawerID);	
							}		
						}
						else
							error_log("Couldn't execute stmt: " .  $stmt->error,3,"errors.txt");
					
			}
			else
				{
					error_log("Failed to prepare statement: " . $this->db->error); 
				}
			
			return  $infos;
		}

	}
?>