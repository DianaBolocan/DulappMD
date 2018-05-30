<?php

class WD{
	
	private $wardrobeID;
	private $drawerID;
}

public function __construct($wardrobeID=NULL, $drawerID=NULL) {
		$this->wardrobeID = $wardrobeID;
		$this->drawerID = $drawerID;
		
	}
?>