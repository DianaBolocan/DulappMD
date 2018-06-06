<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");

	class DrawerMapper{
		private $db;

		public function __construct(){
			$this->db = DatabaseConnection::getInstance();
		}

		public function selectFromWardrobe($wardrobeID){
		$sessionKey=0;
		if($stmt = $this->db->prepare("select * from drawer d join wd on d.drawerID=wd.drawerID where wd.wardrobeID=?"))
		{
			if($stmt->bind_param("i", $wardrobeID))
				{
					if($stmt->execute()){
						$result = $stmt->get_result();
						$ids= array();
						while($row = $result->fetch_row())
						{
							$drawerId = (int)$row[0];
							array_push($ids, $drawerId);
							/*echo " DrawerId: " . $drawerId . ",";

							$drawerKey = (string)$row[1];
							echo " DrawerKey: " . $drawerKey . ",";
							
							$createdAt = (string)$row[2];
							echo " DrawerCreatedAt: " . $createdAt . "<br>";	

							echo "<a href='".'http://localhost/DulappMD/Public/Catalog?sessionKey='.$sessionKey."'>Link</a>" . "<br>";
							*/
							$sessionKey=$sessionKey+1;
							
						}
						$_SESSION["drawerIDs"]=$ids;
						
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
		if($sessionKey>=1)
			return true;
		return false;
	}
	
		public function save($drawer,$wardrobeID){
			if($stmt = $this->db->prepare("SELECT COUNT(drawerId) FROM wd WHERE wardrobeId = ?"))
			{
				if($stmt->bind_param("i",$wardrobeID))
				{
					if($stmt->execute())
					{
						if($result = $stmt->get_result())
						{
							if($row = $result->fetch_row())
							{
								echo "Number of drawers: " . $row[0] . "<br>";
								if ($row[0] < 6)
								{
									if($this->db->query("INSERT INTO drawer (drawerKey,createdAt) VALUES (NULL,CURRENT_TIMESTAMP)"))
									{
										if($resultId = $this->db->query("SELECT drawerId FROM drawer ORDER BY createdAt DESC"))
										{
											if($rowId = $resultId->fetch_row())
											{
												$drawer->setDrawerID((int)$rowId[0]);
												echo "DrawerId fetched: " . $drawer->getDrawerID() . "<br>";
												if ($stmtLink = $this->db->prepare("INSERT INTO wd (wardrobeId,drawerId) VALUES (?,?)"))
												{
													if($stmtLink->bind_param("ii",$wardrobeID,$drawer->getDrawerID()))
													{
														if($stmtLink->execute()) {
															echo "Successfully added new drawer. <br>";
															return true;
															$stmtLink->close();
														} else 
														{
															error_log("Couldn't insert new link: " . $stmtLink->error);
														}
													} else
													{
														error_log("Couldn't bind param for link: " . $stmtLink->error);
													}
												} else 
												{
													error_log("Couldn't prepare wd statement: " . $this->db->error);
												}
											} else
											{
												error_log("No rows to be fetched for id.");
											}
										}else 
										{
											error_log("Failed to get resultId: " . $this->db->error);
										}
									} else
									{
										error_log("Couldn't execute query: " . $this->db->error);
									}
								} else 
								{
									echo "Number of drawers was reached. Cannot add other drawers. <br>";
								}
							} else 
							{
								error_log("No rows to be fetched.");
							}
						} else 
						{
							error_log("Failed to get results: " . $stmt->error);
						}
					} else 
					{
						error_log("Failed to execute: " . $stmt->error);
					}
				} else {
					error_log("Couldn't bind params: " . $stmt->error);
				} 
			} else
			{
				error_log("Failed to prepare statement: " . $this->db->error); 
			}

			$stmt->close();
			return false;
		}

		public function delete($drawer,$item,$itemMapper){
			if($stmtLink = $this->db->prepare("SELECT itemID FROM di WHERE drawerId = ?"))
			{
				if($stmtLink->bind_param("i",$drawer->getDrawerID()))
				{
					if($stmtLink->execute())
					{
						$result = $stmtLink->get_result();
						if($result->num_rows > 0){
							while($row = $result->fetch_row()){
								$item->setItemID((int)$row[0]);
								$itemMapper->delete($item);
							}
							echo "Finished deleting items.<br>";
						}
						if($stmt = $this->db->prepare("DELETE FROM drawer WHERE drawerID = ?"))
						{
							if($stmt->bind_param("i",$drawer->getDrawerID()))
							{
								if($stmt->execute())
								{
									echo "Successfully delete drawer.<br>";
									$stmt->close();
									return true;
								} else
								{
									error_log("Couldn't execute stmt: " . $stmt->error,3,'errors.txt');
								}
							} else
							{
								error_log("Couldn't bind params for stmt: " . $stmt->error,3,'errors.txt');
							}
						} else
						{
							error_log("Couldn't prepare stmt: " . $this->db->error,3,'errors.txt');
						}
					} else
					{
						error_log("Couldn't execute stmtLink: " . $stmtLink->error,3,'errors.txt');
					}
				} else
				{
					error_log("Couldn't bind params for stmtLink: " . $stmtLink->error,3,'errors.txt');
				}
			} else
			{
				error_log("Couldn't prepare stmtLink: " . $this->db->error,3,'errors.txt');
			}
			$stmtLink->close();
			return false;
		}
	}
?>