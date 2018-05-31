<?php
	class DI{
		
		private $drawerID;
		private $itemID;

		public function __construct($drawerID, $itemID) {
			$this->drawerID = $drawerID;
			$this->itemID = $itemID;
		}
	}
?>