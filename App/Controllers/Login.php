<?php

require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/UserMapper.php");

	class Login extends Controller{
		public function print(){
			$this->view('Login');
		}

		public function main(){
			//echo 'Buna ce mai zici';
			//if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
			//	echo $_POST['username'] . ' ' . $_POST['password'];

			if($_POST){
    			if(isset($_POST['Login'])){
        			echo "User tries to login ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
        		}
        		$loginUser = new User();
        		$loginUser ->setUsername($_POST['username']);
        		$loginUser ->setPassword($_POST['password']);
        		$userMapper = new UserMapper();
        		echo "Controller result ". $userMapper ->isValidUser($loginUser) . "<br>";
   	 		}			
		}
	}
?>