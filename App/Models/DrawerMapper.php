<?php
	require_once(__DIR__."/../core/DatabaseConnection.php");
	require_once(__DIR__."/ActionMapper.php");

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
	
		public function check($drawer){
			if($drawer->getDrawerKey() == NULL){
				//userul nu a introdus key
				if($stmtCheck = $this->db->prepare("SELECT drawerID FROM drawer WHERE drawerID = ? AND drawerKey is NULL"))
				{
					$drawerID=(int)$drawer->getDrawerID();
					if($stmtCheck->bind_param("i",$drawerID))
					{
						if($stmtCheck->execute())
						{
							$result = $stmtCheck->get_result();
							if($result->num_rows == 1)
							{
								//returnez true, fara cheie';
								return true;
							}
						} else 
						{
							error_log("Couldn't execute stmtCheck: " . $stmtCheck->error,3,'errors.txt');
							return false;
						}
					} else 
					{
						error_log("Couldn't bind params for stmtCheck: " . $stmtCheck->error,3,'errors.txt');
						return false;
					}
				} else 
				{
					error_log("Couldn't prepare stmtCheck: " . $this->db->error,3,'errors.txt');
					return false;
				}
			}
			else {
				//userul a introdus key
				if($stmtCheck = $this->db->prepare("SELECT drawerID FROM drawer WHERE drawerID = ? AND (drawerKey = ? OR drawerKey is NULL)"))
				{
					$drawerKey=$drawer->getDrawerKey();
					$drawerID=$drawer->getDrawerID();
					if($stmtCheck->bind_param("is",$drawerID,$drawerKey))
					{
						if($stmtCheck->execute())
						{
							$result = $stmtCheck->get_result();
							if($result->num_rows == 1)
							{
								//returnez true, cheia se potriveste sau drawer fara key';
								return true;
							}
						} else 
						{
							error_log("Couldn't execute stmtCheck: " . $stmtCheck->error,3,'errors.txt');
							return false;
						}
					} else 
					{
						error_log("Couldn't bind params for stmtCheck: " . $stmtCheck->error,3,'errors.txt');
						return false;
					}
				} else 
				{
					error_log("Couldn't prepare stmtCheck: " . $this->db->error,3,'errors.txt');
					return false;
				}
			}
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
									if($stmtDrawer = $this->db->prepare("INSERT INTO drawer (drawerKey,createdAt) VALUES (?,CURRENT_TIMESTAMP)"))
									{
										if($stmtDrawer->bind_param("s",$drawer->getDrawerKey()))
										{
											if($stmtDrawer->execute())
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
																	$actionMapper = new ActionMapper();
																	$action = 'Add new drawer';
																	$description = 'Drawer ' . $drawer->getDrawerID() . ' has been added to wardrobe.';
																	$actionMapper->save($wardrobeID,$action,$description);
																	return true;
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
												error_log("Couldn't execute stmtDrawer:" . $stmtDrawer->error,3,'errors.txt');
											}
										} else
										{
											error_log("Couldn't bind params for stmtDrawer:" . $stmtDrawer->error,3,'errors.txt');
										}
									} else
									{
										error_log("Couldn't prepare stmtDrawer: " . $stmtDrawer->error,3,'errors.txt');
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
							error_log("Failed to get results: " . $stmt->error,3,'errors.txt');
						}
					} else 
					{
						error_log("Failed to execute: " . $stmt->error,3,'errors.txt');
					}
				} else {
					error_log("Couldn't bind params: " . $stmt->error,3,'errors.txt');
				} 
			} else
			{
				error_log("Failed to prepare statement: " . $this->db->error,3,'errors.txt'); 
			}
			$stmtDrawer->close();
			$stmt->close();
			return false;
		}

		public function delete($drawer,$item,$itemMapper,$wardrobeID){
			if($drawer->getDrawerKey() == NULL){
				if($stmtCheck = $this->db->prepare("SELECT drawerID FROM drawer WHERE drawerID = ? AND drawerKey is NULL"))
				{
					if($stmtCheck->bind_param("i",$drawer->getDrawerID()))
					{
						if($stmtCheck->execute())
						{
							$result = $stmtCheck->get_result();
							if($result->num_rows == 0)
							{
								$actionMapper = new ActionMapper();
								$action = 'Delete drawer';
								$description = 'Drawer ' . $drawer->getDrawerID() . ' has been removed from wardrobe.';
								$actionMapper->save($wardrobeID,$action,$description);
								return true;
							}
						} else 
						{
							error_log("Couldn't execute stmtCheck: " . $stmtCheck->error,3,'errors.txt');
							return false;
						}
					} else 
					{
						error_log("Couldn't bind params for stmtCheck: " . $stmtCheck->error,3,'errors.txt');
						return false;
					}
				} else 
				{
					error_log("Couldn't prepare stmtCheck: " . $this->db->error,3,'errors.txt');
					return false;
				}
			} else {
				if($stmtCheck = $this->db->prepare("SELECT drawerID FROM drawer WHERE drawerID = ? AND (drawerKey = ? OR drawerKey is NULL)"))
				{
					if($stmtCheck->bind_param("is",$drawer->getDrawerID(),$drawer->getDrawerKey()))
					{
						if($stmtCheck->execute())
						{
							$result = $stmtCheck->get_result();
							if($result->num_rows == 0)
							{
								$actionMapper = new ActionMapper();
								$action = 'Delete drawer';
								$description = 'Drawer ' . $drawer->getDrawerID() . ' has been removed from wardrobe.';
								$actionMapper->save($wardrobeID,$action,$description);
								return true;
							}
						} else 
						{
							error_log("Couldn't execute stmtCheck: " . $stmtCheck->error,3,'errors.txt');
							return false;
						}
					} else 
					{
						error_log("Couldn't bind params for stmtCheck: " . $stmtCheck->error,3,'errors.txt');
						return false;
					}
				} else 
				{
					error_log("Couldn't prepare stmtCheck: " . $this->db->error,3,'errors.txt');
					return false;
				}
			}
			
			$stmtCheck->close();

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