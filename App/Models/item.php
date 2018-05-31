<?php
	class Item{
		private $brand;
		private $color;
		private $createdAt;
		private $extras;
		public $itemID;
		private $itemKey;
		private $material;
		private $season;
		private $size;
		private $state;
		private $type;
		private $updatedAt;
		private $value;

		public function __construct(){
			$this->brand = NULL;
			$this->color = NULL;
			$this->createdAt = NULL;
			$this->extras = NULL;
			$this->itemID = NULL;
			$this->itemKey = NULL;
			$this->material = NULL;
			$this->season = NULL;
			$this->size = NULL;
			$this->state = NULL;
			$this->type = NULL;
			$this->updatedAt = NULL;
			$this->value = NULL;
		}

		public function getBrand(){
			return $this->brand;
		}

		public function setBrand($brand){
			$this->brand = $brand;
		}

		public function getColor(){
			return $this->color;
		}

		public function setColor($color){
			$this->color = $color;
		}

		public function getCreatedAt(){
			return $this->createdAt;
		}

		public function setCreatedAt($createdAt){
			$this->createdAt = $createdAt;
		}

		public function getExtras(){
			return $this->extras;
		}

		public function setExtras($extras){
			$this->extras = $extras;
		}

		public function getItemKey(){
			return $this->itemKey;
		}

		public function setItemKey($itemKey){
			$this->itemKey = $itemKey;
		}

		public function getMaterial(){
			return $this->material;
		}

		public function setMaterial($material){
			$this->material = $material;
		}

		public function getSeason(){
			return $this->season;
		}

		public function setSeason($season){
			$this->season = $season;
		}

		public function getSize(){
			return $this->size;
		}

		public function setSize($size){
			$this->size = $size;
		}

		public function getState(){
			return $this->state;
		}

		public function setState($state){
			$this->state = $state;
		}

		public function getType(){
			return $this->type;
		}

		public function setType($type){
			$this->type = $type;
		}

		public function getUpdatedAt(){
			return $this->updatedAt;
		}

		public function setUpdatedAt($updatedAt){
			$this->updatedAt = $updatedAt;
		}

		public function getValue(){
			return $this->value;
		}

		public function setValue($value){
			$this->value = $value;
		}

		public function getItemID(){
			return $this->itemID;
		}

		public function setItemID($itemID){
			$this->itemID = $itemID;
		}
	}
?>