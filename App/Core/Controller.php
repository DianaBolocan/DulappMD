<?php 
	class Controller{
		public function model($model){
			require_once '../App/Models/' . $model . '.php';
			return new $model();
		}

		public function view($view, $data = []){
			require_once '../App/Views/' . $view . '.php';
		}

		public function mapper($mapper){
			require_once '../App/Models/' . $mapper . '.php';
			return new $mapper();
		}
	}
?>