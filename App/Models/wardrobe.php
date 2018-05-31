<?php
	class Wardrobe{
		
		public $wardrobeID;
		private $name;
		private $tag;
		private $createdAt;

		public function __construct( $name, $tag, $createdAt) {
			$this->name = $name;
			$this->tag = $tag;
			$this->createdAt = $createdAt;
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
	}
?>