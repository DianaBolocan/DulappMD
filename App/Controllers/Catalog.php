<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class Catalog extends Controller{
		public function print(){
			$drawerID = $_GET["drawerID"];
			$_SESSION['drawerID']=$drawerID;
			//echo 'Current drawer(received through URL): ' . $drawerID . "<br>";
			//echo 'Current wardrobe(received through session):' . $_SESSION['wardrobeID'];
			$itemMapper = $this->mapper('ItemMapper');
			$selectResult=$itemMapper->selectFromDrawer($drawerID);
	        $this->view('Catalog');
		}


		public function delete(){
			$item = $this->model('Item');
			$itemMapper = $this->model('ItemMapper');
			$item->setItemID(3); //$_SESSION["itemID"]
			$itemMapper->delete($item);
			header('Location: http://localhost/DulappMD/Public/Catalog');
		}
	}
?>