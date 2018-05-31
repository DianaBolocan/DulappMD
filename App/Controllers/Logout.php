<?php
	session_start();
	unset($_SESSION['userID']);
	session_destroy();
	class Logout extends Controller{
		public function print(){
			$this->view('HomePage');
		}
	}
?>