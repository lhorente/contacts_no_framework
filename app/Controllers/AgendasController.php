<?php
namespace lhorente\Controllers;

use \lhorente\Models\Agenda;
use \lhorente\Utils\ApiUtil;

class AgendasController{
	public function index(){
		if (!is_logged()){
			header("Location:".BASE_URL,true,301);exit;
		}		
		$AgendaObj = new Agenda();
		
		$id_usuario = $_SESSION['usuario']['id'];
		
		$ApiUtil = new ApiUtil($_SESSION['usuario']['api_token']);
		$agendasRet = $ApiUtil->getAgendas();
		$agendas = $agendasRet->results;
		
		// var_dump($agendas2);
		
		// $agendas = $AgendaObj->getAll($id_usuario);
		
		\lhorente\Utils\ViewUtil::loadView('Agendas/index',array('agendas'=>$agendas));
	}
	
	public function inserir(){
		if (!is_logged()){
			header("Location:".BASE_URL,true,301);exit;
		}
		$AgendaObj = new Agenda();

		$id_usuario = $_SESSION['usuario']['id'];
		
		if ($_POST){
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

			header("Location:".BASE_URL.'agendas',true,301);exit;
		}
		
		\lhorente\Utils\ViewUtil::loadView('Agendas/inserir',array());
	}
	
	public function editar($id=null){
		if (!is_logged()){
			header("Location:".BASE_URL,true,301);exit;
		}		
		$AgendaObj = new Agenda();

		$id_usuario = $_SESSION['usuario']['id'];
		
		if ($id){
			$agenda = $AgendaObj->get($id,$id_usuario);
			if ($agenda){
				if ($_POST){
					$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
					$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
					$telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_SPECIAL_CHARS);
					
					if ($nome && $email && $telefone){
						$ret = $AgendaObj->update(array(
							'id' => $id,
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
					}
					header("Location:".BASE_URL.'agendas',true,301);exit;
				}
				\lhorente\Utils\ViewUtil::loadView('Agendas/editar',array('agenda'=>$agenda));exit;
			}
		}
		\lhorente\Utils\ViewUtil::loadView('not_found',array());
	}
	
	public function excluir($id=null){
		if (!is_logged()){
			header("Location:".BASE_URL,true,301);exit;
		}		
		$AgendaObj = new Agenda();

		$id_usuario = $_SESSION['usuario']['id'];
		
		if ($id){
			$agenda = $AgendaObj->get($id,$id_usuario);
			if ($agenda){
				if ($AgendaObj->remove($id)){
					$_SESSION['post_status'] = true;
					$_SESSION['return_message'] = "Excluído com sucesso";
				} else {
					$_SESSION['post_status'] = false;
					$_SESSION['return_message'] = $AgendaObj->errorMessage;
				}
				header("Location:".BASE_URL.'agendas',true,301);exit;
			}
		}		
	}
}