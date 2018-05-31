<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class ItemMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function selectFromDrawer($drawerID){
		$sessionKey=0;
		$stmt = $this->db->prepare("select * from item i join di on di.itemID=i.itemID where di.drawerID=?");
		if($stmt->bind_param("i", $drawerID))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					$ids= array();
					while($row = $result->fetch_row())
					{
						$itemId = (int)$row[0];
						array_push($ids, $itemId);
						echo " itemId: " . $itemId . ",";

						$color = (string)$row[2];
						echo " ItemColor: " . $color . ",";
						
						$createdAt = (string)$row[9];
						echo " CreatedAt: " . $createdAt . "<br>";	

						//echo "<a href='".'http://localhost/DulappMD/Public/Catalog?sessionKey='.$sessionKey."'>Link</a>" . "<br>";
						$sessionKey=$sessionKey+1;
						
					}
					$_SESSION["itemIDs"]=$ids;
					
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		else
			{
				echo "Couldn't bind params for stmt: " . $stmt->error . "<br>";
			}
		if($sessionKey>=1)
			return true;
		return false;
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