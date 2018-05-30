<?php
	require_once(__DIR__."/../Models/User.php");
	require_once(__DIR__."/../Models/UserMapper.php");

	class GetStarted extends Controller{
		public function print(){
			$this->view('GetStarted');
		}
	

	public function main(){
			if($_POST){
    			if(isset($_POST['Register'])){
        			echo "User tries to register ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
        		}
        		$loginUser = new User();
        		$loginUser ->setUsername($_POST['username']);
        		$loginUser ->setPassword($_POST['password']);
        		$loginUser ->setAdmin(0);
        		$userMapper = new UserMapper();
        		if(!($userMapper ->usernameExists($loginUser))){
        			if(!($userMapper ->save($loginUser))){
        				echo "Probleme la insert";
        			}
        			else
        				echo "User inregistrat cu succes!";
        				//header("Location: Login.php");
        		}
        		else
        			echo"Userul deja exista";
   	 		}			
	}
	}
?>