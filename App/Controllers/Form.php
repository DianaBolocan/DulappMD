<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		header('Location: http://localhost/DulappMD/Public/HomePage');
		echo 'You are not logged in!';
	}
	if(!isset($_SESSION['drawerID'])){
		echo "There is no drawerID";
	}

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
					if($itemMapper->save($item,19)) //drawerID
					{
						header("Location: http://localhost/DulappMD/Public/DulapSelected");
					}
					else {
						header("Location: http://localhost/DulappMD/Public/Form");
					}
				}
			}
		}
	}
?>