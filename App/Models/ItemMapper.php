<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class ItemMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function save($item,$drawerID){

		}

		public function delete($item){
			if($stmt = $this->db->prepare("DELETE FROM item WHERE itemID = ?"))
			{
				if($stmt->bind_param("i",$item->getItemID()))
				{
					if($stmt->execute()){
						echo "Successfully deleted the item. <br>";
						return true;
					} else
					{
						error_log("Couldn't execute the stmt: " . $stmt->error);
					}
				} else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error);
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error);
			}

			$stmt->close();
			return false;
		}
	}
?>