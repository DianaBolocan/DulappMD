<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");
	require_once(__DIR__."/ActionMapper.php");

	class DIMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function update($item,$drawerID){
			if($stmtWardrobe = $this->db->prepare("SELECT wardrobeID FROM wd JOIN di on wd.drawerID = di.drawerID WHERE itemID = ?")){
				if($stmtWardrobe->bind_param("i",$item->getItemID())){
					echo $item->getItemID() . '<br>';
					if($stmtWardrobe->execute()){
						$result = $stmtWardrobe->get_result();
						if($row = $result->fetch_array()){
							$wardrobeIDFrom = $row[0];
						} else {
							error_log("Couldn't find rows1.",3,'errors.txt');
							return false;
						}
					} else {
						error_log("Couldn't execute stmtWardrobe: " . $stmtWardrobe->error,3,'errors.txt');
						return false;
					}
				} else {
					error_log("Couldn't bind params for stmtWardrobe: " . $stmtWardrobe->error,3,'errors.txt');
					return false;
				}
			} else {
				error_log("Couldn't prepare stmtWardrobe: " . $this->db->error,3,'errors.txt');
				return false;
			}
			$stmtWardrobe->close();

			if($stmtWardrobeTo = $this->db->prepare("SELECT wardrobeID FROM wd WHERE drawerID = ?")){
				if($stmtWardrobeTo->bind_param("i",$drawerID)){
					if($stmtWardrobeTo->execute()){
						$resultW = $stmtWardrobeTo->get_result();
						if($rowW = $resultW->fetch_array()){
							$wardrobeIDTo = $rowW[0];
						} else {
							error_log("Couldn't find rows2.",3,'errors.txt');
							return false;
						}
					} else {
						error_log("Couldn't execute stmtWardrobeTo: " . $stmtWardrobeTo->error,3,'errors.txt');
						return false;
					}
				} else {
					error_log("Couldn't bind params for stmtWardrobeTo: " . $stmtWardrobeTo->error,3,'errors.txt');
					return false;
				}
			} else {
				error_log("Couldn't prepapre stmtWardrobeTo: " . $this->db->error,3,'errors.txt');
				return false;
			}
			$stmtWardrobeTo->close();

			if($stmtWardrobeName = $this->db->prepare("SELECT name FROM wardrobe WHERE wardrobeID = ?")){
				if($stmtWardrobeName->bind_param("i",$wardrobeIDFrom)){
					if($stmtWardrobeName->execute()){
						$resultName = $stmtWardrobeName->get_result();
						if($rowName = $resultName->fetch_array()){
							$wardrobeNameFrom = $rowName[0];
						} else {
							error_log("Couldn't find rows3.",3,'errors.txt');
							return false;
						}
					} else {
						error_log("Couldn't execute stmtWardrobeName: " . $stmtWardrobeName->error,3,'errors.txt');
					}
				} else {
					error_log("Couldn't bind params for stmtWardrobeName: " .$stmtWardrobeName->error,3,'errors.txt');
					return false;
				}
			} else {
				error_log("Couldn't preapre stmtWardrobeName: " . $this->db->error,3,'errors.txt');
				return false;
			}
			$stmtWardrobeName->close();

			if($stmtWardrobeName = $this->db->prepare("SELECT name FROM wardrobe WHERE wardrobeID = ?")){
				if($stmtWardrobeName->bind_param("i",$wardrobeIDTo)){
					if($stmtWardrobeName->execute()){
						$resultName = $stmtWardrobeName->get_result();
						if($rowName = $resultName->fetch_array()){
							$wardrobeNameTo = $rowName[0];
						} else {
							error_log("Couldn't find rows4.",3,'errors.txt');
							return false;
						}
					} else {
						error_log("Couldn't execute stmtWardrobeName: " . $stmtWardrobeName->error,3,'errors.txt');
					}
				} else {
					error_log("Couldn't bind params for stmtWardrobeName: " .$stmtWardrobeName->error,3,'errors.txt');
					return false;
				}
			} else {
				error_log("Couldn't preapre stmtWardrobeName: " . $this->db->error,3,'errors.txt');
				return false;
			}
			$stmtWardrobeName->close();

			echo $wardrobeNameFrom . " and " . $wardrobeNameTo . " <br> ";

			if($stmt = $this->db->prepare("UPDATE DI SET drawerID = ? WHERE itemID = ?")){
				if($stmt->bind_param("ii",$drawerID,$item->getItemID())){
					if($stmt->execute()){
						echo 'Successfully updated DI. <br>';
						$actionMapper = new ActionMapper();
						$action = 'Move item';
						$description = 'Item ' . $item->getItemID() . ' has been moved.';
						if(!($actionMapper->save($row[0],$action,$description)))
							return false;
					} else {
						error_log("Couldn't execute stmt:" . $stmt->error,3,'errors.txt');
						return false;
					}
				} else 
				{
					error_log("Couldn't bind params to stmt:" . $stmt->error,3,'errors.txt');
					return false;
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,'errors.txt');
				return false;
			}
			$stmt->close();

			if(strcmp($wardrobeNameFrom,$wardrobeNameTo) != 0){
				echo "distinct wardrobe names <br>";
				$moved = 'moved from ' . $wardrobeNameFrom . ' to ' . $wardrobeNameTo;
				if($stmtItemUpdate = $this->db->prepare("UPDATE item SET moved = ?, updatedAt = CURRENT_TIMESTAMP WHERE itemID = ?")){
					if($stmtItemUpdate->bind_param("si",$moved,$item->getItemID())){
						if($stmtItemUpdate->execute()){
							echo "updated item.moved";
							return true;
						} else {
							error_log("Couldn't execute stmtItemUpdate: " . $stmtItemUpdate->error,3,'errors.txt');
							return false;
						}
					} else {
						error_log("Couldn't bind params: " . $stmtItemUpdate->error,3,'errors.txt');
						return false;
					}
				} else {
					error_log("Couldn't prepare stmtItemUpdate: " . $stmtItemUpdate->error,3,'errors.txt');
					return false;
				}	
			}
			echo "same wardrobe <br>";
			return true;
		}
	}
?>