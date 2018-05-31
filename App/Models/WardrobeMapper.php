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
		$stmt = $this->db->prepare("select * from wardrobe w join uw on w.wardrobeID=uw.wardrobeID where uw.userID=?");
		if($stmt->bind_param("i", $userID))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					$ids= array();
					while($row = $result->fetch_row())
					{
						$wardrobeId = (int)$row[0];
						
						array_push($ids, $wardrobeId);
						echo " WardrobeId: " . $wardrobeId . ",";

						$name = (string)$row[1];
						echo " WardrobeName: " . $name . ",";
						
						$tag = (string)$row[2];
						echo " WardrobeTag: " . $tag . ",";	

						echo "<a href='".'http://localhost/DulappMD/Public/DulapSelected?sessionKey='.$sessionKey."'>Link</a>" . "<br>";
						$sessionKey=$sessionKey+1;
						
					}
					$_SESSION["wardrobeIDs"]=$ids;
					//else 
					//{
					//		echo "No rows to fetch. <br>";
					//}
					//return 'true';
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		else
			{
				echo "Couldn't bind params for stmt: " . $stmt->error . "<br>";
			}
			//daca are un singur dulap returneaza false?
		if($sessionKey>=1)
			return true;
		return false;
	}

	public function updateWardrobeName($wardrobeID,$wardrobeName)
	{
		if(!($stmt = $this->db->prepare("UPDATE wardrobe SET name=? WHERE wardrobeID = ?"))){
			echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
		}
		
		if($stmt->bind_param("si",$wardrobeName,$wardrobeID)){
			if($stmt->execute())
				  echo "Successfully updated wardrobe name!" . "<br>";
					
			else
					 echo "Couldn't execute stmt: " . $stmt->error . "<br>";
		}
		else
        {
            echo "Couldn't bind params for stmt: " . $stmt->error . "<br>";
        }
	}
	
}
?>