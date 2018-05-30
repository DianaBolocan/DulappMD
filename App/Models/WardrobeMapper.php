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
		$stmt = $this->db->prepare("select * from wardrobe w join uw on w.wardrobeID=uw.wardrobeID where uw.userID=?");
		if($stmt->bind_param("i", $userID))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					while($row = $result->fetch_row())
					{
						$wardrobeId = (int)$row[0];
						echo " WardrobeId: " . $wardrobeId . ",";

						$name = (string)$row[1];
						echo " WardrobeName: " . $name . ",";
						
						$tag = (string)$row[2];
						echo " WardrobeTag: " . $tag . "<br>";	
					}
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
		return false;
	}
	
	//should finish it
	public function selectFromWardrobe($wardrobe){
		$stmt = $this->db->prepare("select * from wardrobe where wardrobeID=?");
		$wardrobeID=$wardrobe->getWardrobeID();
		if($stmt->bind_param("i", $wardrobeID))
			{
				if($stmt->execute()){
					$result = $stmt->get_result();
					return true;
				}
				else
					echo "couldn't execute" . $mysqli->error;
			}
		else
			{
				echo "Couldn't bind params for stmt: " . $stmt->error . "<br>";
			}
		return false;

	}
}
?>