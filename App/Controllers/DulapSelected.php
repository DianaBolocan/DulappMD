<?php
	session_start();
	require_once(__DIR__."/../Models/DrawerMapper.php");
	require_once(__DIR__."/../Models/WardrobeMapper.php"); //for update
	class DulapSelected extends Controller{
		public function print(){
			$this->view('DulapSelected');
			
			//aray: nrOfSession-wardrobeID
			//foreach($_SESSION['wardrobeIDs'] as $key=>$value)
		    //{
		    // and print out the values
		    //echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
		    //}
			//myKey=sessionKey-ul primit in URL si la cheia respectiva va fi value=wardrobeID
			$myKey = $_GET['sessionKey'];
			$wardrobeID=$_SESSION['wardrobeIDs'][$myKey];
			echo 'Current wardrobe(received through session): ' . $wardrobeID . "<br>";
			//$_SESSION['wardrobeID']=$wardrobeID;
			$drawerMapper = new DrawerMapper();
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

		public function save(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			$drawerMapper->save($drawer,2);
			//header('Location: http://localhost/DulappMD/Public/DulapSelected');
		}

		public function delete(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			//$drawerMapper->delete($drawer);
			//header('Location: http://localhost/DulappMD/Public/DulapSelected');
		}

		public function main(){
			echo $_SERVER['REQUEST_URI'] . "<br>";
			//$myKey = $_GET['sessionKey'];
			if (isset($_GET['sessionKey'])) {
   				 echo $_GET['sessionKey'];
   				 $myKey = $_GET['sessionKey'];
			} else {
				echo 'nu e nimic pe sessionkey' . "<br>";
			}
			$wardrobeID=$_SESSION['wardrobeIDs'][1];
			//$wardrobeID=$_SESSION['wardrobeID'];
			
			if($_POST){
    			if(isset($_POST['Update'])){
    				$newName=($_POST['newName']);
    				$wardrobeMapper = new WardrobeMapper();
					$selectResult=$wardrobeMapper->updateWardrobeName($wardrobeID,$newName);
					//doesn't redirect
    				//header('Location: '.' http://localhost/DulappMD/Public/DulapSelected');
    			}
			}
		}
	}
?>