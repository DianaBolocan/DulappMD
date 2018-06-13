<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class ActionMapper {
		private $db;
		
		public function __construct() {
			$this->db = DatabaseConnection::getInstance();
		}

		public function selectActions($wardrobeID){
			if($stmt = $this->db->prepare("select * from actions where wardrobeID=?"))
			{
				if($stmt->bind_param("i", $wardrobeID))
					{
						if($stmt->execute()){
							$result = $stmt->get_result();
							$actions= array();
							while($row = $result->fetch_row())
							{
								$actionsString = $row[0] . '_' . $row[1] .'_'. $row[2] . '_' . $row[3];
								array_push($actions, $actionsString);	
							}
							//$_SESSION["drawerIDs"]=$ids;
							
						}
						else
							error_log("Couldn't execute stmt: " .  $stmt->error,3,"errors.txt");
					}
				else
					{
						error_log("Couldn't bind params for stmt: " . $stmt->error ,3,"errors.txt");
					}
			}
			else
				{
					error_log("Failed to prepare statement: " . $this->db->error); 
				}
			return $actions;
		}

		public function save($wardrobeID,$action,$description){
			if($actionStmt = $this->db->prepare("INSERT INTO actions (wardrobeID,action,description) VALUES (?,?,?)"))
						{
							if($actionStmt->bind_param("iss",$wardrobeID,$action,$description))
							{
								if($actionStmt->execute())
								{
					 				return true;
					 			}
					 			else
									error_log("Couldn't execute the stmt: " . $actionStmt->error,3,"errors.txt");
							}
							else
								error_log("Couldn't bind params for stmt: " . $actionStmt->error,3,"errors.txt");
						}
						else
							error_log("Couldn't prepare statement: " . $this->db->error,3,"errors.txt");
			return false;
		}
	}