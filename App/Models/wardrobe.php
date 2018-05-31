<?php
	class Wardrobe{
		
		public $wardrobeID;
		private $name;
		private $tag;
		private $createdAt;

		public function __construct() {
			$this->name = NULL;
			$this->tag = NULL;
			$this->createdAt = NULL;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($name){
			$this->name = $name;
		}

		public function getTag(){
			return $this->tag;
		}

		public function setTag($tag){
			$this->tag = $tag;
		}

		public function getCreatedAt(){
			return $this->createdAt;
		}

		public function setCreatedAt($createdAt){
			$this->createdAt = $createdAt;
		}

		public function getWardrobeID(){
			return $this->wardrobeID;
		}

		public function setWardrobeID($wardrobeID){
			$this->wardrobeID = $wardrobeID;
		}
	}
?>