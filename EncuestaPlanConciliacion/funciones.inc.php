<?php
/*
 * Descripción: 
 * Versión: 1.0 
 * Fecha: 23/jul/2017
 * Autor: José Miguel Arquelladas
 * Email: jmaruiz@gmail.com
 * Twitter: @jmarquelladas
 */

function getDirecIpReal() {
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];

	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];

	return $_SERVER['REMOTE_ADDR'];
}
?>