<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class DulapSelected extends Controller{
		public function print(){
			if(isset($_SESSION["userID"])){
				$this->view('DulapSelected');
				//myKey=sessionKey-ul primit in URL si la cheia respectiva va fi value=wardrobeID
				$myKey = $_GET['sessionKey'];
				$wardrobeID=$_SESSION['wardrobeIDs'][$myKey];
				echo 'Current wardrobe(received through session): ' . $wardrobeID . "<br>";
				$_SESSION['wardrobeID']=$wardrobeID;
				$drawerMapper=$this->mapper('DrawerMapper');
				$selectResult=$drawerMapper->selectFromWardrobe($wardrobeID);
				if($selectResult==false)
		        {
		        	echo 'Dulap gol';			
		        }
		        else
		        {
		      	 	echo 'Continut dulap curent:';
		        }
		    }
		}

		public function save(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			$drawerMapper->save($drawer,2);
			header('Location: http://localhost/DulappMD/Public/DulapSelected');
		}

		public function delete(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			//$drawerMapper->delete($drawer);
			//header('Location: http://localhost/DulappMD/Public/DulapSelected');
		}

		public function main(){
			$wardrobeID=$_SESSION['wardrobeID'];
			if($_POST){
    			if(isset($_POST['Update'])){
    				$newName=($_POST['newName']);
    				$wardrobeMapper = $this->mapper('WardrobeMapper');
					$selectResult=$wardrobeMapper->updateWardrobeName($wardrobeID,$newName);
    				//header('Location: '.' http://localhost/DulappMD/Public/DulapSelected');
    			}
			}
		}
	}
?>