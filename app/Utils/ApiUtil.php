<?php
namespace lhorente\Utils;

class ApiUtil{
	private $endpoint = BASE_URL.'api/';
	private $user_access_token = null;
	
	function __construct($user_access_token = null){
		$this->user_access_token = $user_access_token;
	}
	
	private function getResults($uri){
		if ($this->user_access_token){
			$headers = ['User-Access-Token: '.$this->user_access_token];
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->endpoint.$uri);
		// curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	

		$server_output = curl_exec ($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		curl_close ($ch);

		$ret = json_decode($server_output);

		if ($httpcode == 200){
			return $ret;
		}
		return false;
	}
	
	public function getAgendas(){
		$uri = "agendas";
		$results = $this->getResults($uri);
		
		return $results;
	}
}