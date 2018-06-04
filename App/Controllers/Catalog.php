<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class Catalog extends Controller{
		public function print(){
			$this->view('Catalog');
			$myKey = $_GET['sessionKey'];
			$drawerID=$_SESSION['drawerIDs'][$myKey];
			echo 'Current drawer(received through session): ' . $drawerID . "<br>";
			$itemMapper = $this->mapper('ItemMapper');
			$selectResult=$itemMapper->selectFromDrawer($drawerID);
			if($selectResult==false)
	        {
	        	echo 'Sertar gol';			
	        }
	        else
	        {
	      	 	echo 'Continutul sertarului curent a fost printat anterior';
	        }
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