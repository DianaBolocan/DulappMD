<?php
	class GetStarted extends Controller{

		public function print(){
			$this->view('GetStarted');
		}

    	public function main(){
    			if($_POST){
        			if(isset($_POST['Register'])){
            			//echo "User tries to register ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
                        $loginUser = $this->model('user');
                		$loginUser ->setUsername($_POST['username']);
                		$loginUser ->setPassword($_POST['password']);
                		$loginUser ->setAdmin(0);
                		$userMapper = $this->model('UserMapper');
                		if(!($userMapper ->usernameExists($loginUser))){
                			if(!($userMapper ->save($loginUser))){
                				echo "Probleme la insert";
                			}
                			else{
                				//$this->view('Login');
                                 if (!file_exists('CSS Files/Uploads/New')) {
                                    mkdir('CSS Files/Uploads/New', 0777, true);
                                }
                                 header('Location: '.' http://localhost/DulappMD/Public/Login');
                                 //die();
                             }
                		}
                		else
                			header('Location: '.' http://localhost/DulappMD/Public/GetStarted');
                    }
       	 		}			
    	}
	}
?>