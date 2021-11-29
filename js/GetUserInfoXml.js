$(document).ready(function() {
    $("#botonCompl").click (function(){
        //Guardamos el correo
        var correo = $("#correo").val();
        var enc = false;
        $("#telefono").val("");
        $("#nombre").val("");
        $("#apellidos").val("");
        //Miramos el XML para ver si existe el correo
        $.get("../xml/Users.xml", function(xml){
            //Iteramos sobre cada usuario
            $(xml).find("usuario").each(function (){
                //Si existe ese correo, mostramos sus datos
                if (correo == $(this).find("email").text()){
                    $("#telefono").val($(this).find("telefono").text());
                    $("#nombre").val($(this).find("nombre").text());
                    $("#apellidos").val($(this).find("apellido1").text()+" "+$(this).find("apellido2").text());
                    enc = true;
                }
            })
            if(!enc){
                alert("Este correo no está registrado. Introduzca otro.");
            }else{
                return;
            }
        })
    })   
});