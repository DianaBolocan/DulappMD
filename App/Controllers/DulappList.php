<?php
	session_start();
	require_once(__DIR__."/../Models/WardrobeMapper.php");
	echo "Wardrobe are a property of the user: " . $_SESSION["userID"] . ".<br>";
	
	class DulappList extends Controller{
		public function print(){
			$this->view('DulappList');
			//echo 'am ajuns aici!';
			$userID=$_SESSION["userID"] ;
			$wardrobeMapper = new WardrobeMapper();
			$selectResult=$wardrobeMapper->selectAllWardrobes($userID);
			echo $selectResult;
	        if($selectResult=="false")
	        {
	        	echo 'Userul curent nu are vreun dulap';			
	        }
	        else
	        {
	        	echo 'Userul curent are dulapuri';
	        }	
		}
	}
?>