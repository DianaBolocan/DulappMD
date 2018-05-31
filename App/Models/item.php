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

		public function __construnct($brand, $color, $createdAt, $extras, $itemID, $itemKey, $material, $season, $size, $state, $type, $updatedAt, $value){
			$this->brand = $brand;
			$this->color = $color;
			$this->createdAt = $createdAt;
			$this->extras = $extras;
			$this->itemID = $itemID;
			$this->itemKey = $itemKey;
			$this->material = $material;
			$this->season = $season;
			$this->size = $size;
			$this->state = $state;
			$this->type = $type;
			$this->updatedAt = $updatedAt;
			$this->value = $value;
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
	}
?>