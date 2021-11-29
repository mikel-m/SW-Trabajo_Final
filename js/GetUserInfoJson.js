$(document).ready(function() {
    $("#botonCompl").click (function(){

        //Guardamos el correo
        var correo = $("#correo").val();
        
        $("#telefono").val("");
        $("#nombre").val("");
        $("#apellidos").val("");
        //Miramos a ver si existe el correo
        $.getJSON("../json/Users.json", function(json){
            //Iteramos sobre cada usuario
            var enc = false;
            for (usuario in json.usuarios){
                if (json.usuarios[usuario].email == correo){
                    $("#telefono").val(json.usuarios[usuario].telefono);
                    $("#nombre").val(json.usuarios[usuario].nombre);
                    $("#apellidos").val(json.usuarios[usuario].apellido1 + " " + json.usuarios[usuario].apellido2);
                    enc = true;
                }
            }
            if(!enc){
                alert("Este correo no está registrado. Introduzca otro.");
            }else{
                return;
            }
        })
        
    })   
});
