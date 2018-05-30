<?php
session_start();

require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/UserMapper.php");

	class Login extends Controller{
		public function print(){
			$this->view('Login');
		}

		public function main(){
			
			if($_POST){
    			if(isset($_POST['Login'])){
        			echo "User tries to login ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
        		}
        		$loginUser = new User();
        		$loginUser ->setUsername($_POST['username']);
        		$loginUser ->setPassword($_POST['password']);
        		$userMapper = new UserMapper();

        		$loginResult=$userMapper ->isValidUser($loginUser);
        		if($loginResult=="false")
        		{
        			header('Location: '.' http://localhost/DulappMD/Public/Login');
        			
        		}
        		else
        		{
        			$_SESSION["userID"] = $loginResult;
        			header('Location: '.' http://localhost/DulappMD/Public/DulappList');
        		}
   	 		}			
		}
	}
?>