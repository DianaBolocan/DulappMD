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
			if(isset($_SESSION['userID'])){
				$drawer = $this->model('Drawer');
				$drawerMapper = $this->mapper('DrawerMapper');
				$drawerMapper->save($drawer,$_SESSION['userID']);
				header('Location: http://localhost/DulappMD/Public/DulapSelected');
			} else {
				error_log("There was no userID.",3,'errors.txt');
			}
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
    			if(isset($_POST['searchAfterW'])){
    				$itemMapper = $this->mapper('ItemMapper');
    				$allItems=$itemMapper->searchAfterW($wardrobeID);
    				$searchParams=($_POST['searchParams']);
    				$searchParams = strtolower($searchParams);
    				$params = explode(" ", $searchParams); //parsing received params through post method
					for($j=0;$j<sizeof($params);$j++)
						$params[$j]='!'. $params[$j] . '!';
					$searchExistence=0;
					for($i=0;$i<sizeof($allItems);$i++)
						{
							$currentSearchExistence=1;
							for($j=0;$j<sizeof($params);$j++)
							if(strstr($allItems[$i],$params[$j])==false)
								$currentSearchExistence=0;
							if($currentSearchExistence==1)
							{
								//trebuie sa retin lista de id-uri!
								$searchExistence=1;
							}
						}
					if($searchExistence==0)
						echo 'No result for your search';
					if($searchExistence==1)
						//should print correspondent images
						echo 'Succes';
    			}
			}
		}
	}
?>