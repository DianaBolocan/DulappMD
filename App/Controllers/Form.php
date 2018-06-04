<?php
	/*session_start();
	if(!(isset($_SESSION["userID"]))){
		header('Location: http://localhost/DulappMD/Public/HomePage');
		echo 'You are not logged in!';
	}*/

	class Form extends Controller{
		public function print(){
			$this->view('Form');
		}

		public function save(){
			if($_POST){
				if(isset($_POST['AddItem'])){
					$item = $this->model('Item');
					$item->setBrand($_POST['brand']);
					$item->setColor($_POST['color']);
					$item->setExtras($_POST['extras']);
					$item->setItemKey($_POST['key']);
					$item->setMaterial($_POST['material']);
					$item->setSeason($_POST['season']);
					$item->setSize($_POST['size']);
					$item->setState($_POST['state']);
					$item->setType($_POST['type']);
					$item->setValue($_POST['value']);
					$itemMapper = $this->mapper('ItemMapper');
					$drawerID = (int)$_POST['drawerID'];
					echo $drawerID;
					if($itemMapper->save($item,$drawerID))
					{
						echo "true";
						header("Location: http://localhost/DulappMD/Public/DulapSelected");
					}
					else {
						echo "false";
						header("Location: http://localhost/DulappMD/Public/Form");
					}
				}
			}
		}
	}
?>