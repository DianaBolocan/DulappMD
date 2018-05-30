<?php

class Drawer{
	
	private $drawerID;
	private $drawerkey;
	private $createdAt;
}

	public function __construct($drawerID=NULL, $drawerkey=NULL, $createdAt=NULL) {
		$this->drawerID = $drawerID;
		$this->drawerkey = $drawerkey;
		$this->createdAt = $createdAt;
	}

	
?>