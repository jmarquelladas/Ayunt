<!DOCTYPE html>
<!--
Descripción: Formulario para encuesta de Encuesta Conciliación de la Vida Personal, Laboral y Familiar 
Versión: Fecha: 1.0 
Fecha: 21/07/2017
Autor: José Miguel Arquelladas
Email: jmaruiz@gmail.com
Twitter: @jmarquelladas
-->

<?php
// Poner codificación para visualizar correctamente la web
header('Content-Type: text/html; charset=UTF-8');

// Incluimos el archivo de funciones
include 'funciones.inc.php';

// Realizamos la carga de las clases
require_once('BD.php');
require_once ('./include/xajax_core/xajax.inc.php');

// Configuramos la zona horaria
date_default_timezone_set('Europe/Madrid');

/**
 *
 *
 */
function mostrarMunicipios($prov) {

}

// Configuración Xajax
$xajax = new xajax(); // Creamos el objeto

// Registramos las funciones PHP del servidor para poner a disposicion y poder ejecutarse de forma síncrona desde el navegador.
$xajax->register(XAJAX_FUNCTION, 'mostrarMunicipios');
// ...
// Configuramos ruta acceso a carpeta xajax_js
$xajax->configure('javascript URI', './include/');

// Por último procesamos las llamadas a las funciones
// Hay que tener en cuenta que la llamada a processRequest debe realizarse 
// antes de que el guión PHP genere ningún tipo de salida.
$xajax->processRequest();// Creamos el objeto xajax

// Se ha enviado el formulario de la encuesta
if(isset($_REQUEST['envio'])) {
	$envio = $_REQUEST['envio'];
	if($envio) {
		// Guardar fecha y hora de envío del formulario
		// También quiere ver si puede guardar el tiempo que ha tardado en cumplimentar el formulario

		// Guardamos el valor de los campos en un array llamado encuesta
		// Inicializamos las variables con el valor de los campos pasados del furmulario
		$direc_ip = getDirecIpReal();
		$tiempo_realiz = NULL;  // TO DO calcular tiempo utilizado para realizar la encuesta, con cookies o algo así.
		$s101	= $_REQUEST['s101'];
		$s102   = $_REQUEST['s102'];
		$p1     = $_REQUEST['p1'];
		$p21    = $_REQUEST['p21'];
		$p22    = $_REQUEST['p22'];
		$p23    = $_REQUEST['p23'];
		$p24    = $_REQUEST['p24'];
		$p25    = $_REQUEST['p25'];
		$p26    = $_REQUEST['p26'];
		$p27    = $_REQUEST['p27'];
		$p3     = $_REQUEST['p3'];
		$p4     = $_REQUEST['p4'];
		$p5     = $_REQUEST['p5'];
		$p6     = $_REQUEST['p6'];
		$p7     = $_REQUEST['p7'];
		$p8     = $_REQUEST['p8'];
		$p9     = $_REQUEST['p9'];
		$p9a    = $_REQUEST['p9a'];
		$p9b    = $_REQUEST['p9b'];
		$p9c    = $_REQUEST['p9c'];
		$p10    = $_REQUEST['p10'];
		$p108   = $_REQUEST['p108'];
		$t10a1  = $_REQUEST['t10a1'];
		$t10a2  = $_REQUEST['t10a2'];
		$t10a3  = $_REQUEST['t10a3'];
		$t10a4  = $_REQUEST['t10a4'];
		$t10a5  = $_REQUEST['t10a5'];
		$t10b   = $_REQUEST['t10b'];
		$t10b5  = $_REQUEST['t10b5'];
		$t10c   = $_REQUEST['t10c'];
		$t10d1  = NULL;
		$t10d2  = NULL;
		$t10d3  = NULL;
		$t10d4  = NULL;
		$t10d5  = NULL;
		$t10d6  = NULL;
		$t10d7  = NULL;
		$t10d8  = NULL;
		$t10d9  = NULL;
		$t10d10 = NULL;
		$t10d11 = NULL;
		$t10d11otro  = $_REQUEST['t10d11otro'];
		$d10a        = $_REQUEST['d10a'];
		$d10a1       = $_REQUEST['d10a1'];
		$d10a112cual = $_REQUEST['d10a112cual'];
		$d10a2 	= $_REQUEST['d10a2'];
		$j10a  	= $_REQUEST['j10a'];
		$s1  = $_REQUEST['s1'];
		$s2  = $_REQUEST['s2'];
		$s3  = $_REQUEST['s3'];
		$s4  = $_REQUEST['s4'];
		$s5  = $_REQUEST['s5'];
		$s6  = $_REQUEST['s6'];
		$s7  = $_REQUEST['s7'];
		$s8  = $_REQUEST['s8'];
		$s82 = $_REQUEST['s82'];
		$s9  = $_REQUEST['s9'];

		// Comprobamos pregunta p9 para dar valor a p9a, p9b y p9c
		if($p9 != 1) {
			$p9a = NULL;
			$p9b = NULL;
			$p9c = NULL;
		}

		// Comprobamos pregunta p10 para dar valor a t10a, j10a, d10a y ramas
		if($p10 == 1) { // Opcion Trabajando
			// Poner en NULL las preguntas j10a, d10a, d10a1, d10a112cual, d10a2
			$p108 =  NULL;
			$j10a =	 NULL;
			$d10a =  NULL;
			$d10a1 = NULL;
			$d10a112cual = NULL;
			$d10a2 = NULL;

			// Comprobamos valor de variables apartado t10d
			if(!(empty($_REQUEST['t10d1']))) $t10d1 = 1; 
			if(!(empty($_REQUEST['t10d2']))) $t10d2 = 1; 
			if(!(empty($_REQUEST['t10d3']))) $t10d3 = 1; 
			if(!(empty($_REQUEST['t10d4']))) $t10d4 = 1; 
			if(!(empty($_REQUEST['t10d5']))) $t10d5 = 1; 
			if(!(empty($_REQUEST['t10d6']))) $t10d6 = 1; 
			if(!(empty($_REQUEST['t10d7']))) $t10d7 = 1; 
			if(!(empty($_REQUEST['t10d8']))) $t10d8 = 1; 
			if(!(empty($_REQUEST['t10d9']))) $t10d9 = 1; 
			if(!(empty($_REQUEST['t10d10']))) $t10d10 = 1; 
			if(!(empty($_REQUEST['t10d11']))) $t10d11 = 1; 
		} else if($p10 == 2 || $p10 == 3) { // Opciones Jubilados
			// Poner en NULL las preguntas t10a1, t10a2, t10a3, t10a4, t10a5, t10b, t10b5, t10c, todas las t10d (1-11), t10d11otro, d10a, d10a1, d10a112cual y d10a2
			$t10a1 = NULL;
			$t10a2 = NULL;
			$t10a3 = NULL;
			$t10a4 = NULL;
			$t10a5 = NULL;
			$t10b  = NULL;
			$t10b5 = NULL;
			$t10c  = NULL;
			$t10d1 = NULL;
			$t10d2 = NULL;
			$t10d3 = NULL;
			$t10d4 = NULL;
			$t10d5 = NULL;
			$t10d6 = NULL;
			$t10d7 = NULL;
			$t10d8 = NULL;
			$t10d9 = NULL;
			$t10d10 = NULL;
			$t10d11 = NULL;
			$t10d11otro = NULL;
			$d10a   = NULL;
			$d10a1  = NULL;
			$d10a112cual  = NULL;
			$d10a2  = NULL;
		} else if($p10 >= 4 && $p10 <= 7) { // Desempleados, estudiantes o ama/o de casa
			// Poner en NULL las preguntas t10a1, t10a2, t10a3, t10a4, t10a5, t10b, t10b5, t10c, todas las t10d (1-11), t10d11otro y j10a
			$t10a1 = NULL;
			$t10a2 = NULL;
			$t10a3 = NULL;
			$t10a4 = NULL;
			$t10a5 = NULL;
			$t10b  = NULL;
			$t10b5 = NULL;
			$t10c  = NULL;
			$t10d1 = NULL;
			$t10d2 = NULL;
			$t10d3 = NULL;
			$t10d4 = NULL;
			$t10d5 = NULL;
			$t10d6 = NULL;
			$t10d7 = NULL;
			$t10d8 = NULL;
			$t10d9 = NULL;
			$t10d10 = NULL;
			$t10d11 = NULL;
			$t10d11otro = NULL;
			$j10a  = NULL;
		} else if($p10 == 8) { // Otra situación laboral
			// Poner a NULL todo lo demás t10a, j10a y d10a junto a ramas
			$t10a1 = NULL;
			$t10a2 = NULL;
			$t10a3 = NULL;
			$t10a4 = NULL;
			$t10a5 = NULL;
			$t10b  = NULL;
			$t10b5 = NULL;
			$t10c  = NULL;
			$t10d1 = NULL;
			$t10d2 = NULL;
			$t10d3 = NULL;
			$t10d4 = NULL;
			$t10d5 = NULL;
			$t10d6 = NULL;
			$t10d7 = NULL;
			$t10d8 = NULL;
			$t10d9 = NULL;
			$t10d10 = NULL;
			$t10d11 = NULL;
			$t10d11otro = NULL;
			$j10a  = NULL;
			$d10a   = NULL;
			$d10a1  = NULL;
			$d10a112cual  = NULL;
			$d10a2  = NULL;
		}
		
		$encuesta = array('direc_ip'=>$direc_ip,'tiempo_realiz'=>$tiempo_realiz,'s101'=>$s101, 's102'=>$s102, 'p1'=>$p1, 'p21'=>$p21, 'p22'=>$p22, 'p23'=>$p23, 'p24'=>$p24, 'p25'=>$p25, 'p26'=>$p26, 'p27'=>$p27, 'p3'=>$p3, 'p4'=>$p4, 'p5'=>$p5, 'p6'=>$p6, 'p7'=>$p7, 'p8'=>$p8, 'p9'=>$p9, 'p9a'=>$p9a, 'p9b'=>$p9b, 'p9c'=>$p9c, 'p10'=>$p10, 'p108'=>$p108, 't10a1'=>$t10a1, 't10a2'=>$t10a2, 't10a3'=>$t10a3, 't10a4'=>$t10a4, 't10a5'=>$t10a5, 't10b'=>$t10b, 't10b5'=>$t10b5, 't10c'=>$t10c, 't10d1'=>$t10d1, 't10d2'=>$t10d2, 't10d3'=>$t10d3, 't10d4'=>$t10d4, 't10d5'=>$t10d5, 't10d6'=>$t10d6, 't10d7'=>$t10d7, 't10d8'=>$t10d8, 't10d9'=>$t10d9, 't10d10'=>$t10d10, 't10d11'=>$t10d11, 't10d11otro'=>$t10d11otro, 'j10a'=>$j10a, 'd10a'=>$d10a, 'd10a1'=>$d10a1, 'd10a112cual'=>$d10a112cual, 'd10a2'=>$d10a2, 's1'=>$s1, 's2'=>$s2, 's3'=>$s3, 's4'=>$s4, 's5'=>$s5, 's6'=>$s6, 's7'=>$s7, 's8'=>$s8, 's82'=>$s82, 's9'=>$s9);

		// revisión del array
		// var_dump($encuesta); Correcto 27/jul/2017 - 20:22 horas

		// Enviar los datos a la tabla conciliacion de la BBDD de encuestas
        if(BD::setInsRegConciliacion($encuesta)) {
        	/**
            $smarty->assign('mensaje', 'Se ha añadido el ingreso correctamente';
            header("Location: banca.php");
            **/
        } else {
        	/**
            $smarty->assign('mensaje', 'No se ha podido hacer el ingreso por algún error');
            **/
            echo "Error en la transacción";
        }
    }
}

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Plan de Conciliación de la vida personal y laboral</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./include/estilo-aytohv.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
    <?php $xajax->printJavascript(); // Enviamos el código JavaScript ?>
	<script type="text/javascript">
	// JQuery para mostrar o ocultar preguntas del formulario
	$(document).ready(function(){
		
		// Para pregunta P9
		$('input[name=p9]').click(function(){
			if($(this).val() == 1) { // Tiene cónyuge y misma vivienda
				$('#p9abc').css('display', 'block');
			} else {
				$('#p9abc').css('display', 'none');
				$('input[name=p9').each(function(){
					if($(this).checked) $(this).prop("checked", false);
				});
			}
		}); // Pregunta P9

		// Para pregunta P10
		$('input[name=p10').click(function(){
			if($(this).val() == 1) { // Trabajando
				$('#trabajando').css('display','block');
			} else {
				$('#trabajando').css('display','none');
				$('input[name=p10a]').each(function() {
					if($(this).checked) $(this).prop("checked", false);
				});
			}
			
			if($(this).val() == 2 || $(this).val() == 3) { // Jubilados
				$('#jubil').css('display','block');
			} else {
				$('#jubil').css('display','none');
			}

			if($(this).val() >= 4 && $(this).val() <= 7) { // Desempleados, estudiantes, Ama/o de casa
				$('#desemEstudAma').css('display','block');
			} else {
				$('#desemEstudAma').css('display','none');
			}

			if($(this).val() == 8) { // Otra
				$('#otraSit').css('display','block');
			} else {
				$('#otraSit').css('display','none');
			}
		}); // Pregunta P10

		// Para pregunta D10a
		$('input[name=d10a]').click(function(){
			if($(this).val() == 2) { // NO ha tratado de encontrar empleo
				$('#motivoNoBuscar').css('display', 'block');
			} else {
				$('#motivoNoBuscar').css('display', 'none');
			}
		}); // Pregunta D10a

		// Para pregunta S8
		$('input[name=s8]').click(function(){
			if($(this).val() == 2) { // Tiene nacionalidad diferente a la española y tiene que especificarla
				$('#s82').css('display', 'block');
			} else {
				$('#s82').css('display', 'none');
			}
		}); // Pregunta S8


		// Para pregunta T10b
		$('input[name=t10b]').click(function(){
			if($(this).val() == 5) { // Tiene nacionalidad diferente a la española y tiene que especificarla
				$('#t10b').css('display', 'block');
			} else {
				$('#t10b').css('display', 'none');
			}
		}); // Pregunta t10b


		// Para pregunta T10d
		$('input[name=t10d11]').click(function(){
			if($(this).is(':checked')){
				$('#t10d11').css('display', 'block');
			} else {
				$('#t10d11').css('display', 'none');
			}
		}); // Pregunta T10d

		// Para pregunta d10a1
		$('input[name=d10a1]').click(function(){
			if($(this).val() == 12) { // Tiene nacionalidad diferente a la española y tiene que especificarla
				$('#d10a112').css('display', 'block');
			} else {
				$('#d10a112').css('display', 'none');
			}
		}); // Pregunta d10a2

	});
	</script>

