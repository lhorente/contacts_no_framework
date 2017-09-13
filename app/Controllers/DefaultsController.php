<?php
namespace lhorente\Controllers;

use \lhorente\Models\Usuario;

class DefaultsController{
	public function index(){
		$Usuario = new \lhorente\Models\Usuario;
		if (is_logged()){
			header("Location:".BASE_URL.'agendas',true,301);exit;
		}
		\lhorente\Utils\ViewUtil::loadView('login',array());
	}
}