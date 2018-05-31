<?php
	session_start();
	require_once(__DIR__."/../Models/ItemMapper.php");
	class Catalog extends Controller{
		public function print(){
			$this->view('Catalog');
			$myKey = $_GET['sessionKey'];
			$drawerID=$_SESSION['drawerIDs'][$myKey];
			echo 'Current drawer(received through session): ' . $drawerID . "<br>";
			$itemMapper = new ItemMapper();
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
			$item->setItemID(7);
			$itemMapper->delete($item);
			//header('Location: http://localhost/DulappMD/Public/Catalog')
		}
	}
?>