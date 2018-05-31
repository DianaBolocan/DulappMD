<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		//header('Location: '.' http://localhost/DulappMD/Public/HomePage');
		echo 'You are not logged in!';
	}
	require_once(__DIR__."/../Models/WardrobeMapper.php");
	//echo "Current user(received through session): " . $_SESSION["userID"] . ".<br>";
	
	class DulappList extends Controller{
		public function print(){
			if(isset($_SESSION["userID"])){
				$this->view('DulappList');
				//echo 'am ajuns aici!';
				$userID=$_SESSION["userID"] ;
				$wardrobeMapper = new WardrobeMapper();
				$selectResult=$wardrobeMapper->selectAllWardrobes($userID);
		        if($selectResult==false)
		        {
		        	echo 'Userul curent nu are vreun dulap';			
		        }
		        else
		        {
		        	echo 'Userul curent are dulapurile mentionate anterior';
		        }	
			}
		}
	}
	
?>