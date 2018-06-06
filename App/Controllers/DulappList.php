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
			$userID=$_SESSION['userID'];
			if($_POST){
    			if(isset($_POST['searchAfterU'])){
    				$itemMapper = $this->mapper('ItemMapper');
    				$allItems=$itemMapper->searchAfterU($userID);
    				$searchParams=($_POST['searchParams']);
    				$searchParams = strtolower($searchParams);
    				$params = explode(" ", $searchParams); //parsing received params through post method
					for($j=0;$j<sizeof($params);$j++)
						$params[$j]='!'. $params[$j] . '!';
					$searchExistence=0;
					$itemIDs=array();
					for($i=0;$i<sizeof($allItems);$i++)
						{
							$currentSearchExistence=1;
							for($j=0;$j<sizeof($params);$j++)
							{
								if(strstr($allItems[$i],$params[$j])==false)
								{
									$currentSearchExistence=0;
									break;
								}
							}
							if($currentSearchExistence==1)
							{
								//add the current item to the matching ones
								$searchExistence=1;
								//echo $allItems[$i] . "<br>";
								$paramsItem = explode("!", $allItems[$i]);
								//echo $paramsItem[1] . "<br>"; 		
								array_push($itemIDs,$paramsItem[1]);
							}
						}
					$_SESSION["itemIDs"]=$itemIDs;
					$_SESSION["message"]="searchAfterU";
					$this->view('Catalog');
    			}
			}
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

					//header('Location: http://localhost/DulappMD/Public/DulappList');
				}
			}
		}
	}
	
?>