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
								//trebuie sa retin lista de id-uri!
								$searchExistence=1;
								//echo $allItems[$i] . "<br>";
								$paramsItem = explode("!", $allItems[$i]);
								echo $paramsItem[1] . "<br>"; 			
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


		public function save(){
			$userID = $_SESSION['userID'];
			if($_POST){
				if(isset($_POST['save'])){
					$wardrobe = $this->model('Wardrobe');
					$wardrobe->setName($_POST['wardrobeName']);
					$wardrobe->setTag($_POST['wardrobeTags']);
					$wardrobeMapper = $this->mapper('WardrobeMapper');
					$wardrobeMapper->save($wardrobe,$userID);
					//header('Location: http://localhost/DulappMD/Public/DulappList')
				}
			}
		}
	}
	
?>