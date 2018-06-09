<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class DIMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function update($item,$drawerID){
			if($stmt = $this->db->prepare("UPDATE DI SET drawerID = ? WHERE itemID = ?")){
				if($stmt->bind_param("ii",$drawerID,$item->getItemID())){
					if($stmt->execute()){
						echo 'Successfully updated DI.';
						return true;
					} else {
						error_log("Couldn't execute stmt:" . $stmt->error,3,'errors.txt');
					}
				} else 
				{
					error_log("Couldn't bind params to stmt:" . $stmt->error,3,'errors.txt');
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,'errors.txt');
			}

			return false;
		}
	}
?>