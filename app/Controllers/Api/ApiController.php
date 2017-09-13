<?php
namespace lhorente\Controllers\Api;

use \lhorente\Models\Usuario;

class ApiController{
	public $request = [
		'currentUser' => null,
		'method' => null
	];
	
	public $response = [
		'results' => [],
		'message' => ''
	];
	
	function __construct(){
		$userToken = $this->getUserToken();
		
		$Usuario = new Usuario();
		$currentUser = $Usuario->getByApiToken($userToken);
		if (!$currentUser){
			$this->response['message'] = "Você não tem permissão para acessar esse conteúdo";
			$this->printNotAthorizedResponse();
		}
		
		$this->request['currentUser'] = $currentUser;
		
		$this->request['method'] = $_SERVER['REQUEST_METHOD'];
		
	}
	
	private function getUserToken(){
		$headers = getallheaders();
		if ($headers && isset($headers['User-Access-Token'])){
			return $headers['User-Access-Token'];
		}
	}
	
	function printNotAthorizedResponse(){
		header("Content-type:application/json");
		http_response_code(401);
		echo json_encode($this->response);
		exit;
	}
	
	function printSuccessResponse(){
		header("Content-type:application/json");
		http_response_code(200);
		echo json_encode($this->response);
		exit;
	}
}