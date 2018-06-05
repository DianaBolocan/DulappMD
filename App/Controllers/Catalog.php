<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class Catalog extends Controller{
		public function print(){
			//$myKey = $_GET['sessionKey'];
			//$drawerID=$_SESSION['drawerIDs'][$myKey];
			$drawerID = $_GET['drawerID'];
			$_SESSION['drawerID']=$drawerID;
			//echo 'Current drawer(received through session): ' . $drawerID . "<br>";
			$itemMapper = $this->mapper('ItemMapper');
			$selectResult=$itemMapper->selectFromDrawer($drawerID);
			if($selectResult==false)
	        {
	        	//echo 'Sertar gol';			
	        }
	        else
	        {
	      	 	//echo 'Continutul sertarului curent a fost printat anterior';
	        }
	        $this->view('Catalog');
		}


		public function delete(){
			$item = $this->model('Item');
			$itemMapper = $this->model('ItemMapper');
			$item->setItemID(7); //$_SESSION["itemID"]
			$itemMapper->delete($item);
			header('Location: http://localhost/DulappMD/Public/Catalog');
		}
	}
?>