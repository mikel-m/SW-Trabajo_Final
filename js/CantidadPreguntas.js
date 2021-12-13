function numQuestions(){
    var preguntasTotales='<caption style="text-align:left"><td align="left"><h2>Número de preguntas TOTALES: ';
    var preguntasUsuario='<caption style="text-align:left"><td align="left"><h2>Preguntas de ';
    var correo = $('#correo').val();
    preguntasUsuario+=correo+': '
    var cantTotales = 0;
    var CantUsuario = 0;
    
	
    $.ajax({
        url:"../json/Questions.json",
        dataType: "json",
        type: "get",
        cache : false,
        success: function(data){
            $(data.assessmentItems).each(function(index,value){
                cantTotales+=1;

            });
            preguntasTotales+=cantTotales+'</h2><br></caption>';
    
            document.getElementById('mostrar-Cantidad').innerHTML=preguntasTotales;
        }
    });
}