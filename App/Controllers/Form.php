<?php
	session_start();
	if(!(isset($_SESSION["userID"]))){
		header('Location: http://localhost/DulappMD/Public/HomePage');
		echo 'You are not logged in!';
	}

	class Form extends Controller{
		public function print(){
			$this->view('Form');
		}

		public function save(){
			if($_POST){
				if(isset($_POST['AddItem'])){
					$target_dir = "CSS Files/uploads/" . $_SESSION['userID'] . "/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }

				    if (file_exists($target_file)) {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
					}

					if ($_FILES["fileToUpload"]["size"] > 500000) {
					    echo "Sorry, your file is too large.";
					    $uploadOk = 0;
					}

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
					    $uploadOk = 0;
					}

					if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					    $path = "CSS Files/uploads/default.jpeg";
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					        $path = $target_file;
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					        $path = "CSS Files/uploads/default.jpeg";
					    }
					}

					$wardrobeID = $_SESSION['wardrobeID'];
					echo 'wardrobe:' .$wardrobeID;
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
					$item->setPath($path);
					$item->setValue($_POST['value']);
					$itemMapper = $this->mapper('ItemMapper');
					$drawerID = (int)$_POST['drawerID'];
					
					if($itemMapper->save($item,$drawerID))
					{
						echo "true";
						header("Location: http://localhost/DulappMD/Public/DulapSelected?wardrobeID=" . $wardrobeID);
					}
					else {
						echo "false";
						header("Location: http://localhost/DulappMD/Public/Form?wardrobeID=" . $wardrobeID);
					}
				}
			}
		}
	}
?>