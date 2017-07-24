/* 
 * Descripción: Archivo de funciones JavaScript para utilizar en llamadas
 * Versión - Fecha: 1.0 
 * Autor: José Miguel Arquelladas
 * Email: jmaruiz@gmail.com
 * Twitter: @jmarquelladas
 */


/**
 * Envia los datos para que sean validados y comprobados
 */
function enviarFormulario() {
    
    // Guardamos el valor de name en variable para elegir que opción hay que realizar
    opcion = xajax.$('enviar').name;
    // Se cambia el botón de Enviar y se deshabilita
    //  hasta que llegue la respuesta
    xajax.$('enviar').disabled=true;
    xajax.$('enviar').value="Un momento...";
    if(xajax.$('nombre').disabled == true) xajax.$('nombre').disabled = false;
    // Llamamos a la función registrada de PHP
    xajax_validarFormulario(xajax.getFormValues("datos"),opcion);
        
    return false;
}


function altaUsuario() {
    xajax.$('form_opciones').style.display = 'none';
    xajax.$('lg_form_usuario').innerHTML = "Alta de usuario";
    xajax.$('form_usuario').style.display = 'block';
    xajax.$('enviar').name = 'alt_usu';
}


function modificarUsuario(login, email) {
    xajax.$('form_opciones').style.display = 'none';
    xajax.$('lg_form_usuario').innerHTML = "Modificar datos de usuario";
    xajax.$('form_usuario').style.display = 'block';
    
    // Presentamos los datos del usuario en el formulario
    xajax.$('nombre').disabled = true;
    xajax.$('nombre').value = login;
    xajax.$('email').value = email;
    xajax.$('enviar').name = 'mod_usu';
    xajax.$('enviar').value = 'Modificar';
}


function mostrarDialogoBorrar(login) {
    xajax.$('form_opciones').style.display = 'none';
    xajax.$('dialogo_borrar').style.display = 'block';
    xajax.$('borrar').name = login;
}


function borrarUsuario() {
        
    // Se cambia el botón de Enviar y se deshabilita hasta que llegue la respuesta
    xajax.$('borrar').disabled=true;
    xajax.$('borrar').value="Borrando, un momento...";
    xajax_borrarForero(xajax.$('borrar').name);
    xajax.$('borrar').disabled=false;
    xajax.$('borrar').value="Borrar usuario";
    
    xajax.$('dialogo_borrar').style.display = 'none';
    xajax.$('form_opciones').style.display = 'block';
    
    return false;
}


function cancelarBorrarUsuario() {
    // Deshabilitamos dialogo de confirmación de borrado
    // y mostramos las opciones de usuario
    xajax.$('dialogo_borrar').style.display = 'none';
    xajax.$('form_opciones').style.display = 'block';
}