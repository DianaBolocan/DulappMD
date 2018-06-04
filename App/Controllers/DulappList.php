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
				$this->view('DulappList');
				//echo 'nu ma deloghez!';
				$userID=$_SESSION["userID"] ;
				$wardrobeMapper = $this->mapper('WardrobeMapper');
				$selectResult=$wardrobeMapper->selectAllWardrobes($userID);
		        if($selectResult==false)
		        {
		        	echo 'Userul curent nu are vreun dulap';			
		        }
		        else
		        {
		        	echo 'Userul curent are dulapurile mentionate anterior';
		        }	
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