<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class ItemMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function selectFromDrawer($drawerID){
		$sessionKey=0;
		if($stmt = $this->db->prepare("select i.path from item i join di on di.itemID=i.itemID where di.drawerID=?"))
		{
			if($stmt->bind_param("i", $drawerID))
				{
					if($stmt->execute()){
						$result = $stmt->get_result();
						$itemPaths= array();
						while($row = $result->fetch_row())
						{
							$itemPath = $row[0];
							array_push($itemPaths, $itemPath);
							$sessionKey=$sessionKey+1;
							
						}
						$_SESSION["itemPaths"]=$itemPaths;	
					}
					else
						error_log("Couldn't execute statement: " . $stmt->error,3,"errors.txt");
				}
			else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
		}
		else
			{
				error_log("Couldn't prepare statement: " . $this->db->error,3,"errors.txt");
			}	
		if($sessionKey>=1)
			return 'true';
		return 'false';
	}
	
		public function save($item,$drawerID){
			if($stmt = $this->db->prepare("INSERT INTO item (type,color,size,material,path,value,itemKey,brand,state,season,extras,createdAt,updatedAt) VALUES (?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)"))
			{
				if($stmt->bind_param("sssssssssss",$item->getType(),$item->getColor(),$item->getSize(),$item->getMaterial(),$item->getPath(),$item->getValue(),$item->getItemKey(),$item->getBrand(),$item->getState(),$item->getSeason(),$item->getExtras()))
				{
					if($stmt->execute())
					{
						echo "New item inserted. <br>";
						if($result = $this->db->query("SELECT itemID from item ORDER BY createdAt DESC"))
						{
							if($rowId = $result->fetch_row())
							{
								$item->setItemID((int)$rowId[0]);
								echo "Item id: " . $item->getItemID() . "<br>";
								if($stmtLink = $this->db->prepare("INSERT INTO di (drawerID,itemID) VALUES (?,?)"))
								{
									if($stmtLink->bind_param("ii",$drawerID,$item->getItemID()))
									{
										if($stmtLink->execute())
										{
											echo "Successfully added new item. <br>";
											$stmtLink->close();
											return true;
										} else
										{
											error_log("Couldn't execute stmtLink: " . $stmtLink->error,3,"errors.txt");
										}
									} else 
									{
										error_log("Couldn't bind param for link: " . $stmtLink->error,3,"errors.txt");
									}
								} else
								{
									error_log("Could't prepare stmtLink: " . $this->db->error,3,"errors.txt");
								}
							} else
							{
								error_log("No rows to be fetch for id.",3,"errors.txt");
							}
						} else
						{
							error_log("Couldn't execute query: " . $this->db->error,3,"errors.txt");
						}
					} else
					{
						error_log("Couldn't execute statement: " . $stmt->error,3,"errors.txt");
					}
				} else 
				{
					error_log("Couldn't prepare param: " . $stmt->error,3,"errors.txt");
				}
			} else
			{
				error_log("Couldn't prepare statement: " . $this->db->error,3,"errors.txt");
			}

			$stmt->close();
			return false;
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
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
					}
				} else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
			}

			$stmt->close();
			return false;
		}

		//search in the specified wardrobe
		public function searchAfterW($wardrobeID){
			if($stmt = $this->db->prepare("SELECT i.path,i.itemID,type, color, size, material, value, brand, extras, season, state
																FROM item i join di on i.itemID=di.itemID
																join drawer d on di.drawerID=d.drawerID
																join wd on d.drawerID=wd.drawerID
																join wardrobe w on wd.wardrobeID=w.wardrobeID
																 WHERE w.wardrobeID = ?"))
			{
				if($stmt->bind_param("i",$wardrobeID))
				{
					if($stmt->execute()){
						$result = $stmt->get_result();
						$resultStringArray=array();
						while($row = $result->fetch_row())
						{ 
							$stringRow="";
							//echo ("THIS OBJECT:") . "<br>";
							for($i=0;$i<sizeof($row);$i++)
								if($row[$i]!=NULL)
									{
										$row[$i] = strtolower($row[$i]);
										//echo $row[$i] . "<br>";
										$stringRow=$stringRow . '!' . $row[$i]. '!';
									}
							//echo $stringRow . "<br>";
							array_push($resultStringArray,$stringRow);
							
						}
						return $resultStringArray;
					}
					else
					{
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
					}
				} else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
			}

			return false;	
		}

		//search in all wardrobes for the specified user
		public function searchAfterU($userID){
			if($stmt = $this->db->prepare("SELECT i.path,i.itemID,type, color, size, material, value, brand, extras, season, state
																FROM item i join di on i.itemID=di.itemID
																join drawer d on di.drawerID=d.drawerID
																join wd on d.drawerID=wd.drawerID
																join wardrobe w on wd.wardrobeID=w.wardrobeID
																join uw on uw.wardrobeID=w.wardrobeID
																join user u on u.userID= uw.userID
																 WHERE u.userID = ?"))
			{
				if($stmt->bind_param("i",$userID))
				{
					if($stmt->execute()){
						$result = $stmt->get_result();
						$resultStringArray=array();
						while($row = $result->fetch_row())
						{ 
							$stringRow="";
							//echo ("THIS OBJECT:") . "<br>";
							for($i=0;$i<sizeof($row);$i++)
								if($row[$i]!=NULL)
									{
										$row[$i] = strtolower($row[$i]);
										//echo $row[$i] . "<br>";
										$stringRow=$stringRow . '!' . $row[$i]. '!';

									}
							//echo $stringRow . "<br>";
							//echo $stringRow . "<br>";
							array_push($resultStringArray,$stringRow);
							
						}
						return $resultStringArray;
					}
					else
					{
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
					}
				} else
				{
					error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
				}
			} else
			{
				error_log("Couldn't prepare stmt: " . $this->db->error,3,"errors.txt");
			}

			return false;	
		}
	}
?>