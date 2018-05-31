<?php
	class Catalog extends Controller{
		public function print(){
			$this->view('Catalog');
		}

		public function delete(){
			$item = $this->model('Item');
			$itemMapper = $this->model('ItemMapper');
			$item->setItemID(7);
			$itemMapper->delete($item);
			//header('Location: http://localhost/DulappMD/Public/Catalog')
		}
	}
?>