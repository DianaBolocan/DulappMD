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

		public function check(){
			if($_POST){
				if(isset($_POST['enterDrawerSubmit'])){
					//get drawerID from URL
					$drawerID= $_GET['drawerID'];
					$drawer = $this->model('Drawer');
					$drawer->setDrawerID($drawerID);
					if($_POST['drawerKey'] != ''){
						$drawer->setDrawerKey($_POST['drawerKey']);
					}
					$drawerMapper = $this->mapper('DrawerMapper');
					//$item = $this->model('Item');
					//$itemMapper = $this->mapper('ItemMapper');
					if($drawerMapper->check($drawer))
						{
							echo 's-a returnat true';
							$_SESSION['drawerID']=$drawerID;
							echo '<br> Current drawer(received through URL): ' . $drawerID . "<br>";
							echo 'Current wardrobe(received through session):' . $_SESSION['wardrobeID'];
							$itemMapper = $this->mapper('ItemMapper');
							//echo $drawerID;
							$selectResult=$itemMapper->selectFromDrawer($drawerID);
							$_SESSION["message"]="enterDrawer";
							header('Location: http://localhost/DulappMD/Public/Catalog?drawerID=' . $drawerID);
						}
					else
						echo 's-a returnat false';
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
    			if(isset($_POST['exportJSON'])){

    				$itemMapper = $this->mapper('ItemMapper');
					$selectResult=$itemMapper->searchAfterW($wardrobeID);
					$posts = array();
					for($i=0;$i<sizeof($selectResult);$i++){
						$currentItem=$selectResult[$i];
						$posts[] = array('val1'=> $currentItem, 'val2'=> $currentItem);
					}
					$response['posts'] = $posts;

					//unlink('results.json');
					$fp = fopen('results.json', 'w');
					fwrite($fp, json_encode($response));
					fclose($fp);

					$filename = 'results.json'; // of course find the exact filename....        
					header('Pragma: public');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private', false); // required for certain browsers 
					header('Content-Type: application/json');

					header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
					header('Content-Transfer-Encoding: binary');
					header('Content-Length: ' . filesize($filename));

					readfile($filename);

					exit;

				}
		}
	}
}
?>