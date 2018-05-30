<?php

class Wardrobe{
	
	private $wardrobeID;
	private $name;
	private $tag;
	private $createdAt;
}

	public function __construct($wardrobeID=NULL, $name=NULL, $tag=NULL, $createdAt=NULL) {
		$this->wardrobeID = $wardrobeID;
		$this->name = $name;
		$this->tag = $tag;
		$this->createdAt = $createdAt;
	}
    // should be an object wardrobe as parameter
	public function addWardrobe($userId,$wardrobeName,$wardrobeTag){
		$conn = new mysqli("localhost","root","","dulappmd");
		if($conn->connect_errno){
			echo "failed to connect to MySql: " . $conn->connect_error . "<br>";
		} 
		echo "Connected successfully. <br>";

		if($stmt = $conn->prepare("INSERT INTO wardrobe (name,tag,createdAt) VALUES (?,?,CURRENT_TIMESTAMP)"))
		{
			if($stmt->bind_param("ss",$wardrobeName,$wardrobeTag))
			{
				if($stmt->execute())
				{
					if($resultId = $conn->query("SELECT wardrobeID FROM wardrobe ORDER BY createdAt DESC"))
					{
						if($rowId = $resultId->fetch_row())
						{
							$wardrobeId = (int)$rowId[0];
							echo "WardrobeId: " . $wardrobeId . "<br>";
							if($stmtLink = $conn->prepare("INSERT INTO uw (userID,wardrobeID) VALUES (?,?)"))
							{
								if($stmtLink->bind_param("ii",$userId,$wardrobeId))
								{
									if($stmtLink->execute())
									{
										echo "successfully inserted new wardrobe.<br>";
										$stmtLink->close();
									} else
									{
										echo "Couldn't execute stmtLink: " . $stmtLink->error . "<br>";
									}
								} else
								{
									echo "Couldn't bind params for stmtLink: " . $stmtLink->error . "<br>";
								}
							} else
							{
								echo "Couldn't prepare stmtLink: " . $conn->error . "<br>";
							}
						} else 
						{
							echo "No rows to fetch. <br>";
						}
					} else
					{
						echo "Couldn't execute query for wardrobeId: " . $conn->error . "<br>";
					}
				} else
				{
					echo "Couldn't execute stmt: " . $stmt->error . "<br>";
				}
			} else
			{
				echo "Couldn't bind param for stmt: " . $stmt->error . "<br>";
			}
		} else 
		{
			echo "Couldn't prepare stmt: " . $stmt->error . "<br>";
		}

		$stmt->close();
		$conn->close();
	}
?>