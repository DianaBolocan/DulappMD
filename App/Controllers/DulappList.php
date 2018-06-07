<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		//header('Location: '.' http://localhost/DulappMD/Public/HomePage');
		echo 'You are not logged in!';
	}
	//echo "Current user(received through session): " . $_SESSION["userID"] . ".<br>";
	class DulappList extends Controller{
		public function print(){
			if(isset($_SESSION["userID"])){
				$userID=$_SESSION["userID"] ;
				$wardrobeMapper = $this->mapper('WardrobeMapper');
				$selectResult=$wardrobeMapper->selectAllWardrobes($userID);
		        if($selectResult==false)
		        {
		        	$_SESSION["messages"]='Userul curent nu are vreun dulap';		
		        }
		        else
		        {
		        	$_SESSION["messages"]='Userul curent are dulapurile mentionate anterior';
		        }	
		        $this->view('DulappList');
			}
		}

		public function main(){
			
			
		}


		public function save(){
			$userID = $_SESSION['userID'];
			if($_POST){
				if(isset($_POST['saveSubmit'])){
					$wardrobe = $this->model('Wardrobe');
					$wardrobe->setName($_POST['wardrobeName']);
					$wardrobe->setTag($_POST['wardrobeTags']);
					$wardrobeMapper = $this->mapper('WardrobeMapper');
					$wardrobeMapper->save($wardrobe,$userID);
					header('Location: http://localhost/DulappMD/Public/DulappList');
				}
			}
		}

		public function delete(){
			$userID = $_SESSION['userID'];
			if($_POST){
				if(isset($_POST['deleteSubmit'])){
					$wardrobe = $this->model('Wardrobe');
					$wardrobe->setName($_POST['wardrobeName']);
					$wardrobeMapper = $this->mapper('WardrobeMapper');
					$drawer = $this->model('Drawer');
					$drawerMapper = $this->mapper('DrawerMapper');
					$item = $this->model('Item');
					$itemMapper = $this->mapper('ItemMapper');
					$wardrobeMapper->delete($wardrobe,$drawer,$drawerMapper,$item,$itemMapper);
					header('Location: http://localhost/DulappMD/Public/DulappList');
				}
			}
		}
	}
	
?>