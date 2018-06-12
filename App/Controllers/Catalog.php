<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		echo 'You are not logged in!';
	}

	class Catalog extends Controller{
		public function print(){
			$wdMapper = $this->mapper('WDMapper');
			$nameids=$wdMapper->getWardrobeNameDrawerIDs();
			$_SESSION['nameids']=$nameids;
			
			if(!empty($_POST)){
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
				$itemPaths=array();
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
							//for($r=0;$r<sizeof($paramsItem);$r++)
							//	echo $paramsItem[$r] . "<br>";
							//echo "<br> ID:" . $paramsItem[3] . "<br>"; 
							array_push($itemIDs,$paramsItem[3]);
							array_push($itemPaths,$paramsItem[1]);
						}
					}
				$_SESSION["itemPaths"]=$itemPaths;
				$_SESSION["itemIDs"]=$itemIDs;
				$_SESSION["message"]="searchAfterU";
				header('Location: http://localhost/DulappMD/Public/Catalog?searchAfterU='.$searchParams);
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
				$itemPaths=array();
				$itemIDs=array();
				for($i=0;$i<sizeof($allItems);$i++)
					{
						//echo $allItems[$i] . "<br>";
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
							$paramsItem = explode("!", $allItems[$i]);	
							//it will put the path	
							array_push($itemIDs,$paramsItem[3]);
							array_push($itemPaths,$paramsItem[1]);
						}
					}
				$_SESSION["itemPaths"]=$itemPaths;
				$_SESSION["itemIDs"]=$itemIDs;
				$_SESSION["message"]="searchAfterW";
				header('Location: http://localhost/DulappMD/Public/Catalog?searchAfterW='.$searchParams);
			}
		}
	        $this->view('Catalog');

		}

		public function main(){
	
		}


		public function delete(){
			$item = $this->model('Item');
			$itemMapper = $this->model('ItemMapper');
			$item->setItemID($_GET["itemID"]);
			$itemMapper->delete($item);
				//header('Location:' . $_SERVER['HTTP_REFERER']);
		}

		public function move(){
			
				//$drawerID = (int)$_GET['drawerID'];
				if($_POST){
					if(isset($_POST["moveSubmit"])){
						echo 'aici';
						$item = $this->model("Item");
						$DIMapper = $this->mapper("DIMapper");
						echo $_POST['itemID'];
						$item->setItemID((int)$_POST["itemID"]);
						$drawerID = (int)$_POST["drawerID"];
						$DIMapper->update($item,$drawerID);
						//header('Location: hhtps://localhost/DulappMD/Catalog?drawerID=' . $drawerID);
					}
				}
		}
	}
?>