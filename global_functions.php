<?php
function is_logged(){
	if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id']){
		return true;
	}
	return false;
}