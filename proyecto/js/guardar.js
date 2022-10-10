
var getData = function(){

    var nombre = document.getElementById("nombreSolicitud").value;
    var monto = document.getElementById("monto").value;
    var tipo = document.getElementById("tipo").value;
    var descripcion = document.getElementById("descripcion").value;

    if(nombre == "")
    {
        alert("Debe llenar el campo Monto Solicitud");
        document.getElementById("nombreSolicitud").focus();
    }
    else if(monto == ""){
            alert("Debe llenar el campo Monto");
            document.getElementById("monto").focus();
    } 
    else if(tipo == "")
         {
             alert("Debe llenar el campo Tipo");
             document.getElementById("tipo").focus();
         }
         else if(descripcion == "")
            {
                alert("Debe llenar el campo Descripcion");
                document.getElementById("descripcion").focus();
            }
            else{
                console.log(nombre+" "+monto+" "+tipo+" "+descripcion+"");
                document.getElementById("nombreSolicitud").value="";
                document.getElementById("monto").value="";
                document.getElementById("tipo").value="";
                document.getElementById("descripcion").value="";
                document.getElementById("nombreSolicitud").focus();
            }
}