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
                        $userName = $_POST['username'];
                        $password = $_POST['password'];
                        $repeteadPassword=$_POST['repeteadpassword'];
                        //passwords doesn't match ->redirect to GetStarted
                        if($password!=$repeteadPassword)
                            header('Location: '.' http://localhost/DulappMD/Public/GetStarted');
                        else
                        {
                    		$loginUser ->setUsername($userName);
                    		$loginUser ->setPassword($password);
                    		$loginUser ->setAdmin(0);
                    		$userMapper = $this->model('UserMapper');
                    		if(!($userMapper ->usernameExists($loginUser))){
                                //returns userID who registered or false
                                $userID=$userMapper ->save($loginUser);
                    			if(!($userID)){
                    				echo "Probleme la insert";
                    			}
                    			else{
                    				//$this->view('Login');
                                     if (!file_exists('CSS Files/Uploads/' . $userID)) {
                                        mkdir('CSS Files/Uploads/'. $userID, 0777, true);
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
	}
?>