function mostarAlerta() {

    alert("Se editó correctamente la petición");
}

function alerta() {

    alert("Se envió correctamente la Solicitud");
}

function rescate(){
    
    alert("Se realizó correctamente el rescate");
}

function archivo(){
    
   alert("Se subió el archivo correctamente");
   
}

function confirmarEliminacion(idPeticion) {
    var x = confirm("Desea eliminar el registro?");

    if (x) {
        window.location.href = "../funciones_solicitante/eliminar_peticion.php?id=" + idPeticion;
    }
    //else{
      //  window.location.href = "http://pcspucv.cl/gsi/index.php/editar-eliminar-solicitudes/";
   // }
}

function Aceptar(idEstado) {
    var x = confirm("Desea Aceptar Esta Solicitud?");

    if (x) {
        window.location.href = "../usuario_autorizador/update_estado_aceptar.php?id=" + idEstado;
    }else{
        window.location.href = "../usuario_autorizador/historial_solicitudes.php?idEstado=0"; 
    }
}

function Rechazar(idEstado) {
    var x = confirm("Desea Rechazar Esta Solicitud?");

    if (x) {
        window.location.href = "../usuario_autorizador/update_estado_rechazar.php?id=" + idEstado;
    }
}





