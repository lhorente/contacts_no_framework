<?php
namespace lhorente\Controllers;

use \lhorente\Models\Usuario;
use \lhorente\Models\Agenda;

class AdminController{
	public function index(){
		if (!is_logged()){
			header("Location:".BASE_URL,true,301);exit;
		}		

		$Usuario = new Usuario;
		
		$usuarios_cadastrados = $Usuario->getAll();
		
		\lhorente\Utils\ViewUtil::loadView('Admin/index',['usuarios_cadastrados'=>$usuarios_cadastrados]);
	}

}