<!DOCTYPE html>
<!--
Descripción: Ejemplo PHP y Ajax para web dinámica con petición asíncrona
Versión: Fecha: 1.0 
Fecha: 31/07/2017
Autor: José Miguel Arquelladas
Email: jmaruiz@gmail.com
Twitter: @jmarquelladas
-->

<?php
// Poner codificación para visualizar correctamente la web
header('Content-Type: text/html; charset=UTF-8');

// Array con nombres a sugerir
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";

// Recoje el parámetro q desde la url
$q = $_REQUEST['q'];

$sugerencia = ''; // creamos variable con cadena vacía

// Revisamos o buscamos todos los nombres sugeridos del array is $q es diferente a vacío
if($q !== '') {
	$q = strtolower($q); // Convertimos el contenido a minúsculas
	$longitudCadena = strlen($q);
	foreach ($a as $nombre) {
		if(stristr($q, substr($nombre, 0, $longitudCadena))) {
			if($sugerencia === '') {
				$sugerencia = $nombre;
			} else {
				$sugerencia .= ', '.$nombre;
			}
		}
	}
}

// Mostramos "sin sugerencias" if no se encuentra ninguna sugerencia o el valor correcto
echo $sugerencia === "" ? "sin sugerencias" : $sugerencia;

?>