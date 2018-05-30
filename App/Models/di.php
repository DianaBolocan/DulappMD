<?php

class DI{
	
	private $drawerID;
	private $itemID;
}

public function __construct($drawerID=NULL, $itemID=NULL) {
		$this->drawerID = $drawerID;
		$this->itemID = $itemID;
		
	}
?>