$(document).ready(function() {
    $("#botonPreg").click(function(){

        var formData = new FormData(fquestion);

        formData.append("correo", document.getElementById("correo").value);
        formData.append("enun", document.getElementById("enun").value);
        formData.append("correct", document.getElementById("correct").value);
        formData.append("inc1", document.getElementById("inc1").value);
        formData.append("inc2", document.getElementById("inc2").value);
        formData.append("inc3", document.getElementById("inc3").value);
        formData.append("dif", document.getElementById("dif").value);
        formData.append("tema", document.getElementById("tema").value);
        formData.append("inc1", document.getElementById("inc1").value);
        formData.append("subirImagen", document.getElementById("subirImagen").files[0]);
        $.ajax({
            type: "POST",
            data: formData,
            cache: false,
            url: "../php/AddQuestionWithImage.php",
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                alert("Datos enviados correctamente");
                showQuestions();
            },
        });
        //var xmlhttp = new XMLHttpRequest();
        //xmlhttp.open('POST','../php/AddQuestionWithImage.php',true);
        //xmlhttp.send(formData);
    });
});