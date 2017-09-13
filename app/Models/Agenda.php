<?php
namespace lhorente\Models;

class Agenda extends Dao{
	private $table = "agendas";
	public $validationErrors = array();
	public $errorMsg = '';
	public $hasError = false;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get($id,$id_usuario){
		try{
			$sql = "select * from {$this->table} where id = ? and id_usuario = ? limit 1";
			$stmp = $this->conn->prepare($sql);
			$stmp->bindValue(1,$id);
			$stmp->bindValue(2,$id_usuario);
			$stmp->execute();
			return $stmp->fetch(\PDO::FETCH_ASSOC);
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao buscar registro";
		}
	}

	public function getAll($id_usuario){
		try{
			$sql = "select * from {$this->table} where id_usuario = {$id_usuario} order by nome";
			$stmp = $this->conn->prepare($sql);
			$stmp->execute();
			return $stmp->fetchAll(\PDO::FETCH_ASSOC);
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao buscar registros";
		}
	}

	public function remove($id){
		try{
			$sql = "delete from {$this->table} where id = ?";
			$stmp = $this->conn->prepare($sql);
			$stmp->bindValue(1,$id);
			return $stmp->execute();
		} catch (PDOException $e){
			$this->errorMessage = "Erro ao excluir registro";
		}
	}
	
	public function insert($data){
		$id_usuario = isset($data['id_usuario']) ? $data['id_usuario'] : null;
		$nome = isset($data['nome']) ? $data['nome'] : null;
		$email = isset($data['email']) ? $data['email'] : null;
		$telefone = isset($data['telefone']) ? $data['telefone'] : null;

		if (!$id_usuario){
			$this->hasError = true;
			$this->validationErrors['id_usuario'] = "Usuário inválido";
		}
		
		if (!$nome){
			$this->hasError = true;
			$this->validationErrors['nome'] = "Nome inválido";
		}

		if (!$telefone){
			$this->hasError = true;
			$this->validationErrors['telefone'] = "Telefone inválido";
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$this->hasError = true;
			$this->validationErrors['email'] = "Email inválido";
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$this->hasError = true;
			$this->validationErrors['email'] = "Email inválido";
		}
		
		if (!$this->hasError){
			try{
				$sql = "insert into {$this->table}(nome,email,telefone,id_usuario) values(?,?,?,?)";
				$stmp = $this->conn->prepare($sql);
				$stmp->bindValue(1,$nome);
				$stmp->bindValue(2,$email);
				$stmp->bindValue(3,$telefone);
				$stmp->bindValue(4,$id_usuario);
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
	
	public function update($data){
		$id = isset($data['id']) ? $data['id'] : null;
		$nome = isset($data['nome']) ? $data['nome'] : null;
		$email = isset($data['email']) ? $data['email'] : null;
		$telefone = isset($data['telefone']) ? $data['telefone'] : null;

		if (!$id){
			$this->hasError = true;
			$this->validationErrors['id'] = "ID inválido";
		}
		
		if (!$nome){
			$this->hasError = true;
			$this->validationErrors['nome'] = "Nome inválido";
		}

		if (!$telefone){
			$this->hasError = true;
			$this->validationErrors['telefone'] = "Telefone inválido";
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$this->hasError = true;
			$this->validationErrors['email'] = "Email inválido";
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$this->hasError = true;
			$this->validationErrors['email'] = "Email inválido";
		}
		
		if (!$this->hasError){
			try{
				$sql = "update {$this->table} set nome=?, email=?, telefone=? where id=?";
				$stmp = $this->conn->prepare($sql);
				$stmp->bindValue(1,$nome);
				$stmp->bindValue(2,$email);
				$stmp->bindValue(3,$telefone);
				$stmp->bindValue(4,$id);
				$stmp->execute();
				return true;
			} catch (PDOException $e){
				$this->errorMessage = "Erro ao atualizar registro";
			}
		} else {
			if ($this->validationErrors){
				$this->errorMessage = implode(", ",$this->validationErrors);
			}
		}
		return false;
	}
}