<?php
	if (!session_id()){
		session_start();
	}
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);

	require_once('./../config.php');
	require_once('./../global_functions.php');
	require_once('./../autoload.php');
	
	use \lhorente\Utils\UriUtil;
	use \lhorente\Controllers\AgendasController;
	use \lhorente\Controllers\DefaultsController;
	
	$UriUtil = new UriUtil;
	$controllerName = $UriUtil->getController();
	$action = $UriUtil->getAction();
	$id = $UriUtil->getId();
	
	if ($controllerName){
		if ($UriUtil->isApiCall){
			$controllerNamespace = '\lhorente\Controllers\Api\\'.$controllerName;
			$Controller = new $controllerNamespace;
			if ($action){
				if ($id){
					$Controller->{$action}($id);
				} else {
					$Controller->{$action}();
				}
			} else {
				if ($UriUtil->requst_method == 'GET'){
					$Controller->index();
				} else if ($UriUtil->requst_method == 'POST') {
					$Controller->inserir();
				}
			}

		} else {
			$controllerNamespace = '\lhorente\Controllers\\'.$controllerName;
			$Controller = new $controllerNamespace;
			if ($action){
				if ($id){
					$Controller->{$action}($id);
				} else {
					$Controller->{$action}();
				}
			} else {
				$Controller->index();
			}
		}
	} else {
		$DefaultsController = new \lhorente\Controllers\DefaultsController;
		$DefaultsController->index();
	}

	
	