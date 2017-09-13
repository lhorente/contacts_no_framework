<?php
namespace lhorente\Controllers\Api;

use \lhorente\Models\Agenda;

class AgendasController extends ApiController{
	// api/agendas
	public function index(){
		// var_dump($this->request['method']);exit;
		$AgendaObj = new Agenda();
		$id_usuario = $this->request['currentUser']['id'];
		
		$agendas = $AgendaObj->getAll($id_usuario);
		
		$this->response['results'] = $agendas;
		$this->printSuccessResponse();
	}
	
	public function inserir(){
		$AgendaObj = new Agenda();
		$id_usuario = $this->request['currentUser']['id'];
		
		$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
		$telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_SPECIAL_CHARS);
		
		$ret = $AgendaObj->insert(array(
			'id_usuario' => $id_usuario,
			'nome' => $nome,
			'email' => $email,
			'telefone' => $telefone
		));

		if ($ret){
			$_SESSION['post_status'] = true;
			$_SESSION['return_message'] = "Salvo com sucesso";
		} else {
			$_SESSION['post_status'] = false;
			$_SESSION['return_message'] = $AgendaObj->errorMessage;
		}
		
		$this->printSuccessResponse();
	}
}