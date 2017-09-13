<?php
namespace lhorente\Models;

class Usuario extends Dao{
	private $table = "usuarios";
	public $validationErrors = array();
	public $errorMsg = '';
	public $hasError = false;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAll(){
		try{
			$sql = "select u.*, count(a.id) total_contatos from {$this->table} u left join agendas a on a.id_usuario = u.id group by u.id order by login";
			$stmp = $this->conn->prepare($sql);
			$stmp->execute();
			return $stmp->fetchAll(\PDO::FETCH_ASSOC);
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao buscar registros";
		}
	}
	
	public function getByLogin($login){
		try{
			$sql = "select * from {$this->table} where login = ? limit 1";
			$stmp = $this->conn->prepare($sql);
			$stmp->bindValue(1,$login);
			$stmp->execute();
			return $stmp->fetch(\PDO::FETCH_ASSOC);
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao buscar registro";
		}
	}
	
	public function getByApiToken($token){
		try{
			$sql = "select * from {$this->table} where api_token = ? limit 1";
			$stmp = $this->conn->prepare($sql);
			$stmp->bindValue(1,$token);
			$stmp->execute();
			return $stmp->fetch(\PDO::FETCH_ASSOC);
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao buscar registro";
		}
	}
	
	public function insert($data){
		$login = isset($data['login']) ? $data['login'] : null;
		$password = isset($data['password']) ? $data['password'] : null;

		if (!$login){
			$this->hasError = true;
			$this->validationErrors['login'] = "Login inválido";
		}

		if (!$password){
			$this->hasError = true;
			$this->validationErrors['password'] = "Senha inválida";
		}
		
		if (!$this->hasError){
			try{
				$sql = "insert into {$this->table}(login,password) values(?,?)";
				$stmp = $this->conn->prepare($sql);
				$stmp->bindValue(1,$login);
				$stmp->bindValue(2,$password);
				$stmp->execute();
				return true;
			} catch (PDOException $e){
				$this->errorMessage = "Erro ao inserir registro";
			}
		} else {
			if ($this->validationErrors){
				$this->errorMessage = implode(", ",$this->validationErrors);
			}
		}
		return false;
	}	
}