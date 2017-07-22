-- Descripción: Creación de tablas de APP Encuestas
-- Versión - Fecha: 1.0 - 22/07/2017
-- Autor: José Miguel Arquelladas
-- Email: jmaruiz@gmail.com
-- Twitter: @jmarquelladas

--
-- Base de datos: Encuestas
--

-- --------------------------------------------------------

--
-- Estructura de la tabla: provin
--
CREATE TABLE IF NOT EXISTS provin (
	codproine VARCHAR(2) NOT NULL COMMENT 'Codigo INE de la Provincia',
	nomprovin VARCHAR(50) NOT NULL COMMENT 'Nombre de la Provincia',

	CONSTRAINT pro_cod_PK PRIMARY KEY (codproine)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para tabla provin
--

INSERT INTO `provin` (`codproine`, `nomprovin`) VALUES
('2','Albacete'),
('3','Alicante/Alacant'),
('4','Almería'),
('1','Araba/Álava'),
('33','Asturias'),
('5','Ávila'),
('6','Badajoz'),
('7','Balears Illes'),
('8','Barcelona'),
('48','Bizkaia'),
('9','Burgos'),
('10','Cáceres'),
('11','Cádiz'),
('39','Cantabria'),
('12','Castellón/Castelló'),
('13','Ciudad Real'),
('14','Córdoba'),
('15','Coruña A'),
('16','Cuenca'),
('20','Gipuzkoa'),
('17','Girona'),
('18','Granada'),
('19','Guadalajara'),
('21','Huelva'),
('22','Huesca'),
('23','Jaén'),
('24','León'),
('25','Lleida'),
('27','Lugo'),
('28','Madrid'),
('29','Málaga'),
('30','Murcia'),
('31','Navarra'),
('32','Ourense'),
('34','Palencia'),
('35','Palmas Las'),
('36','Pontevedra'),
('26','Rioja La'),
('37','Salamanca'),
('38','Santa Cruz de Tenerife'),
('40','Segovia'),
('41','Sevilla'),
('42','Soria'),
('43','Tarragona'),
('44','Teruel'),
('45','Toledo'),
('46','Valencia/València'),
('47','Valladolid'),
('49','Zamora'),
('50','Zaragoza'),
('51','Ceuta'),
('52','Melilla');


-- -----------------------------------------------------------------------------

--
-- Estructura de la tabla: munic
--
CREATE TABLE IF NOT EXISTS munic (
	codmunine VARCHAR(5) NOT NULL COMMENT 'Codigo INE del Municipio',
	codmunotro VARCHAR(5) COMMENT 'Codigo auxiliar del Municipio',
	codprov VARCHAR(2) NOT NULL COMMENT 'Código de la Provincia del Municipio',
	nommunicipio VARCHAR(60) NOT NULL COMMENT 'Nombre del Municipio',

	CONSTRAINT mun_cod_PK PRIMARY KEY (codmunine),
	CONSTRAINT mun_pro_FK FOREIGN KEY (provin) REFERENCES provin(codproine) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para tabla munic
--
-- NO SE VUELCAN DATOS
-- -----------------------------------------------------------------------------

--
-- Estructura de tabla: conciliacion
--

CREATE TABLE IF NOT EXISTS conciliacion (
	codentrada INT(6) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria para tabla CONCILIACION',
	fechaencuesta DATETIME DEFAULT CURRENT_TIMESTAMP,
	dirip VARCHAR(15) COMMENT 'Dirección IP desde donde se realiza la encuesta',
	tie_rea DATETIME COMMENT 'Tiempo en realizar la encuesta',
	s101 VARCHAR(50) COMMENT 'Provincia de residencia del encuestado',
	s102 VARCHAR(50) COMMENT 'Municipio de residencia del encuestado',
	p1 VARCHAR(2) COMMENT 'Satisfaccion vida en general',
	p21 VARCHAR(2) COMMENT 'Satisfaccion situación laboral',
	p22 VARCHAR(2) COMMENT 'Satisfaccion vida familiar o relaciones familiares',
	p23 VARCHAR(2) COMMENT 'Satisfaccion situación económica',
	p24 VARCHAR(2) COMMENT 'Satisfaccion trabajo que realiza/realizaba',
	p25 VARCHAR(2) COMMENT 'Satisfaccion amigos/as',
	p26 VARCHAR(2) COMMENT 'Satisfaccion relación pareja',
	p27 VARCHAR(2) COMMENT 'Satisfaccion tiempo libre del que dispone',
	p3 VARCHAR(2) COMMENT 'En caso de que uno de los dos miembros de la pareja tenga que trabajar menos de forma remunerada, para ocuparse de las tareas del hogar y el cuidado de los hijos/as o familiares dependientes, ¿quién cree que debería ser?',
	p4 VARCHAR(2) COMMENT 'Piense ahora en una pareja con un/a hijo/a menor de 3 años en la que ambos tienen las mismas oportunidades y/o condiciones laborales. ¿Cuál de las siguientes es, en su opinión, la mejor forma de organizar su vida familiar y laboral?',
	p5 VARCHAR(2) COMMENT 'Si tanto el padre como la madre trabajan, ¿cuál de las siguientes opciones cree que es mejor para el/la niño/a (menor de 3 años)',
	p6 VARCHAR(2) COMMENT 'Piense ahora en las personas que, debido a tener una edad avanzada, una discapacidad o una enfermedad crónica, no pueden realizar sin ayuda actividades básicas de la vida cotidiana tales como ir al baño, ducharse o vestirse. ¿Cuál de las siguientes opciones considera Ud. mejor para organizar el cuidado de estas personas dependientes?',
	p7 VARCHAR(2) COMMENT '¿Cuántas horas a la semana le dedica Ud., personalmente, a las tareas domésticas, sin incluir el cuidado de los/as hijos/as ni actividades de ocio?',
	p8 VARCHAR(2) COMMENT '¿Cuántas horas a la semana dedica Ud. Al cuidado de algún miembro de la familia (p. ej. niños, ancianos o personas con discapacidad?',
	p9 VARCHAR(2) COMMENT '¿En cuál de las siguientes situaciones se encuentra Ud. en la actualidad?',
	p9a VARCHAR(2) COMMENT '¿cuántas horas a la semana dedica su cónyuge/pareja a las tareas domésticas, sin incluir el cuidado de los/as hijos/as ni actividades de ocio?',
	p9b VARCHAR(2) COMMENT '¿cuántas horas a la semana dedica su cónyuge/pareja al cuidado de algún miembro de la familia (p. ej. niños, ancianos o personas con discapacidad)?',
	p9c VARCHAR(2) COMMENT '¿Cuál de las frases siguientes describe mejor la forma en que se reparten las tareas domésticas Ud. y su cónyuge/pareja?',
	p10 VARCHAR(2) COMMENT '¿Cuál es su situación laboral?',
	p108 VARCHAR(2) COMMENT 'Otra... ¿Cuál?',
	t10a1 VARCHAR(2) COMMENT 'Ha vuelto del trabajo demasiado cansada/o para hacer las tareas de la casa.',
	t10a2 VARCHAR(2) COMMENT 'Le ha resultado difícil cumplir con sus responsabilidades familiares, debido al tiempo que había dedica do a su trabajo (remunerado).',
	t10a3 VARCHAR(2) COMMENT 'Ha llegado al trabajo demasiado cansada/o por haber tenido que hacer las tareas de la casa.',
	t10a4 VARCHAR(2) COMMENT 'Ha tenido dificultades para concentrarse en su trabajo, debido a sus responsabilidades familiares.',
	t10a5 VARCHAR(2) COMMENT 'Le ha resultado difícil poder realizar sus aficiones, (deporte, cine, lectura, quedar con amigos/as…) debido al tiempo que había dedicado a su trabajo o responsabilidades familiares',
	t10b VARCHAR(2) COMMENT '¿Qué tipo de jornada laboral tiene?',
	t10b5 VARCHAR(2) COMMENT 'Otra... ¿Cuál?',
	t10c VARCHAR(2) COMMENT '¿Qué tipo de trabajo tiene?',
	t10d1 VARCHAR(2) COMMENT 'Ayudas para la vivienda',
	t10d2 VARCHAR(2) COMMENT 'Planes de pensiones o complementos de pensiones',
	t10d3 VARCHAR(2) COMMENT 'Ayudas para la formación (disposición de días, flexibilidad horaria, ayudas económicas…)',
	t10d4 VARCHAR(2) COMMENT 'Comedor para empleados/as o ayudas para manutención',
	t10d5 VARCHAR(2) COMMENT 'Ayudas de transporte',
	t10d6 VARCHAR(2) COMMENT 'Ayudas para gastos en área de salud',
	t10d7 VARCHAR(2) COMMENT 'Ayudas para enseñanza de hijos/as o familiares',
	t10d8 VARCHAR(2) COMMENT 'Guarderías o ayudas para guarderías',
	t10d9 VARCHAR(2) COMMENT 'Ofertas de ocio',
	t10d10 VARCHAR(2) COMMENT 'Flexibilidad horaria',
	t10d11 VARCHAR(2) COMMENT 'Algún otro tipo de servicio social. ¿Cuál?',
	t10d1otro VARCHAR(2) COMMENT 'Otro... ¿Cuál?',
	j10a VARCHAR(2) COMMENT '¿Podría decirme en qué medida se siente Ud. necesario para que su familia más próxima pueda conciliar la vida laboral, familiar y personal? Para responder utilice una escala de 0 a 10 donde el 0 significa que está “completamente innecesario/a” y el 10 que está “completamente necesario/a”',
	d10a VARCHAR(2) COMMENT 'Pensando en las cuatro últimas semanas, ¿ha tratado de encontrar algún empleo?',
	d10a1 VARCHAR(2) COMMENT '¿Cuál es el PRINCIPAL MOTIVO por el que no ha tratado de buscar empleo en las últimas semanas?',
	d10a2 VARCHAR(2) COMMENT 'Más concretamente, dígame si el motivo de no buscar empleo es alguno de los siguientes:',
	s1 VARCHAR(2) COMMENT '¿Cuál es su sexo?',
	s2 VARCHAR(2) COMMENT '¿Podría indicarme cuál es su edad?',
	s3 VARCHAR(2) COMMENT '¿Cúal es su estado civil? ',
	s4 VARCHAR(2) COMMENT '¿Podría indicarme  el nº de personas que residen en su hogar contando con Ud.?',
	s5 VARCHAR(2) COMMENT '¿Cuántos/as hijos/as tiene a su cargo?',
	s6 VARCHAR(2) COMMENT '¿Cuántas personas dependientes tiene usted a su cargo? (no puede valerse por sí misma y necesita asistencia de alguien o de algo)',
	s7 VARCHAR(2) COMMENT '¿Podría indicarme qué nivel de estudios terminados tiene Ud.? ',
	s8 VARCHAR(2) COMMENT '¿Le importaría decirme cuál es su nacionalidad?',
	s82 VARCHAR(2) COMMENT 'Otra... ¿Cuál?',
	s9 VARCHAR(2) COMMENT 'Podría decirme, por último, ¿Cuáles son los ingresos netos que entran en su hogar al mes por todos los conceptos? (Es decir, incluyendo lo que aportan todos los miembros del hogar)',

	CONSTRAINT con_cod_PK PRIMARY KEY (codentrada)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Volcado de datos para tabla CONCILIACION
--
-- NO SE VUELCAN DATOS
-- -----------------------------------------------------------------------------