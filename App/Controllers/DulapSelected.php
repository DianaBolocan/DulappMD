<?php
	class DulapSelected extends Controller{
		public function print(){
			$this->view('DulapSelected');
		}

		public function save(){
			$drawer = $this->model('Drawer');
			$drawerMapper = $this->mapper('DrawerMapper');
			$drawerMapper->save($drawer,2);
			//header("Location: http://localhost/DulappMD/Public/DulapSelected");
		}
	}
?>