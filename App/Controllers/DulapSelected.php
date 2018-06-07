<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class DulapSelected extends Controller{
		public function print(){
			if(isset($_SESSION["userID"])){
				//wardrobeID is received through URL
				$wardrobeID = $_GET['wardrobeID'];
				$_SESSION['wardrobeID']=$wardrobeID;
				$drawerMapper=$this->mapper('DrawerMapper');
				$selectResult=$drawerMapper->selectFromWardrobe($wardrobeID);
		        $this->view('DulapSelected');  
		    }
		}

		public function save(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			if(isset($_POST['saveSubmit'])){
				$drawer->setDrawerKey($_POST['drawerLock']);
			}
			$wardrobeID = $_SESSION['wardrobeID'];
			$drawerMapper->save($drawer,$wardrobeID);
			header('Location: http://localhost/DulappMD/Public/DulapSelected?wardrobeID=' . $wardrobeID);
		}

		public function delete(){
			if($_POST){
				if(isset($_POST['deleteSubmit'])){
					$drawer = $this->model('Drawer');
					$drawer->setDrawerID((int)$_POST['drawerID']);
					if($_POST['drawerKey'] != ''){
						$drawer->setDrawerKey($_POST['drawerKey']);
					}
					$drawerMapper = $this->mapper('DrawerMapper');
					$item = $this->model('Item');
					$itemMapper = $this->mapper('ItemMapper');
					$drawerMapper->delete($drawer,$item,$itemMapper);
					$wardrobeID= $_SESSION['wardrobeID'];
					header('Location: http://localhost/DulappMD/Public/DulapSelected?wardrobeID=' . $wardrobeID);
				}	
			}
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