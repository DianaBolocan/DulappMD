<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/DatabaseConnection.php");

class WardrobeMapper {

	
	private $db;
	public function __construct() {
		$this->db = DatabaseConnection::getInstance();
	}

	public function selectAllWardrobes($userID)
	{
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
						/*echo " WardrobeId: " . $wardrobeId . ",";

						$name = (string)$row[1];
						echo " WardrobeName: " . $name . ",";
						
						$tag = (string)$row[2];
						echo " WardrobeTag: " . $tag . ",";	

						echo "<a href='".'http://localhost/DulappMD/Public/DulapSelected?sessionKey='.$sessionKey."'>Link</a>" . "<br>";
						*/
						$sessionKey=$sessionKey+1;
						
					}
					$_SESSION["wardrobeIDs"]=$ids;
					$_SESSION["wardrobeNames"]=$names;
					//else 
					//{
					//		echo "No rows to fetch. <br>";
					//}
					//return 'true';
				}
				else
					error_log("Couldn't execute the stmt: " . $stmt->error,3,"errors.txt");
			}
			else
			{
				error_log("Couldn't bind params for stmt: " . $stmt->error,3,"errors.txt");
			}
		}
			//daca are un singur dulap returneaza false?
		if($sessionKey>=1)
			return true;
		return false;
	}

	public function updateWardrobeName($wardrobeID,$wardrobeName)
	{
		if($stmt = $this->db->prepare("UPDATE wardrobe SET name=? WHERE wardrobeID = ?")){
			if($stmt->bind_param("si",$wardrobeName,$wardrobeID)){
				if($stmt->execute())
					  echo "Successfully updated wardrobe name!" . "<br>";
						
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
										$stmtLink->close();
										return true;
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

	public function delete($wardrobe,$userID){
		if($stmtLink = $this->db->prepare("SELECT wardrobeID FROM wardrobe JOIN uw ON wardrobe.wardrobeID = uw.wardrobeID JOIN user ON user.userID = uw.userID WHERE name = ?"))
		{
			
		} else 
		{
			error_log("Couldn't prepare the stmtLink: " . $this->db->error,3,'errors.txt');
		}

		$stmtLink->close();
	}
}
?>