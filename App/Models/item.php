<?php
	class Item{
		private $brand;
		private $color;
		private $createdAt;
		private $extras;
		private $itemID;
		private $itemKey;
		private $material;
		private $season;
		private $size;
		private $state;
		private $type;
		private $updatedAt;
		private $value;

		public function __construnct($brand = NULL, $color = NULL, $createdAt = NULL, $extras = NULL, $itemID = NULL, $itemKey = NULL, $material = NULL, $season = NULL, $size = NULL, $state = NULL, $type = NULL, $updatedAt = NULL, $value = NULL){
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
	}
?>