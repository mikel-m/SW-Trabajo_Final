$(document).ready(function() {
    $("#borrarImagen").on("click", function () {
        $("#subirImagen").replaceWith(selected_photo = $("#subirImagen").clone(true));
        $("#preview").removeProp("src").hide();
        $("#subirImagen").val("");
        $("preview").remove()
    });
});