$(document).ready(function() {
    $('#botonPreg').click(function() {
        const er = /^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/;
        const er2 = /^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/;
        const er3 = /^[a-zA-Z]+@ehu\.(eus|es)$/;

        var correo = $('#correo').val();
        var enun = $('#enun').val();
        var correct = $('#correct').val();
        var inc1 = $('#inc1').val();
        var inc2 = $('#inc2').val();
        var inc3 = $('#inc3').val();
        var dif = $('#dif').val();
        var tema = $('#tema').val();

        if(correo == '' || correo == null) {
            alert('Debes introducir una dirección de correo')
            return false;
        }
        else if(!er.test(correo) && !er2.test(correo) && !er3.test(correo)) {
            alert('Debes introducir una dirección de correo válida')
            return false;
        }
        if(enun == '' || enun == null) {
            alert( 'Debes introducir una pregunta.' );
            return false;
        }
        else if(enun.length < 10){
            alert('La pregunta debe tener 10 caracteres como mínimo')
            return false;
        }
        if(correct == '' || correct == null) {
            alert( 'Debes introducir una respuesta correcta.' );
            return false;
        }
        if(inc1 == '' || inc1 == null) {
            alert( 'Debes introducir una respuesta incorrecta 1.' );
            return false;
        }
        if(inc2 == '' || inc2 == null) {
            alert( 'Debes introducir una respuesta incorrecta 2.' );
            return false;
        }
        if(inc3 == '' || inc3 == null) {
            alert( 'Debes introducir una respuesta incorrecta 3.' );
            return false;
        }
        if(dif == '' || dif == null) {
            alert( 'Debes elegir una complejidad.' );
            return false;
        }
        if(tema == '' || tema == null) {
            alert( 'Debes especificar un tema.' );
            return false;
        }
        alert('Pregunta introducida correctamente');
    });
});