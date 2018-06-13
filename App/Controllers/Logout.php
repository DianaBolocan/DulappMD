<?php
	session_start();
	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	class Logout extends Controller{
		public function print(){
			$this->view('HomePage');
		}
	}
?>