<?php 

function is_login(){
	$user = A('User');
	$is_login = $user->isLogged();
	if(empty($is_login) || !isset($is_login)){
		redirect(U('Login/index'));
	}
}

function token($length = 32) {
	// Create random token
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$max = strlen($string) - 1;
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, $max)];
	}	
	
	return $token;
}




