<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/DatabaseConnection.php");
require_once(__DIR__."/ActionMapper.php");

class WardrobeMapper {

	
	private $db;
	public function __construct(){
		$this->db = DatabaseConnection::getInstance();
	}

	public function selectAllWardrobes($userID){
		$sessionKey=0;
		if($stmt = $this->db->prepare("select * from wardrobe w join uw on w.wardrobeID=uw.wardrobeID where uw.userID=?"))
		{
			if($stmt->bind_param("i", $userID))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					$ids= array();
					$names= array();
					while($row = $result->fetch_row())
					{
						$wardrobeId = (int)$row[0];
						$wardrobeName = (string)$row[1];
						array_push($ids, $wardrobeId);
						array_push($names, $wardrobeName);
						//$sessionKey=$sessionKey+1;
						
					}
					//for DulappList view
					$_SESSION["wardrobeIDs"]=$ids;
					$_SESSION["wardrobeNames"]=$names;
				}
				else
					error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
			}
			else
			{
				error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
			}
		}
		if($sessionKey>=1)
			return true;
		return false;
	}

	public function updateWardrobeName($wardrobeID,$wardrobeName){
		if($stmt = $this->db->prepare("UPDATE wardrobe SET name=? WHERE wardrobeID = ?")){
			if($stmt->bind_param("si",$wardrobeName,$wardrobeID)){
				if($stmt->execute())
					 {
					 	echo "Successfully updated wardrobe name!" . "<br>";
					 	//the update was made so the current action should be inserted in "actions" table 
					 	$actionMapper = new ActionMapper();
					 	$action ='Update wardrobe name';
					 	$description='Wardrobe name was updated to ' . $wardrobeName . '.';
					 	//saves the current action in actions table
						return $actionMapper->save($wardrobeID,$action,$description);
					 } 
						
				else
						error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
			}
			else
				error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
		}
		else
			error_log("Couldn't prepare statement: " . $this->db->error,3,"errors.txt");
	}

	public function save($wardrobe,$userID){
		if($stmt = $this->db->prepare("INSERT INTO wardrobe (name,tag,createdAt) VALUES (?,?,CURRENT_TIMESTAMP)"))
		{
			if($stmt->bind_param("ss",$wardrobe->getName(),$wardrobe->getTag()))
			{
				if($stmt->execute())
				{
					if($resultId = $this->db->query("SELECT wardrobeID FROM wardrobe ORDER BY createdAt DESC"))
					{
						if($rowId = $resultId->fetch_row())
						{
							$wardrobe->setWardrobeID((int)$rowId[0]);
							echo "WardrobeId: " . $wardrobe->getWardrobeID() . "<br>";
							if($stmtLink = $this->db->prepare("INSERT INTO uw (userID,wardrobeID) VALUES (?,?)"))
							{
								if($stmtLink->bind_param("ii",$userID,$wardrobe->getWardrobeID()))
								{
									if($stmtLink->execute())
									{
										echo "successfully inserted new wardrobe.<br>";
										$actionMapper = new ActionMapper();
										$action = "Create wardrobe";
										$description = "The wardrobe was created.";

										return $actionMapper->save($wardrobe->getWardrobeID(),$action,$description);
									} else
									{
										error_log("Couldn't execute stmtLink: " . $stmtLink->error,3,'erorrs.txt');
									}
								} else
								{
									error_log("Couldn't bind params for stmtLink: " . $stmtLink->error,3,'errors.txt');
								}
							} else
							{
								error_log("Couldn't prepare stmtLink: " . $this->db->error,3,'errors.txt');
							}
						} else 
						{
							echo "No rows to fetch. <br>";
						}
					} else
					{
						error_log("Couldn't execute query for wardrobeId: " . $this->db->error,3,'errors.txt');
					}
				} else
				{
					error_log("Couldn't execute stmt: " . $stmt->error,3,'errors.txt');
				}
			} else
			{
				error_log("Couldn't bind param for stmt: " . $stmt->error,3,'errors.txt');
			}
		} else 
		{
			error_log("Couldn't prepare stmt: " . $stmt->error,3,'errors.txt');
		}
		$stmt->close();
		return false;
	}

	public function delete($wardrobe,$drawer,$drawerMapper,$item,$itemMapper){
		if($stmtWardrobe = $this->db->prepare("SELECT wardrobeID from wardrobe WHERE name = ?")){
			if($stmtWardrobe->bind_param("s",$wardrobe->getName())){
				if($stmtWardrobe->execute()){
					$resultWardrobe = $stmtWardrobe->get_result();
					if($rowW = $resultWardrobe->fetch_array()){
						$wardrobe->setWardrobeID((int)$rowW[0]);
						echo $wardrobe->getWardrobeID();
					} else {
						error_log("Couldn't fetch row.",3,'erros.txt');
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

		if($stmtLink = $this->db->prepare("SELECT drawerID FROM wd JOIN wardrobe ON wardrobe.wardrobeID = wd.wardrobeID WHERE wardrobe.name = ?"))
		{
			if($stmtLink->bind_param("s",$wardrobe->getName()))
			{
				if($result = $stmtLink->execute())
				{
					$result = $stmtLink->get_result();
					if($result->num_rows > 0){
						while($row = $result->fetch_row()){
							$drawer->setDrawerID((int)$row[0]);
							$drawerMapper->delete($drawer,$item,$itemMapper,$wardrobe->getWardrobeID());
						}
						echo "Finished deleting drawers.<br>";
					}
					if($stmt = $this->db->prepare("DELETE FROM wardrobe WHERE name = ?"))
					{
						if($stmt->bind_param("s",$wardrobe->getName()))
						{
							if($stmt->execute())
							{
								echo "Successfully deleted wardorbe.<br>";
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
			error_log("Couldn't prepare the stmtLink: " . $this->db->error,3,'errors.txt');
		}
		$stmtLink->close();
		return false;
	}
}
?>