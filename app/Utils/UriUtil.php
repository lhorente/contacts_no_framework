<?php
namespace lhorente\Utils;

class UriUtil{
	public $isApiCall = false;
	public $requst_method = null;
	private $fragments = array();
	
	public function __construct(){
		$this->generateFragments();
		$this->requst_method = $_SERVER['REQUEST_METHOD'];
	}
	
	private function getFullUrl(){
		$uri = $_SERVER['REQUEST_URI'];
		 
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		 
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		 
		$query = $_SERVER['QUERY_STRING'];
		
		return $url;
	}
	
	private function generateFragments(){
		$uri = str_replace(BASE_URL,'',$this->getFullUrl());
		
		if ($uri){
			$fragments = explode('/',$uri);
			if ($fragments){
				if ($fragments[0] == 'api'){
					$this->isApiCall = true;
				}
				$this->fragments = $fragments;
			}
		}
	}

	public function getFragmentPart($part){
		if ($this->fragments && is_array($this->fragments) && isset($this->fragments[$part])){
			return $this->fragments[$part];
		}
		return false;
	}
	
	public function getController(){
		if ($this->isApiCall){
			$part = 1;
		} else {
			$part = 0;
		}
		
		$fragment = $this->getFragmentPart($part);
		if ($fragment){
			return ucfirst($fragment).'Controller';
		}
		return false;
	}
	
	public function getAction(){
		if ($this->isApiCall){
			$part = 2;
		} else {
			$part = 1;
		}
		
		$fragment = $this->getFragmentPart($part);
		return $fragment;
	}
	
	public function getId(){
		if ($this->isApiCall){
			$part = 3;
		} else {
			$part = 2;
		}
		
		$fragment = $this->getFragmentPart($part);
		return $fragment;
	}
}