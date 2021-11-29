
function validacion() {
    
    var correo = document.fquestion.correo.value;
    var enun = document.fquestion.enun.value;
    var correct = document.fquestion.correct.value;
    var inc1 = document.fquestion.inc1.value;
    var inc2 = document.fquestion.inc2.value;
    var inc3 = document.fquestion.inc3.value;
    var dif = document.fquestion.dif.value
    var tema = document.fquestion.tema.value;

    if( correo == '' || correo == null) {
        alert( 'Debes introducir un correo electronico.');
    return false;
    } else{
        if(!validacionEmail(correo)){
            alert('Debes introducir una dirección de correo válida.')
            return false;
        }
    }
    if( enun == '' || enun == null ) {
        alert( 'Debes introducir una pregunta.' );
        return false;
    }
    if( correct == '' || correct == null) {
        alert( 'Debes introducir una respuesta correcta.' );
        return false;
    }
    if( inc1 == '' || inc1 == null) {
        alert( 'Debes introducir una respuesta incorrecta 1.' );
        return false;
    }
    if( inc2 == '' || inc2 == null) {
        alert( 'Debes introducir una respuesta incorrecta 2.' );
        return false;
    }
    if( inc3 == ''  || inc3 == null) {
        alert( 'Debes introducir una respuesta incorrecta 3.' );
        return false;
    }
    if( dif == ''  || dif == null) {
        alert( 'Debes elegir una complejidad.' );
        return false;
    }
    if( tema == ''  || tema == null) {
        alert( 'Debes especificar un tema.' );
        return false;
    }
    return( true );
}

function validacionEmail(correo){
    //Forma mas sencilla de validacion de email -> expresiones regulares.
    const er = /^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/;
    const er2 = /^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/;
    const er3 = /^[a-zA-Z]+@ehu\.(eus|es)$/;
    return er.test(String(correo).toLowerCase()) && er2.test(String(correo).toLowerCase()) && er3.test(String(correo).toLowerCase());

}
