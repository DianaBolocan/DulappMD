<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class Catalog extends Controller{
		public function print(){
			//echo $_SESSION["whereAmI"];
			if (empty($_POST))
			{
					$drawerID = $_GET["drawerID"];
					$_SESSION['drawerID']=$drawerID;
					//echo 'Current drawer(received through URL): ' . $drawerID . "<br>";
					//echo 'Current wardrobe(received through session):' . $_SESSION['wardrobeID'];
					$itemMapper = $this->mapper('ItemMapper');
					$selectResult=$itemMapper->selectFromDrawer($drawerID);
				
			}
			else{
			 if($_SESSION["whereAmI"]=="searchAfterU")
			{
				$userID=$_SESSION['userID'];
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
			}
			else if($_SESSION["whereAmI"]=="searchAfterW")
			{
				$wardrobeID=$_SESSION['wardrobeID'];
				$itemMapper = $this->mapper('ItemMapper');
    			$allItems=$itemMapper->searchAfterW($wardrobeID);
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
				$_SESSION["message"]="searchAfterW";
			}
		}
	        $this->view('Catalog');
		}

		public function main(){
	
		}


		public function delete(){
			$item = $this->model('Item');
			$itemMapper = $this->model('ItemMapper');
			$item->setItemID(3); //$_SESSION["itemID"]
			$itemMapper->delete($item);
			header('Location: http://localhost/DulappMD/Public/Catalog');
		}
	}
?>