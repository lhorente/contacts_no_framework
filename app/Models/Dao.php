<?php
namespace lhorente\Models;
class Dao{
	public $conn;
	
	public function __construct(){
		try{
			$this->conn = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASS);
		} catch(PDOExcpetion $e){
			die('Erro ao conectar na base dados.');
		}
	}
}