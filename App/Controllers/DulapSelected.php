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
					$wardrobeID= $_SESSION['wardrobeID'];
					echo $wardrobeID;
					$drawer = $this->model('Drawer');
					$drawer->setDrawerID((int)$_POST['drawerID']);
					if($_POST['drawerKey'] != ''){
						$drawer->setDrawerKey($_POST['drawerKey']);
					}
					$drawerMapper = $this->mapper('DrawerMapper');
					$item = $this->model('Item');
					$itemMapper = $this->mapper('ItemMapper');
					$drawerMapper->delete($drawer,$item,$itemMapper,$wardrobeID);
					header('Location: http://localhost/DulappMD/Public/DulapSelected?wardrobeID=' . $wardrobeID);
				}	
			}
		}

		public function check(){
			if($_POST){
				if(isset($_POST['enterDrawerSubmit'])){
					//get drawerID from URL
					$drawerID= $_GET['drawerID'];
					//the drawer will be given as parameter
					$drawer = $this->model('drawer');
					$drawer->setDrawerID($drawerID);
					if($_POST['drawerKey'] != ''){
						$drawer->setDrawerKey($_POST['drawerKey']);
					}
					$drawerMapper = $this->mapper('DrawerMapper');
					if($drawerMapper->check($drawer))
						{
							$_SESSION['drawerID']=$drawerID;
							//echo '<br> Current drawer(received through URL): ' . $drawerID . "<br>";
							//echo 'Current wardrobe(received through session):' . $_SESSION['wardrobeID'];
							$itemMapper = $this->mapper('ItemMapper');
							$selectResult=$itemMapper->selectFromDrawer($drawerID);
							//$_SESSION["message"]="enterDrawer";
							header('Location: http://localhost/DulappMD/Public/Catalog?drawerID=' . $drawerID);
						}
					else
						{
							//the key doen't match so the user will be redirected to DulapSelected
							$wardrobeID=$_SESSION["wardrobeID"];
							header('Location: http://localhost/DulappMD/Public/DulapSelected?wardrobeID=' . $wardrobeID);
						}
				}	
			}
		}
		public function main(){
			$wardrobeID=$_SESSION['wardrobeID'];
			$actionMapper = $this->mapper('ActionMapper');
			$selectResult= $actionMapper->selectActions($wardrobeID);
			$posts = array();

			if($_POST){
    			if(isset($_POST['Update'])){
    				$newName=($_POST['newName']);
    				$wardrobeMapper = $this->mapper('WardrobeMapper');
					$selectResult=$wardrobeMapper->updateWardrobeName($wardrobeID,$newName);
					//in all situations redirect to DulappSelected
    				header('Location: '.' http://localhost/DulappMD/Public/DulapSelected?wardrobeID='. $wardrobeID);
    			}
    			if(isset($_POST['exportJSON'])){
					for($i=0;$i<sizeof($selectResult);$i++){
						//$currentItem looks like : "wardrobeID_action_momentofAction_description"
						$currentItem=$selectResult[$i];
						$pieces = explode("_", $currentItem);
						//echo $pieces[0]; // piece1
						//echo $pieces[1]; // piece2
						$posts[] = array('title'=> $pieces[1], 'pubDate'=> $pieces[2], 'description'=> $pieces[3]);
					}
					$title ='Wardrobe '. $pieces[0] .' News';
					$response[$title] = $posts;
					$filename = 'wardrobeID'.$pieces[0].'.json'; 
					$fp = fopen($filename, 'w');
					fwrite($fp, json_encode($response));
					fclose($fp);
					        
					header('Pragma: public');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private', false); // required for certain browsers 
					header('Content-Type: application/json');

					header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
					header('Content-Transfer-Encoding: binary');
					header('Content-Length: ' . filesize($filename));

					readfile($filename);
				}
				if(isset($_POST['exportRSS'])){
					$results = '<rss version="2.0"><channel><title>Wardrobe ' . $wardrobeID . ' News</title><link>http://localhost/DulappMD/Public</link><description>Changes in wardrobe.</description><language>en-us</language>';
					for($i=0;$i<sizeof($selectResult);$i++){
						//$currentItem looks like : "wardrobeID_action_momentofAction"
						$currentItem=$selectResult[$i];
						$pieces = explode("_", $currentItem);
						//echo $pieces[0]; // piece1
						//echo $pieces[1]; // piece2
						$results = $results . '<item><title>' . $pieces[1] . '</title><description>' . $pieces[3] . '</description><pubDate>' . date('r',strtotime($pieces[2])) . '</pubDate></item>';
					}
					$results = $results . '</channel></rss>';
					$filename = 'wardrobeID' . $pieces[0] . '.xml';
					$fp = fopen($filename,'w');
					fwrite($fp, $results);
					fclose($fp);

					header('Pragma: public');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private', false); // required for certain browsers 
					header('Content-Type: text/xml');
					header('Content-Transfer-Encoding: binary');
					header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
					header('Content-Length: ' . filesize($filename));

					readfile($filename);
				}
		}
	}
}
?>