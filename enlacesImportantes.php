<!DOCTYPE html>
<html>
<head>
	<title>Enlaces importantes para desarrollo de reloj cuenta atrás</title>
</head>
<body>
	<?php

	$enlaces = array(
		'http://www.ajaxshake.com/demo/ES/182/ad87a2b5/jquery-reloj-analogico-javascript-old-school-clock.html',
		'http://ditscheri.com/blog/write-a-web-app-optimized-for-mobile-devices-with-html5-css3-and-javascript',
		'https://www.google.es/search?q=convertir+angulo+javascript&ie=utf-8&oe=utf-8&client=firefox-b&gfe_rd=cr&ei=9uQBWZHxKPCJ8Qfu57HoBg',
		'https://developer.mozilla.org/es/docs/Web/JavaScript/Referencia/Objetos_globales/Math',
		'https://www.w3schools.com/js/js_math.asp',
		'https://es.wikipedia.org/wiki/Radi%C3%A1n',
		'https://es.wikipedia.org/wiki/Revoluci%C3%B3n_por_minuto',
		'http://www.disfrutalasmatematicas.com/geometria/grados.html',
		'https://www.google.es/search?client=opera&q=w3c+ejemplos+svg&sourceid=opera&ie=UTF-8&oe=UTF-8',
		'https://www.google.es/search?client=opera&q=google&sourceid=opera&ie=UTF-8&oe=UTF-8#q=pasar+grados+a+coordenadas+2d',
		'https://advancedsoftware.wordpress.com/2012/05/29/rotacion-en-r2-dos-dimensiones-2d',
		'http://www.vitutor.com/di/c/a_11.html',
		'https://www.youtube.com/watch?v=AJdCfaGjWlk',
		'https://www.w3schools.com/jsref/jsref_sin.asp',
		'https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_sin',
		'http://snapsvg.io/docs/#Element.attr',
		'https://greensock.com',
	);

	// Para comprobar el contenido del array
	// var_dump($enlaces);

	?>

	<table>
		<thead>
			<tr>Enlaces</tr>
		</thead>
		<tbody>
			<?php

			foreach ($enlaces as $celda => $valor) {
				echo '<tr><td><a href="'.$valor.'">'.$valor.'</a></td></tr>';
			}
			?>
		</tbody>
	</table>
</body>
</html>