</head>

<body>
	<div id="principal" class="w3-container">
		<header id="cabecera" class="w3-container">
			<div id="encabezado" class="w3-row">
				<div class="ayto-titulo w3-half w3-container">
					<div class="ayto-titulo w3-row">
						<div class="w3-col w3-container" style="width: 100px">
							<a href="http://www.huetorvega.es" title="Accede al portal del Ayuntamiento de Huétor Vega. Erlenmeyer [CC BY-SA 3.0 (http://creativecommons.org/licenses/by-sa/3.0)], via Wikimedia Commons" href="https://commons.wikimedia.org/wiki/File%3AEscudo_de_Hu%C3%A9tor_Vega_(Granada).svg"><img width="128" alt="Escudo de Huétor Vega (Granada)" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Escudo_de_Hu%C3%A9tor_Vega_%28Granada%29.svg/128px-Escudo_de_Hu%C3%A9tor_Vega_%28Granada%29.svg.png"/></a>
						</div>

						<div class="ayto-nombre w3-rest w3-container">
							<a href="http://www.huetorvega.es" title="Accede al portal del Ayuntamiento de Huétor Vega">
							<h4><b>Ayuntamiento de Huétor Vega</b></h4></a>
							<p class="w3-tiny">Frontera entre la Nieve y la Vega</p>
						</div>
					</div>
				</div>

				<div id="logoPortal" class="w3-half w3-container"><h2 class="w3-right">Portal de Encuestas</h2></div>
			</div>

			<div id="menu" class="w3-container">
				<!-- Menú del Portal -->
				<h3 class="w3-center">Encuesta Conciliación de la Vida Personal, Laboral y Familiar</h3>
			</div>

			<div id="miga_pan">
				<!-- Migan pan Portal -->
			</div>
		</header>


		<!-- Inicio de la capa para formulario Concilia -->
		<div id="formEncConcilia">

			<!-- Apartados del formulario -->
			<!-- Barra de porcentaje Aún no está acabada -->
			<!-- 
			<p>Porcentaje de realizado:</p>
			<div class="w3-progress-container">
				<div id="barProgreso" class="w3-progressbar w3-red" style="width:50%"></div>
			</div>
			-->

			<!-- Nueva version de apartados 17/07/2017 -->
			<div id="apartados" class="w3-container w3-row w3-light-grey">
				<div id="apaInicio" class="w3-col w3-padding w3-center w3-blue" style="width:20%">
					<!--<i class="fa fa-circle-o" style="font-size:12px"></i>--> Inicio <i class="fa fa-angle-double-right" style="font-size:16px"></i></div>
				<div id="apaValoraciones" class="w3-col w3-padding w3-center w3-red" style="width:20%">
					<!--<i class="fa fa-circle-o" style="font-size:12px"></i>--> Valoraciones <i class="fa fa-angle-double-right" style="font-size:16px"></i></div>
				<div id="apaTareas" class="w3-col w3-padding w3-center w3-red" style="width:20%">
					<!--<i class="fa fa-circle-o" style="font-size:12px"></i>--> Tareas <i class="fa fa-angle-double-right" style="font-size:16px"></i></div>
				<div id="apaSitLaboral" class="w3-col w3-padding w3-center w3-red" style="width:20%">
					<!--<i class="fa fa-circle-o" style="font-size:12px"></i>--> Situación laboral <i class="fa fa-angle-double-right" style="font-size:16px"></i></div>
				<div id="apaFin" class="w3-col w3-padding w3-center w3-red" style="width:20%">
					<!--<i class="fa fa-circle-o" style="font-size:12px"></i>--> Fin <i class="fa fa-angle-double-right" style="font-size: "></i></div>
			</div>

			<form class="w3-container w3-card-4" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="formEncConcilia">

			<!-- Pestaña 1 - Inicio -->
			<div id="inicio" class="w3-container opc" style="display: block">
				<br/>
				<div class="w3-panel w3-pale-yellow">
					<h3>Lugar de residencia habitual</h3>
				</div><br/>
				<!-- S10.1 -->
				<b>¿En qué provincia reside habitualmente usted?</b>
				<div class="w3-responsive">
					<select id="provincia" class="w3-select w3-border" name="s101" onChange="cambiarMunicipios();">
						<option value='Granada'>Granada</option>
						<option value='Álava/Araba'>Álava/Araba</option>
						<option value='Albacete'>Albacete</option>
						<option value='Alicante/Alacant'>Alicante/Alacant</option>
						<option value='Almería'>Almería</option>
						<option value='Asturias'>Asturias</option>
						<option value='Ávila'>Ávila</option>
						<option value='Badajoz'>Badajoz</option>
						<option value='Balears, Illes'>Balears, Illes</option>
						<option value='Barcelona'>Barcelona</option>
						<option value='Bizkaia'>Bizkaia</option>
						<option value='Burgos'>Burgos</option>
						<option value='Cáceres'>Cáceres</option>
						<option value='Cádiz'>Cádiz</option>
						<option value='Cantabria'>Cantabria</option>
						<option value='Castellón/Castelló'>Castellón/Castelló</option>
						<option value='Ceuta'>Ceuta</option>
						<option value='Ciudad Real'>Ciudad Real</option>
						<option value='Córdoba'>Córdoba</option>
						<option value='Coruña, A'>Coruña, A</option>
						<option value='Cuenca'>Cuenca</option>
						<option value='Gipuzkoa'>Gipuzkoa</option>
						<option value='Girona'>Girona</option>
						<option value='Guadalajara'>Guadalajara</option>
						<option value='Huelva'>Huelva</option>
						<option value='Huesca'>Huesca</option>
						<option value='Jaén'>Jaén</option>
						<option value='León'>León</option>
						<option value='Lleida'>Lleida</option>
						<option value='Lugo'>Lugo</option>
						<option value='Madrid'>Madrid</option>
						<option value='Málaga'>Málaga</option>
						<option value='Melilla'>Melilla</option>
						<option value='Murcia'>Murcia</option>
						<option value='Navarra'>Navarra</option>
						<option value='Ourense'>Ourense</option>
						<option value='Palencia'>Palencia</option>
						<option value='Palmas, Las'>Palmas, Las</option>
						<option value='Pontevedra'>Pontevedra</option>
						<option value='Rioja, La'>Rioja, La</option>
						<option value='Salamanca'>Salamanca</option>
						<option value='Santa Cruz de Tenerife'>Santa Cruz de Tenerife</option>
						<option value='Segovia'>Segovia</option>
						<option value='Sevilla'>Sevilla</option>
						<option value='Soria'>Soria</option>
						<option value='Tarragona'>Tarragona</option>
						<option value='Teruel'>Teruel</option>
						<option value='Toledo'>Toledo</option>
						<option value='Valencia/València'>Valencia/València</option>
						<option value='Valladolid'>Valladolid</option>
						<option value='Zamora'>Zamora</option>
						<option value='Zaragoza'>Zaragoza</option>
					</select>
				</div>
				<br/><br/>
				<!-- S10.1 -->

				<!-- S10.2 -->
				<b>¿En qué municipio reside habitualmente usted?</b>
				<div class="w3-responsive">
					<select class="w3-select w3-border" name="s102">
							<option value='HUETOR VEGA'>HUETOR VEGA</option>
							<option value='AGRON'>AGRON</option>
							<option value='ALAMEDILLA'>ALAMEDILLA</option>
							<option value='ALBOLOTE'>ALBOLOTE</option>
							<option value='ALBONDON'>ALBONDON</option>
							<option value='ALBUÑAN'>ALBUÑAN</option>
							<option value='ALBUÑOL'>ALBUÑOL</option>
							<option value='ALBUÑUELAS'>ALBUÑUELAS</option>
							<option value='ALDEIRE'>ALDEIRE</option>
							<option value='ALFACAR'>ALFACAR</option>
							<option value='ALGARINEJO'>ALGARINEJO</option>
							<option value='ALHAMA DE GRANADA'>ALHAMA DE GRANADA</option>
							<option value='ALHENDIN'>ALHENDIN</option>
							<option value='ALICUN DE ORTEGA'>ALICUN DE ORTEGA</option>
							<option value='ALMEGIJAR'>ALMEGIJAR</option>
							<option value='ALMUÑECAR'>ALMUÑECAR</option>
							<option value='ALPUJARRA DE LA SIERRA'>ALPUJARRA DE LA SIERRA</option>
							<option value='ALQUIFE'>ALQUIFE</option>
							<option value='ARENAS DEL REY'>ARENAS DEL REY</option>
							<option value='ARMILLA'>ARMILLA</option>
							<option value='ATARFE'>ATARFE</option>
							<option value='BAZA'>BAZA</option>
							<option value='BEAS DE GRANADA'>BEAS DE GRANADA</option>
							<option value='BEAS DE GUADIX'>BEAS DE GUADIX</option>
							<option value='BENALUA'>BENALUA</option>
							<option value='BENALUA DE LAS VILLAS'>BENALUA DE LAS VILLAS</option>
							<option value='BENAMAUREL'>BENAMAUREL</option>
							<option value='BERCHULES'>BERCHULES</option>
							<option value='BUBION'>BUBION</option>
							<option value='BUSQUISTAR'>BUSQUISTAR</option>
							<option value='CACIN'>CACIN</option>
							<option value='CADIAR'>CADIAR</option>
							<option value='CAJAR'>CAJAR</option>
							<option value='CALAHORRA (LA)'>CALAHORRA (LA)</option>
							<option value='CALICASAS'>CALICASAS</option>
							<option value='CAMPOTEJAR'>CAMPOTEJAR</option>
							<option value='CANILES'>CANILES</option>
							<option value='CAÑAR'>CAÑAR</option>
							<option value='CAPILEIRA'>CAPILEIRA</option>
							<option value='CARATAUNAS'>CARATAUNAS</option>
							<option value='CASTARAS'>CASTARAS</option>
							<option value='CASTILLEJAR'>CASTILLEJAR</option>
							<option value='CASTRIL'>CASTRIL</option>
							<option value='CENES DE LA VEGA'>CENES DE LA VEGA</option>
							<option value='CHAUCHINA'>CHAUCHINA</option>
							<option value='CHIMENEAS'>CHIMENEAS</option>
							<option value='CHURRIANA DE LA VEGA'>CHURRIANA DE LA VEGA</option>
							<option value='CIJUELA'>CIJUELA</option>
							<option value='COGOLLOS DE GUADIX'>COGOLLOS DE GUADIX</option>
							<option value='COGOLLOS DE LA VEGA'>COGOLLOS DE LA VEGA</option>
							<option value='COLOMERA'>COLOMERA</option>
							<option value='CORTES DE BAZA'>CORTES DE BAZA</option>
							<option value='CORTES Y GRAENA'>CORTES Y GRAENA</option>
							<option value='CUEVAS DEL CAMPO'>CUEVAS DEL CAMPO</option>
							<option value='CULLAR'>CULLAR</option>
							<option value='CULLAR VEGA'>CULLAR VEGA</option>
							<option value='DARRO'>DARRO</option>
							<option value='DEHESAS DE GUADIX'>DEHESAS DE GUADIX</option>
							<option value='DEHESAS VIEJAS'>DEHESAS VIEJAS</option>
							<option value='DEIFONTES'>DEIFONTES</option>
							<option value='DIEZMA'>DIEZMA</option>
							<option value='DILAR'>DILAR</option>
							<option value='DOLAR'>DOLAR</option>
							<option value='DOMINGO PEREZ DE GRANADA'>DOMINGO PEREZ DE GRANADA</option>
							<option value='DUDAR'>DUDAR</option>
							<option value='DURCAL'>DURCAL</option>
							<option value='ESCUZAR'>ESCUZAR</option>
							<option value='FERREIRA'>FERREIRA</option>
							<option value='FONELAS'>FONELAS</option>
							<option value='FREILA'>FREILA</option>
							<option value='FUENTE VAQUEROS'>FUENTE VAQUEROS</option>
							<option value='GABIAS (LAS)'>GABIAS (LAS)</option>
							<option value='GALERA'>GALERA</option>
							<option value='GOBERNADOR'>GOBERNADOR</option>
							<option value='GOJAR'>GOJAR</option>
							<option value='GOR'>GOR</option>
							<option value='GORAFE'>GORAFE</option>
							<option value='GRANADA'>GRANADA</option>
							<option value='GUADAHORTUNA'>GUADAHORTUNA</option>
							<option value='GUADIX'>GUADIX</option>
							<option value='GUAJARES (LOS)'>GUAJARES (LOS)</option>
							<option value='GUALCHOS'>GUALCHOS</option>
							<option value='GUEJAR SIERRA'>GUEJAR SIERRA</option>
							<option value='GUEVEJAR'>GUEVEJAR</option>
							<option value='HUELAGO'>HUELAGO</option>
							<option value='HUENEJA'>HUENEJA</option>
							<option value='HUESCAR'>HUESCAR</option>
							<option value='HUETOR DE SANTILLAN'>HUETOR DE SANTILLAN</option>
							<option value='HUETOR TAJAR'>HUETOR TAJAR</option>
							<option value='ILLORA'>ILLORA</option>
							<option value='ITRABO'>ITRABO</option>
							<option value='IZNALLOZ'>IZNALLOZ</option>
							<option value='JATAR'>JATAR</option>
							<option value='JAYENA'>JAYENA</option>
							<option value='JEREZ DEL MARQUESADO'>JEREZ DEL MARQUESADO</option>
							<option value='JETE'>JETE</option>
							<option value='JUN'>JUN</option>
							<option value='JUVILES'>JUVILES</option>
							<option value='LACHAR'>LACHAR</option>
							<option value='LANJARON'>LANJARON</option>
							<option value='LANTEIRA'>LANTEIRA</option>
							<option value='LECRIN'>LECRIN</option>
							<option value='LENTEGI'>LENTEGI</option>
							<option value='LOBRAS'>LOBRAS</option>
							<option value='LOJA'>LOJA</option>
							<option value='LUGROS'>LUGROS</option>
							<option value='LUJAR'>LUJAR</option>
							<option value='MALAHA (LA)'>MALAHA (LA)</option>
							<option value='MARACENA'>MARACENA</option>
							<option value='MARCHAL'>MARCHAL</option>
							<option value='MOCLIN'>MOCLIN</option>
							<option value='MOLVIZAR'>MOLVIZAR</option>
							<option value='MONACHIL'>MONACHIL</option>
							<option value='MONTEFRIO'>MONTEFRIO</option>
							<option value='MONTEJICAR'>MONTEJICAR</option>
							<option value='MONTILLANA'>MONTILLANA</option>
							<option value='MORALEDA DE ZAFAYONA'>MORALEDA DE ZAFAYONA</option>
							<option value='MORELABOR'>MORELABOR</option>
							<option value='MOTRIL'>MOTRIL</option>
							<option value='MURTAS'>MURTAS</option>
							<option value='NEVADA'>NEVADA</option>
							<option value='NIGUELAS'>NIGUELAS</option>
							<option value='NIVAR'>NIVAR</option>
							<option value='OGIJARES'>OGIJARES</option>
							<option value='ORCE'>ORCE</option>
							<option value='ORGIVA'>ORGIVA</option>
							<option value='OTIVAR'>OTIVAR</option>
							<option value='OTURA (VILLA DE)'>OTURA (VILLA DE)</option>
							<option value='PADUL'>PADUL</option>
							<option value='PAMPANEIRA'>PAMPANEIRA</option>
							<option value='PEDRO MARTINEZ'>PEDRO MARTINEZ</option>
							<option value='PELIGROS'>PELIGROS</option>
							<option value='PEZA (LA)'>PEZA (LA)</option>
							<option value='PINAR (EL)'>PINAR (EL)</option>
							<option value='PINOS GENIL'>PINOS GENIL</option>
							<option value='PINOS PUENTE'>PINOS PUENTE</option>
							<option value='PIÑAR'>PIÑAR</option>
							<option value='POLICAR'>POLICAR</option>
							<option value='POLOPOS'>POLOPOS</option>
							<option value='PORTUGOS'>PORTUGOS</option>
							<option value='PUEBLA DE DON FADRIQUE'>PUEBLA DE DON FADRIQUE</option>
							<option value='PULIANAS'>PULIANAS</option>
							<option value='PURULLENA'>PURULLENA</option>
							<option value='QUENTAR'>QUENTAR</option>
							<option value='RUBITE'>RUBITE</option>
							<option value='SALAR'>SALAR</option>
							<option value='SALOBREÑA'>SALOBREÑA</option>
							<option value='SANTA CRUZ DEL COMERCIO'>SANTA CRUZ DEL COMERCIO</option>
							<option value='SANTA FE'>SANTA FE</option>
							<option value='SOPORTUJAR'>SOPORTUJAR</option>
							<option value='SORVILAN'>SORVILAN</option>
							<option value='TAHA (LA)'>TAHA (LA)</option>
							<option value='TORRE-CARDELA'>TORRE-CARDELA</option>
							<option value='TORVIZCON'>TORVIZCON</option>
							<option value='TREVELEZ'>TREVELEZ</option>
							<option value='TURON'>TURON</option>
							<option value='UGIJAR'>UGIJAR</option>
							<option value='VALDERRUBIO'>VALDERRUBIO</option>
							<option value='VALLE (EL)'>VALLE (EL)</option>
							<option value='VALLE DEL ZALABI'>VALLE DEL ZALABI</option>
							<option value='VALOR'>VALOR</option>
							<option value='VEGAS DEL GENIL'>VEGAS DEL GENIL</option>
							<option value='VELEZ DE BENAUDALLA'>VELEZ DE BENAUDALLA</option>
							<option value='VENTAS DE HUELMA'>VENTAS DE HUELMA</option>
							<option value='VILLAMENA'>VILLAMENA</option>
							<option value='VILLANUEVA DE LAS TORRES'>VILLANUEVA DE LAS TORRES</option>
							<option value='VILLANUEVA MESIA'>VILLANUEVA MESIA</option>
							<option value='VIZNAR'>VIZNAR</option>
							<option value='ZAFARRAYA'>ZAFARRAYA</option>
							<option value='ZAGRA'>ZAGRA</option>
							<option value='ZUBIA (LA)'>ZUBIA (LA)</option>
							<option value='ZUJAR'>ZUJAR</option>
					</select>
				</div>
				<!-- S10.2 -->
				
				<p>
					<div class="w3-container w3-bar">
						<a class="w3-button w3-green w3-round w3-right" href="javascript:void(0)" onclick="abrirOpcion(event, 'inicio');">Siguiente <i class="fa fa-arrow-right" style="font-size:16px"></i></a>
					</div>
				</p>
			</div>

			<!-- Pestaña 2 - Valoraciones -->
			<div id="valoraciones" class="w3-container opc" style="display: none">
				<br/>
				<div class="w3-panel w3-pale-yellow">
					<h3>Valoraciones personales</h3>
				</div><br/>
				<!-- P1 -->
				<b>¿Podría decirme en qué medida se siente Ud. satisfecho/a con su vida en general? Para responder utilice una escala de 0 a 10 donde el 0 significa que está “completamente insatisfecho/a” y el 10 que está “completamente satisfecho/a”.</b><br/>
				<input type="hidden" name="p1" value="99">
				<div class="w3-responsive"> 
					<table class="w3-table w3-bordered w3-centered">
						<tr>
							<td>0</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
							<td>10</td>
						</tr>
						<tr>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="0">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="1">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="2">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="3">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="4">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="5">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="6">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="7">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="8">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="9">
							</td>
							<td>
								<input class="w3-radio" type="radio" name="p1" value="10">
							</td>
						</tr>
					</table>
				</div>
				<br/><br/>
				<!-- P1 -->

				<!-- P2 -->
				<b>Y, ¿en qué medida se siente Ud. satisfecho/a con cada uno de los siguientes aspectos?</b>
				<p></p>
				<div class="w3-container w3-card-4">
					<b>Su situación laboral (trabajar, estudiar, ser jubilado/a, estar parado/a, dedicarse al trabajo doméstico, etc.)</b><br/>
					<input type="hidden" name="p21" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p21" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>

					<b>Su vida familiar o relaciones familiares</b><br/>
					<input type="hidden" name="p22" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p22" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>


					<b>Su situación económica</b><br/>
					<input type="hidden" name="p23" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p23" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>


					<b>El trabajo que realiza/realizaba</b><br/>
					<input type="hidden" name="p24" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p24" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>


					<b>Sus amigos/as</b><br/>
					<input type="hidden" name="p25" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p25" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>


					<b>Su relación de pareja</b><br/>
					<input type="hidden" name="p26" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p26" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>


					<b>El tiempo libre del que dispone</b><br/>
					<input type="hidden" name="p27" value="99">
					<div class="w3-responsive"> 
						<table class="w3-table w3-bordered w3-centered">
							<tr>
								<td>0</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td>8</td>
								<td>9</td>
								<td>10</td>
							</tr>
							<tr>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="0">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="1">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="2">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="3">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="4">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="5">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="6">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="7">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="8">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="9">
								</td>
								<td>
									<input class="w3-radio" type="radio" name="p27" value="10">
								</td>
							</tr>
						</table>
					</div>
					<br/>
				</div>
				<!-- P2 -->

				<p>
					<div class="w3-container w3-bar">
						<!-- Deshabilitado el botón "Anterior"
						<a class="w3-button w3-red w3-round w3-left" href="javascript:void(0)" onclick="abrirOpcion(event, 'inicio');"><i class="fa fa-arrow-left" style="font-size:16px"></i> Anterior</a>
						-->
						<a class="w3-button w3-green w3-round w3-right" href="javascript:void(0)" onclick="abrirOpcion(event, 'valoraciones');">Siguiente <i class="fa fa-arrow-right" style="font-size:16px"></i></a>
					</div>
				</p>

			</div>

			<!-- Pestaña 3 - Tareas -->
			<div id="tareas" class="w3-container opc" style="display: none">
				<br/>
				<div class="w3-panel w3-pale-yellow">
					<h3>Reparto de Tareas</h3>
				</div><br/>
				<!-- P3 -->
				<b>En caso de que uno de los dos miembros de la pareja tenga que trabajar menos de forma remunerada, para ocuparse de las tareas del hogar y el cuidado de los hijos/as o familiares dependientes, ¿quién cree que debería ser? </b><br/>
				<input type="hidden" name="p3" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="p3" value="1" >
							<label>El hombre</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p3" value="2" >
							<label>La mujer</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p3" value="3" >
							<label>Cualquiera de ellos, depende de otros factores (quién gane menos, tenga un trabajo más precario)</label>
						</li>
					</ul>
				</div>
				<br/><br/>
				<!-- P3 -->

				<!-- P4 -->
				<b>Piense ahora en una pareja con un/a hijo/a menor de 3 años en la que ambos tienen las mismas oportunidades y/o condiciones laborales. ¿Cuál de las siguientes es, en su opinión, la mejor forma de organizar su vida familiar y laboral?</b><br/>
				<input type="hidden" name="p4" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="p4" value="1" >
							<label>La madre en casa y el padre trabaja la jornada completa</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p4" value="2" >
							<label>La madre trabaja a tiempo parcial y el padre a jornada completa</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p4" value="3" >
							<label>Ambos, la madre y el padre, trabajan la jornada completa</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p4" value="4" >
							<label>Ambos, la madre y el padre, trabajan a tiempo parcial</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p4" value="5" >
							<label>El padre trabaja a tiempo parcial y la madre la jornada completa</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p4" value="6" >
							<label>El padre en casa y la madre trabaja la jornada completa</label>
						</li>
					</ul>
				</div>
				<br/><br/>
				<!-- P4 -->	

				<!-- P5 -->
				<b>Si tanto el padre como la madre trabajan, ¿cuál de las siguientes opciones cree que es mejor para el/la niño/a (menor de 3 años).</b><br/>
				<input type="hidden" name="p5" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="p5" value="1" >
							<label>Que vaya a una escuela infantil</label><br/>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p5" value="2" >
							<label>Que lo cuide una persona remunerada</label><br/>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p5" value="3" >
							<label>Que lo cuiden los/as abuelos/as u otros familiares</label>
						</li>
					</ul>
				</div>
				<br/><br/>
				<!-- P5 -->	

				<!-- P6 -->
				<b> ahora en las personas que, debido a tener una edad avanzada, una discapacidad o una enfermedad crónica, no pueden realizar sin ayuda actividades básicas de la vida cotidiana tales como ir al baño, ducharse o vestirse. ¿Cuál de las siguientes opciones considera Ud. mejor para organizar el cuidado de estas personas dependientes?</b><br/>
				<input type="hidden" name="p6" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="p6" value="1" >
							<label>Vivir en un centro o residencia</label><br/>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p6" value="2" >
							<label>Vivir con alguien de la familia</label><br/>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p6" value="3" >
							<label>Vivir con un/a cuidador/a (persona remunerada)</label>
						</li>
					</ul>
				</div>
				<br/><br/>
				<!-- P6 -->

				<!-- P7 -->
				<b>¿Cuántas horas a la semana le dedica Ud., personalmente, a las tareas domésticas, sin incluir el cuidado de los/as hijos/as ni actividades de ocio?</b>
				<div class="w3-responsive">
					<input class="w3-input w3-border" type="number" name="p7" maxlength="2" pattern="[0-9]*" min="0" max="90" placeholder="Cantidad en horas" value="0">
				</div>
				<br/><br/>
				<!-- P7 -->

				<!-- P8 -->
				<b>Y, aproximadamente, ¿cuántas horas a la semana dedica Ud. al cuidado de algún miembro de la familia (p. ej. niños, ancianos o personas con discapacidad?</b>
				<div class="w3-responsive">
					<input class="w3-input w3-border" type="number" name="p8" maxlength="2" pattern="[0-9]*" min="0" max="90" placeholder="Cantidad en horas">
				</div>
				<br/><br/>
				<!-- P8 -->

				<!-- P9 -->
				<b>¿En cuál de las siguientes situaciones se encuentra Ud. en la actualidad?</b><br/>
				<input type="hidden" name="p9" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="p9" value="1" >
							<label>Tiene cónyuge o pareja y comparten la misma vivienda</label>
							<!-- Si la opcion anterior con value="1" es la seleccionada hay que pasar a P9a, P9b y P9c, o sea que aparezcan automáticamente para ser contestadas -->
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p9" value="2" >
							<label>Tiene cónyuge o pareja, pero no comparten la misma vivienda</label><br/>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="p9" value="3" >
							<label>No tiene cónyuge ni pareja</label>
						</li>

						<!-- P9a P9b y P9c -->
						<div id="p9abc" class="w3-container w3-card-4" style="display: none;">
							<!-- P9a -->
							<br/>
							<b>P9a. Aproximadamente, ¿cuántas horas a la semana dedica su cónyuge/pareja a las tareas domésticas, sin incluir el cuidado de los/as hijos/as ni actividades de ocio?</b>
							<div class="w3-responsive">
								<input class="w3-input w3-border" type="number" name="p9a" maxlength="2" pattern="[0-9]*" min="0" max="90" placeholder="Cantidad en horas">
							</div><br/>
							<!-- P9a -->
							<!-- P9b -->
							<b>P9b. Y, aproximadamente, ¿cuántas horas a la semana dedica su cónyuge/pareja al cuidado de algún miembro de la familia.<br/>(p. ej. niños, ancianos o personas con discapacidad)?</b>
							<div class="w3-responsive">
								<input class="w3-input w3-border" type="number" name="p9b" maxlength="2" pattern="[0-9]*" min="0" max="90" placeholder="Cantidad en horas">
							</div>
							<br/>
							<!-- P9b -->
							<!-- P9c -->
							<b>P.9c. ¿Cuál de las frases siguientes describe mejor la forma en que se reparten las tareas domésticas Ud. y su cónyuge/pareja?</b>
							<input type="hidden" name="p9c" value="99">
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<input class="w3-radio" type="radio" name="p9c" value="1" >
										<label>Ud. hace mucho menos de lo que le corresponde</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="p9c" value="2" >
										<label>Ud. hace algo menos de lo que le corresponde</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="p9c" value="3" >
										<label>Ud. hace más o menos lo que le corresponde</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="p9c" value="4" >
										<label>Ud. hace algo más de lo que le corresponde</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="p9c" value="5" >
										<label>Ud. hace mucho más de lo que le corresponde</label>
									</li>
								</ul>
							</div> <!-- P9c -->
							<br/>
						</div> <!-- P9a P9b y P9c -->
					</ul>
				</div>
				<!-- P9 -->


				<p>
					<div class="w3-container w3-bar">
						<!-- Deshabilitado el botón "Anterior"
						<a class="w3-button w3-red w3-round w3-left" href="javascript:void(0)" onclick="abrirOpcion(event, 'valoraciones');"><i class="fa fa-arrow-left" style="font-size:16px"></i> Anterior</a>
						-->
						<a class="w3-button w3-green w3-round w3-right" href="javascript:void(0)" onclick="abrirOpcion(event, 'tareas');">Siguiente <i class="fa fa-arrow-right" style="font-size:16px"></i></a>
					</div>
				</p>
			</div> <!-- Pestaña 3 - Tareas -->

			<!-- Pestaña 4 - Situación laboral -->
			<div id="sitLaboral" class="w3-container opc" style="display: none">
				<br/>
				<div class="w3-panel w3-pale-yellow">
					<h3>Situación Laboral</h3>
				</div><br/>
				<!-- P10 -->
				<b>¿Cuál es su situación laboral actual?</b><br/>
				<input type="hidden" name="p10" value="99">
				<div class="w3-responsive">
					<ul class="w3-ul">
						<li>
							<input id="trabaja" class="w3-radio" type="radio" name="p10" value="1">
							<label>Trabajando (incluya si está de baja)</label><br/>
							<!-- Si la opcion anterior con value="1" es la seleccionada hay que pasar a T10a, o sea que aparezcan automáticamente para ser contestadas -->
						</li>
						<li>
							<input id="jubilado" class="w3-radio" type="radio" name="p10" value="2" >
							<label>Jubilado/a pensionista (anteriormente ha trabajado)</label>
						</li>
						<li>
							<input id="jubilado" class="w3-radio" type="radio" name="p10" value="3" >
							<label>Jubilado/a pensionista (anteriormente no ha trabajado)</label>
						</li>
						<li>
							<input id="desem-estud" class="w3-radio" type="radio" name="p10" value="4" >
							<label>Desempleado, busca primer empleo</label>
						</li>
						<li>
							<input id="desem-estud" class="w3-radio" type="radio" name="p10" value="5" >
							<label>Desempleado, ha trabajado antes</label>
						</li>
						<li>
							<input id="desem-estud" class="w3-radio" type="radio" name="p10" value="6" >
							<label>Estudiante</label>
						</li>
						<li>
							<input id="desem-estud" class="w3-radio" type="radio" name="p10" value="7" >
							<label>Ama de casa</label>
						</li>
						<li>
							<input id="desem-estud" class="w3-radio" type="radio" name="p10" value="8" >
							<label>Otro</label>
						</li>

						<!-- T10a a T10d -->
						<div id="trabajando" class="w3-container w3-card-4" style="display: none;">
							<br/>
							<b>¿Con qué frecuencia ha experimentado Ud., durante los últimos tres meses, algunas de las situaciones que se describen a continuación?</b>
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<b>Ha vuelto del trabajo demasiado cansada/o para hacer las tareas de la casa.</b>
										<input type="hidden" name="t10a1" value="99">
										<div class="w3-responsive">
											<ul class="w3-ul">
												<li>
													<input class="w3-radio" type="radio" name="t10a1" value="1" >
													<label>Varias veces a la semana</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a1" value="2" >
													<label>Varias veces al mes</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a1" value="3" >
													<label>Varias veces al año</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a1" value="4" >
													<label>Nunca</label>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<b>Le ha resultado difícil cumplir con sus responsabilidades familiares, debido al tiempo que había dedicado a su trabajo (remunerado).</b>
										<input type="hidden" name="t10a2" value="99">
										<div class="w3-responsive">
											<ul class="w3-ul">
												<li>
													<input class="w3-radio" type="radio" name="t10a2" value="1" >
													<label>Varias veces a la semana</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a2" value="2" >
													<label>Varias veces al mes</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a2" value="3" >
													<label>Varias veces al año</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a2" value="4" >
													<label>Nunca</label>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<b>Ha llegado al trabajo demasiado cansada/o por haber tenido que hacer las tareas de la casa.</b>
										<input type="hidden" name="t10a3" value="99">
										<div class="w3-responsive">
											<ul class="w3-ul">
												<li>
													<input class="w3-radio" type="radio" name="t10a3" value="1" >
													<label>Varias veces a la semana</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a3" value="2" >
													<label>Varias veces al mes</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a3" value="3" >
													<label>Varias veces al año</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a3" value="4" >
													<label>Nunca</label>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<b>Ha tenido dificultades para concentrarse en su trabajo, debido a sus responsabilidades familiares.</b>
										<input type="hidden" name="t10a4" value="99">
										<div class="w3-responsive">
											<ul class="w3-ul">
												<li>
													<input class="w3-radio" type="radio" name="t10a4" value="1" >
													<label>Varias veces a la semana</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a4" value="2" >
													<label>Varias veces al mes</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a4" value="3" >
													<label>Varias veces al año</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a4" value="4" >
													<label>Nunca</label>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<b>Le ha resultado difícil poder realizar sus aficiones, (deporte, cine, lectura, quedar con amigos/as…) debido al tiempo que había dedicado a su trabajo o responsabilidades familiares.</b>
										<input type="hidden" name="t10a5" value="99">
										<div class="w3-responsive">
											<ul class="w3-ul">
												<li>
													<input class="w3-radio" type="radio" name="t10a5" value="1" >
													<label>Varias veces a la semana</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a5" value="2" >
													<label>Varias veces al mes</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="t10a5" value="3" >
													<label>Varias veces al año</label>
												</li>
												<li>
													<input class="w3-radio" type="radio" name="T10a5" value="4" >
													<label>Nunca</label>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div><br/>

							<b>¿Qué tipo de jornada laboral tiene?</b>
							<input type="hidden" name="t10b" value="99">
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<input class="w3-radio" type="radio" name="t10b" value="1">
										<label>Jornada completa continua</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10b" value="2">
										<label>Jornada completa partida</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10b" value="3">
										<label>Jornada completa reducida</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10b" value="4">
										<label>Jornada parcial</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10b" value="5">
										<label>Otra</label>
									</li>
									<li id="t10b" style="display: none;">
										<label>¿Cuál?</label>
										<input class="w3-input w3-border" type="text" name="t10b5" placeholder="Máximo 25 caractéres" maxlength="25">
									</li>
								</ul>
							</div><br/>
							<!-- Pregunta T10c -->
							<b>¿Qué tipo de trabajo tiene?</b>
							<input type="hidden" name="t10c" value="99">
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<input class="w3-radio" type="radio" name="t10c" value="1">
										<label>Por cuenta ajena</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10c" value="2">
										<label>Por cuenta propia (sin asalariados a su cargo)</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="t10c" value="3">
										<label>Por cuenta propia (con uno o más asalariados a su cargo)</label>
									</li>
								</ul>
							</div> <!-- Pregunta T10c -->
							<br/>
							<!-- Pregunta T10d -->
							<b>¿Su empresa u organización proporciona a los /as trabajadores/as algunas de las siguientes medidas?</b><br/>
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<input class="w3-check" type="checkbox" name="t10d1" value="Ayudas para la vivienda">
										<label>Ayudas para la vivienda</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d2" value="Planes de pensiones o complementos de pensiones">
										<label>Planes de pensiones o complementos de pensiones</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d3" value="Ayudas para la formación (disposición de días, flexibilidad horaria, ayudas económicas…)">
										<label>Ayudas para la formación (disposición de días, flexibilidad horaria, ayudas económicas…)</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d4" value="Comedor para empleados/as o ayudas para manutención">
										<label>Comedor para empleados/as o ayudas para manutención</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d5" value="Ayudas de transporte">
										<label>Ayudas de transporte</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d6" value="Ayudas para gastos en área de salud">
										<label>Ayudas para gastos en área de salud</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d7" value="Ayudas para enseñanza de hijos/as o familiares">
										<label>Ayudas para enseñanza de hijos/as o familiares</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d8" value="Guarderías o ayudas para guarderías">
										<label>Guarderías o ayudas para guarderías</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d9" value="Ofertas de ocio">
										<label>Ofertas de ocio</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d10" value="Flexibilidad horaria">
										<label>Flexibilidad horaria</label>
									</li>
									<li>
										<input class="w3-check" type="checkbox" name="t10d11" value="Algún otro tipo de servicio social">
										<label>Algún otro tipo de servicio social</label>
									</li>
									<li id="t10d11" style="display: none;">	
										<label>¿Qué otro tipo de servicio social?</label>
										<input class="w3-input w3-border" type="text" name="t10d11otro" placeholder="Máximo 25 caractéres" maxlength="25">
									</li>
								</ul>
							</div> <!-- Pregunta T10d -->
							<br/>
						</div> <!-- Fin T10a a T10d -->

						<!-- J10a  -->
						<div id="jubil" class="w3-container w3-card-4" style="display: none;">
							<br/>
							<b>¿Podría decirme en qué medida se siente Ud. necesario para que su familia más próxima pueda conciliar la vida laboral, familiar y personal? Para responder utilice una escala de 0 a 10 donde el 0 significa que está “completamente innecesario/a” y el 10 que está “completamente necesario/a”</b><br/>
							<input type="hidden" name="j10a" value="99">
							<div class="w3-responsive"> 
								<table class="w3-table w3-bordered w3-centered">
									<tr>
										<td>0</td>
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
										<td>5</td>
										<td>6</td>
										<td>7</td>
										<td>8</td>
										<td>9</td>
										<td>10</td>
									</tr>
									<tr>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="0">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="1">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="2">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="3">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="4">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="5">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="6">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="7">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="8">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="9">
										</td>
										<td>
											<input class="w3-radio" type="radio" name="j10a" value="10">
										</td>
									</tr>
								</table>
							</div>
							<br/><br/>
						</div> <!-- Fin J10a -->

						<!-- D10a  -->
						<div id="desemEstudAma" class="w3-container w3-card-4" style="display: none;">
							<br/>
							<b>Pensando en las cuatro últimas semanas, ¿ha tratado de encontrar algún empleo?</b>
							<input type="hidden" name="d10a" value="99">
							<div class="w3-responsive">
								<ul class="w3-ul">
									<li>
										<input class="w3-radio" type="radio" name="d10a" value="1" >
										<label>Si</label>
									</li>
									<li>
										<input class="w3-radio" type="radio" name="d10a" value="2" >
										<label>No</label>
									</li>
								</ul>
							</div>

							<!-- Preguntas Motivo No Buscar -->
							<div id="motivoNoBuscar" class="w3-container w3-card-4" style="display: none;">
								<br/>
								<b>¿Cuál es el PRINCIPAL MOTIVO por el que no ha tratado de buscar empleo en las últimas semanas?</b>
								<input type="hidden" name="d10a1" value="99">
								<div class="w3-responsive">
									<ul class="w3-ul">
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="1" >
											<label>Cree que no lo va a encontrar</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="2" >
											<label>Está afectado por una regulación de empleo</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="3" >
											<label>Por enfermedad o incapacidad propia</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="4" >
											<label>Cuidado de hijos/as o personas dependientes</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="5" >
											<label>Tiene otras responsabilidades familiares o personales</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="6" >
											<label>Está cursando estudios o recibiendo formación o bien pretende comenzarlos</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="7" >
											<label>No tiene necesidades económicas</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="8" >
											<label>Estoy pensando/desarrollando una idea para establecerme por mi cuenta/emprender</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="9" >
											<label>Porque se ha quedado en situación de desempleo muy recientemente</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="10" >
											<label>Tiene una expectativa real de trabajo (esperando que la llamen)</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="11" >
											<label>Sus familiares piensan que no es necesario que trabaje</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a1" value="12" >
											<label>Otra</label>
										</li>
										<li id="d10a112" style="display: none;">
											<label>¿Cuál?</label>
											<input class="w3-input w3-border" type="text" name="d10a112cual" placeholder="Máximo 25 caractéres" maxlength="25">
										</li>
									</ul>
								</div>
								<br/>
								<b>Más concretamente, dígame si el motivo de no buscar empleo es alguno de los siguientes:</b>
								<input type="hidden" name="d10a2" value="99">
								<div class="w3-responsive">
									<ul class="w3-ul">
										<li>
											<input class="w3-radio" type="radio" name="d10a2" value="1" >
											<label>Porque no hay servicios adecuados para el cuidado de hijos/as o son demasiado costosos</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a2" value="2" >
											<label>Porque no hay servicios adecuados para el cuidado de personas dependientes o son demasiado costosos</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a2" value="3" >
											<label>Los dos anteriores</label>
										</li>
										<li>
											<input class="w3-radio" type="radio" name="d10a2" value="4" >
											<label>Ninguno de ellos</label>
										</li>
									</ul>
								</div><br/>
							</div>	<!-- Preguntas Motivo No Buscar -->					
						</div> <!-- Fin D10a -->

						<!-- P108  -->
						<div id="otraSit" class="w3-container w3-card-4" style="display: none;">
							<br/>
							<div class="w3-responsive">
								<b>¿Cuál?</b>
								<input class="w3-input w3-border" type="text" name="p108" placeholder="Máximo 25 caractéres" maxlength="25">
							</div><br/>
						</div> <!-- Fin P108 -->
					</ul>
				</div>
				<!-- P10a -->

				<p>
					<div class="w3-container w3-bar">
						<!-- Deshabilitado el botón "Anterior"
						<a class="w3-button w3-red w3-round w3-left" href="javascript:void(0)" onclick="abrirOpcion(event, 'tareas');"><i class="fa fa-arrow-left" style="font-size:16px"></i> Anterior</a>
						-->
						<a class="w3-button w3-green w3-round w3-right" href="javascript:void(0)" onclick="abrirOpcion(event, 'sitLaboral');">Siguiente <i class="fa fa-arrow-right" style="font-size:16px"></i></a>
					</div>
				</p>					

			</div>

			<!-- Pestaña 5 Otros y final -->
			<div id="fin" class="w3-container opc" style="display: none">
				<br/>
				<div class="w3-panel w3-pale-yellow">
					<h3>Otros Datos de Interés</h3>
				</div><br/>
				<!-- Preguntas -->
				<!-- S1 -->
				<b>¿Cuál es su sexo?</b>
				<input type="hidden" name="s1" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="s1" value="1">
							<label>Hombre</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s1" value="2">
							<label>Mujer</label>
						</li>
					</ul>
				</div><br/>
				<!-- S1 -->
				<!-- S2 -->
				<b>¿Podría indicarme cuál es su edad?</b>
				<input type="hidden" name="s2" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-input w3-border" type="number" name="s2" maxlength="2" pattern="[0-9]*" min="18" max="99" placeholder="Insertar la Edad">
						</li>
					</ul>
				</div><br/>
				<!-- S2 -->
				<!-- S3 -->
				<b>¿Cuál es su estado civil?</b>
				<input type="hidden" name="s3" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="s3" value="1">
							<label>Soltero/a</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s3" value="2">
							<label>Casado/a</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s3" value="3">
							<label>Conviviendo en pareja</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s3" value="4">
							<label>Divorciado/a o separado/a</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s3" value="5">
							<label>Viudo/a</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s3" value="6">
							<label>Otros</label>
						</li>
					</ul>
				</div><br/>
				<!-- S3 -->
				<!-- S4 -->
				<b>¿Podría indicarme  el nº de personas que residen en su hogar contando con Ud.?</b>
				<input type="hidden" name="s4" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-input w3-border" type="number" name="s4" maxlength="2" pattern="[0-9]*" min="0" max="20" placeholder="Número de personas">
						</li>
					</ul>
				</div><br/>
				<!-- S4 -->
				<!-- S5 -->
				<b>¿Cuántos/as hijos/as tiene a su cargo?</b>
				<input type="hidden" name="s5" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-input w3-border" type="number" name="s5" maxlength="2" pattern="[0-9]*" min="0" max="20" placeholder="Número de hijos a su cargo">
						</li>
					</ul>
				</div><br/>
				<!-- S5 -->
				<!-- S6 -->
				<b>¿Cuántas personas dependientes tiene usted a su cargo? (no puede valerse por sí misma y necesita asistencia de alguien o de algo)</b>
				<input type="hidden" name="s6">
				<div class="w3-container">
					<select class="w3-select w3-border" name="s6">
						<option value="99">Seleccione una opción...</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="55">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9 o más</option>
					</select>
				</div><br/>
				<!-- S6 -->
				<!-- S7 -->
				<b>¿Podría indicarme qué nivel de estudios terminados tiene Ud.?</b>
				<input type="hidden" name="s7" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="s7" value="1">
							<label>Sin estudios reglados</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="2">
							<label>Bachiller Elemental, EGB, ESO completa (Graduado escolar)</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="3">
							<label>Bachiller superior, BUP, Bachiller LOGSE, COU, PREU</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="4">
							<label>FPI, FP grado medio, Oficialía Industrial o equivalente</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="5">
							<label>FPII, FP superior, Maestría industrial o equivalente</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="6">
							<label>Diplomatura, Ingeniería Técnica, 3 cursos aprobados de Licenciatura, Ingeniería o Arquitectura</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="7">
							<label>Grado, Licenciatura, Arquitectura, Ingeniería o equivalente</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s7" value="8">
							<label>Estudios de Grado, Master Univ. Oficiales y Doctorado</label>
						</li>
					</ul>
				</div><br/>
				<!-- S7 -->
				<!-- S8 -->
				<b>¿Le importaría decirme cuál es su nacionalidad?</b>
				<input type="hidden" name="s8" value="99">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="s8" value="1">
							<label>Española</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s8" value="2">
							<label>Otra</label>
						</li>
						<li id="s82" style="display: none;">
							<label>¿Cuál?</label>
							<input class="w3-input w3-border" type="text" name="s82">
						</li>
					</ul>
				</div><br/>
				<!-- S8 -->
				<!-- Preguntas -->

				<p>
					<div class="w3-container w3-bar">
						<!-- Deshabilitado el botón "Anterior"
						<a class="w3-button w3-red w3-round w3-left" href="javascript:void(0)" onclick="abrirOpcion(event, 'sitLaboral');"><i class="fa fa-arrow-left" style="font-size:16px"></i> Anterior</a>
						-->
						<a class="w3-button w3-green w3-round w3-right" href="javascript:void(0)" onclick="abrirOpcion(event, 'fin');">Finalizar <i class="fa fa-check" style="font-size:16px"></i></a>
					</div>
				</p>

			</div>

			<!-- Pestaña final agradecimientos -->
			<div id="gracias" class="w3-container opc" style="display: none">
				<br/>
				<div class="w3-panel w3-green w3-padding w3-center">
					<h3>Gracias por contestar la Encuesta</h3>
					<p>La encuesta ha concluido. Muchas gracias por su colaboración. Agradecemos el tiempo que ha dedicado a realizar esta encuesta.<br/>Sus respuestas han sido guardadas anónimamente y serán analizadas de forma conjunta con el resto de resultados.</p>
				</div><br/>

				<div id="ultPreg" class="w3-container">
					<b>Podría decirme, por último, ¿Cuáles son los ingresos netos que entran en su hogar al mes por todos los conceptos? (Es decir, incluyendo lo que aportan todos los miembros del hogar)</b>
					<input type="hidden" name="s9" value="99">
					<div class="w3-responsive">
						<ul class="w3-ul">
						<li>
							<input class="w3-radio" type="radio" name="s9" value="1" >
							<label>Menos de 300 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="2" >
							<label>Entre 301 y 600 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="3" >
							<label>Entre 601 y 900 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="4" >
							<label>Entre 901 y 1200 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="5" >
							<label>Entre 1201 y 1500 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="6" >
							<label>Entre 1501 y 2000 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="7" >
							<label>Entre 2001 y 2500 Euros</label>
						</li>
						<li>
							<input class="w3-radio" type="radio" name="s9" value="8" >
							<label>Más de 2500 Euros</label>
						</li>
					</div>

					<!-- TO DO botón Finalizar como submit a través de javascript o html y envío de datos del formulario -->
					<div> <!-- Boton enviar encuesta -->
						<p>
							<div class="w3-display-container w3-padding">
								<input type="hidden" name="envio" value="1">
								<a class="w3-button w3-green w3-round w3-padding-large w3-display-middle" href="javascript:void(0)" onclick="abrirOpcion(event, 'envio');">Enviar Encuesta <i class="fa fa-check" style="font-size:16px"></i></a>
							</div>
						</p>
					</div><br/>
				</div>
			</div>
			</form> <!-- Fin del formulario Concilia -->
		</div> <!-- Fin de la capa para formulario Concilia -->

		<!-- Pestaña de envío de datos y redireccionamiento a portal web -->
		<div id="enviando" class="w3-container opc w3-padding" style="display: none">
			<div class="w3-container w3-row" >
				<div class="w3-third">
					<p></p>
				</div>
				<div class="w3-third w3-hide-small w3-display-container w3-padding">
					<p></p>
					<div class="w3-card-4" style="width: 95%">
						<header class="w3-container w3-blue">
							<h2>Enviando datos ...</h2>
						</header>
						<div class="w3-container w3-center">
							<p>Un momento por favor, enviando datos y redireccionando al portal del Ayuntamiento de Huétor Vega</p>
						</div>
						<div class="w3-container w3-center">
							<p><i class="fa fa-spinner fa-spin" style="font-size:36px"></i></p>
							<br/>
						</div>
					</div>
					<p></p>
				</div>
				<div class="w3-third">
					<p></p>
				</div>
			</div>
		</div>

		<!-- Pié de página -->
		<div id="piepag" class="w3-container w3-padding">
			<div id="logos" class="w3-row w3-center w3-padding">
				<div id="logoUe" class="w3-container w3-col" style="width: 20%">
					<img src=".\img\ueFse.jpg" alt="Fondo Social Europeo" style="width: 60%"/>
				</div>
				<div id="logoMin" class="w3-container w3-col" style="width: 40%">
					<img src=".\img\minis.jpg" alt="Ministerio" style="width: 100%"/>
				</div>
				<div id="logoFemp" class="w3-container w3-col" style="width: 20%">
					<img src=".\img\femp.jpg" alt="FEMP" style="width: 45%"/>
				</div>
				<div id="logoAyto" class="w3-container w3-col" style="width: 20%">
					<img src=".\img\ayt.png" alt="Escudo Huétor Vega" style="width: 20%"/>
					<div class="w3-container">
						<p class="w3-tiny">Ayuntamiento de<br/>Huétor Vega</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Código Javascript para cambio de pestañas-->
	<script type="text/javascript">
	// Version nueva 17/07/2017

	function redireccionarPortal() {
		window.location = "http://huetorvega.es";
	}

	function abrirOpcion(evt, opcion) {
		if(opcion == "inicio") {
			document.getElementById('inicio').style.display = "none";
			document.getElementById('valoraciones').style.display = "block";
			document.getElementById('apaInicio').className = document.getElementById('apaInicio').className.replace('w3-blue', 'w3-green');
			document.getElementById('apaValoraciones').className = document.getElementById('apaValoraciones').className.replace('w3-red', 'w3-blue');
		} else if(opcion == "valoraciones") {
			document.getElementById('valoraciones').style.display = "none";
			document.getElementById('tareas').style.display = "block";
			document.getElementById('apaValoraciones').className = document.getElementById('apaValoraciones').className.replace('w3-blue', 'w3-green');
			document.getElementById('apaTareas').className = document.getElementById('apaTareas').className.replace('w3-red', 'w3-blue');
		} else if(opcion == "tareas") {
			document.getElementById('tareas').style.display = "none";
			document.getElementById('sitLaboral').style.display = "block";
			document.getElementById('apaTareas').className = document.getElementById('apaTareas').className.replace('w3-blue', 'w3-green');
			document.getElementById('apaSitLaboral').className = document.getElementById('apaSitLaboral').className.replace('w3-red', 'w3-blue');
		} else if(opcion == "sitLaboral") {
			document.getElementById('sitLaboral').style.display = "none";
			document.getElementById('fin').style.display = "block";
			document.getElementById('apaSitLaboral').className = document.getElementById('apaSitLaboral').className.replace('w3-blue', 'w3-green');
			document.getElementById('apaFin').className = document.getElementById('apaFin').className.replace('w3-red', 'w3-blue');
		} else if(opcion == "fin") {
			document.getElementById('fin').style.display = "none";
			document.getElementById('gracias').style.display = "block";
			document.getElementById('apaFin').className = document.getElementById('apaFin').className.replace('w3-blue', 'w3-green');
		} else if(opcion == "envio") {
			// Mostrar apartado de enviando datos y redireccionamiento a página principal del ayuntamiento
			document.getElementById('gracias').style.display = "none";
			document.getElementById('enviando').style.display = "block";
			document.formEncConcilia.submit();
			// setTimeout("redireccionarPortal()" , 2000);
		}
		// Mostrar el documento desde el principio o desde arriba
		$('html, body').animate({scrollTop: $('#principal').offset().top},200);
	}
	</script>
</body>
</html>