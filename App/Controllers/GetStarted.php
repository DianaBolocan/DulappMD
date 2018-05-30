<?php

	require_once(__DIR__."/../Models/User.php");
	require_once(__DIR__."/../Models/UserMapper.php");

	class GetStarted extends Controller{
		public function print(){
			$this->view('GetStarted');
		}
	

	public function main(){
			if($_POST){
                $this->view('Login');
    			if(isset($_POST['Register'])){
        			echo "User tries to register ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
        		}
        		$loginUser = new User();
        		$loginUser ->setUsername($_POST['username']);
        		$loginUser ->setPassword($_POST['password']);
        		$loginUser ->setAdmin(0);
        		$userMapper = new UserMapper();
        		if(!($userMapper ->usernameExists($loginUser))){
                    $userSaved = $userMapper->save($loginUser);
                    echo $userSaved;
        			if (!$userSaved) {
        				echo "Probleme la insert";
        			}
        			else
        				echo "am intrat!";
        				$this->view('Login');




        		}
        		else
        			//echo "Userul deja exista";
   	 		}			
	}
	}
?>