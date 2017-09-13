<?php
namespace lhorente\Controllers;

use \lhorente\Models\Usuario;

class UsuariosController{
	public function index(){
		die("Não existe");
	}
	
	public function login(){
		if (is_logged()){
			header("Location:".BASE_URL.'agendas',true,301);exit;
		}		
		$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
	
		// $options = array('cost' => 12,);
		// $hash_password = password_hash($password, PASSWORD_BCRYPT, $options);
	
		if ($login && $password){
			$UsuarioObj = new Usuario();
			$usuario = $UsuarioObj->getByLogin($login);
			if ($usuario){
				if (password_verify($password,$usuario['password'])){
					$_SESSION['usuario'] = $usuario;
					header("Location:".BASE_URL.'agendas',true,301);exit;
				}
			}
		}
		$_SESSION['post_status'] = false;
		$_SESSION['return_message'] = "Login e/ou senha incorreto(s)";
		header("Location:".BASE_URL,true,301);
	}
	
	public function logout(){
		if (is_logged()){
			unset($_SESSION['usuario']);
			header("Location:".BASE_URL,true,301);
		}
	}
	
	public function cadastrar(){
		if (is_logged()){
			header("Location:".BASE_URL.'agendas',true,301);exit;
		}
		$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
		$confirm_password = filter_input(INPUT_POST,'confirm_password',FILTER_SANITIZE_SPECIAL_CHARS);
		
		if ($login && $password && $confirm_password){
			$UsuarioObj = new Usuario();
			
			if ($password == $confirm_password){
				if ($UsuarioObj->getByLogin($login)){
					$_SESSION['post_status'] = false;
					$_SESSION['return_message'] = "Já existe um usuário cadastrado com esse login";
					header("Location:".BASE_URL.'usuarios/cadastrar',true,301);exit;
				} else {
					$options = array('cost' => 12,);
					$hash_password = password_hash($password, PASSWORD_BCRYPT, $options);
					$ret = $UsuarioObj->insert(array(
						'login' => $login,
						'password' => $hash_password
					));

					if ($ret){
						$usuario = $UsuarioObj->getByLogin($login);
						$_SESSION['post_status'] = true;
						$_SESSION['return_message'] = "Login criado com sucesso!";
						$_SESSION['usuario'] = $usuario;
						header("Location:".BASE_URL.'agendas',true,301);exit;
					} else {
						$_SESSION['post_status'] = false;
						$_SESSION['return_message'] = $UsuarioObj->errorMessage;
						header("Location:".BASE_URL.'usuarios/cadastrar',true,301);exit;
					}
				}
			} else {
				$_SESSION['post_status'] = false;
				$_SESSION['return_message'] = "Senha e confirmação de senha devem ser iguais";
				header("Location:".BASE_URL.'usuarios/cadastrar',true,301);exit;
			}
		}
		\lhorente\Utils\ViewUtil::loadView('cadastrar',array());
	}
}