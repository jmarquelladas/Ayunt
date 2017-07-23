<?php

/* 
 * Descripción: Clase que define las operaciones con BBDD
 * Versión: 1.0 
 * Fecha: 23/jul/2017
 * Autor: José Miguel Arquelladas
 * Email: jmaruiz@gmail.com
 * Twitter: @jmarquelladas
 */


class BD {
    
    const USUARIO = 'root';
    const PASSW = 'gr8814am';
    
    /**
     * Inserta u nuevo registro en la tanbla conciliacion de la BD encuestas
     * @param  type Array $encuestas Array con los datos del formulario de la encuesta
     * @return boolean Si es verdadero se ha realizado la transacción correctamente
     */
    public static function setInsRegConciliacion($encuesta) {

        $direc_ip = $encuesta['direc_ip'];
        $tiempo_realiz = $encuesta['tiempo_realiz'];
        $s101 = $encuesta['s101'];
        $s102 = $encuesta['s102'];
        $p1 = $encuesta['p1'];
        $p21 = $encuesta['p21'];
        $p22 = $encuesta['p22'];
        $p23 = $encuesta['p23'];
        $p24 = $encuesta['p24'];
        $p25 = $encuesta['p25'];
        $p26 = $encuesta['p26'];
        $p27 = $encuesta['p27'];
        $p3 = $encuesta['p3'];
        $p4 = $encuesta['p4'];
        $p5 = $encuesta['p5'];
        $p6 = $encuesta['p6'];
        $p7 = $encuesta['p7'];
        $p8 = $encuesta['p8'];
        $p9 = $encuesta['p9'];
        $p9a = $encuesta['p9a'];
        $p9b = $encuesta['p9b'];
        $p9c = $encuesta['p9c'];
        $p10 = $encuesta['p10'];
        $p108 = $encuesta['p108'];
        $t10a1 = $encuesta['t10a1'];
        $t10a2 = $encuesta['t10a2'];
        $t10a3 = $encuesta['t10a3'];
        $t10a4 = $encuesta['t10a4'];
        $t10a5 = $encuesta['t10a5'];
        $t10b = $encuesta['t10b'];
        $t10b5 = $encuesta['t10b5'];
        $t10c = $encuesta['t10c'];
        $t10d1 = $encuesta['t10d1'];
        $t10d2 = $encuesta['t10d2'];
        $t10d3 = $encuesta['t10d3'];
        $t10d4 = $encuesta['t10d4'];
        $t10d5 = $encuesta['t10d5'];
        $t10d6 = $encuesta['t10d6'];
        $t10d7 = $encuesta['t10d7'];
        $t10d8 = $encuesta['t10d8'];
        $t10d9 = $encuesta['t10d9'];
        $t10d10 = $encuesta['t10d10'];
        $t10d11 = $encuesta['t10d11'];
        $t10d11otro = $encuesta['t10d11otro'];
        $j10a = $encuesta['j10a'];
        $d10a = $encuesta['d10a'];
        $d10a1 = $encuesta['d10a1'];
        $d10a112cual = $encuesta['d10a112cual'];
        $d10a2 = $encuesta['d10a2'];
        $s1 = $encuesta['s1'];
        $s2 = $encuesta['s2'];
        $s3 = $encuesta['s3'];
        $s4 = $encuesta['s4'];
        $s5 = $encuesta['s5'];
        $s6 = $encuesta['s6'];
        $s7 = $encuesta['s7'];
        $s8 = $encuesta['s8'];
        $s82 = $encuesta['s82'];
        $s9 = $encuesta['s9'];

        $sql = "INSERT INTO conciliacion (direc_ip, tiempo_realiz, s101, s102, p1, p21, p22, p23, p24, p25, p26, p27, p3, p4, p5, p6, p7, p8, p9, p9a, p9b, p9c, p10, p108, t10a1, t10a2, t10a3, t10a4, t10a5, t10b, t10b5, t10c, t10d1, t10d2, t10d3, t10d4, t10d5, t10d6, t10d7, t10d8, t10d9, t10d10, t10d11, t10d11otro, j10a, d10a, d10a1, d10a112cual, d10a2, s1, s2, s3, s4, s5, s6, s7, s8, s82, s9)";

        $sql .= "VALUES ('$direc_ip', '$tiempo_realiz', '$s101','$s102','$p1','$p21', '$p22', '$p23', '$p24', '$p25', '$p26', '$p27', '$p3', '$p4', '$p5', $p6, '$p7', '$p8', '$p9', '$p9a', '$p9b', '$p9c', '$p10', '$p108', '$t10a1', '$t10a2', '$t10a3', '$t10a4', '$t10a5', '$t10b', '$t10b5', '$t10c', '$t10d1', '$t10d2', '$t10d3', '$t10d4', '$t10d5', '$t10d6', '$t10d7', '$t10d8', '$t10d9', '$t10d10', '$t10d11', '$t10d11otro', '$j10a', '$d10a', '$d10a1', '$d10a112cual', '$d10a2', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '$s7', '$s8', '$s82', '$s9');";

        // Configuramos las opciones de conexión a la BBDD
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" );
        $dsn = "mysql:host=localhost;dbname=encuestas";
        $usuario = self::USUARIO;
        $contrasena = self::PASSW;
        
        try {
            // Creamos el objeto de la BBDD
            $conexion = new PDO($dsn, $usuario, $contrasena, $opc);
            // Iniciamos las transacción
            $conexion->beginTransaction();
            // Ejecutamos la sentencia sql y la guardamos en una variable para
            // comprobar el resultado
            if($conexion->exec($sql) !==0 ) { // Se ha ejecutado correctamente la transacción
                $conexion->commit(); // Se cierra la transacción correctamente
                $resultado = TRUE;
            } else { // Se ha producido algún error
                $conexion->rollBack(); // Se cierra la transacción sin realizar la operación
                $resultado = FALSE;
            }
        } catch (PDOException $ex) {
            die("Error: ".$ex->getMessage());
            $resultado = FALSE;
        }
        return $resultado;
    }
}