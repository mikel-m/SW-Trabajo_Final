function showQuestions(){
    var tabla="<table background-color: #83FAD9; border=1 margin-left=auto margin-right=auto><thead><tr><th>Author</th><th>Enunciado</th><th>Respuesta Correcta</th></tr></thead>";
    
	
    $.ajax({
        url:"../json/Questions.json",
        dataType: "json",
        type: "get",
        cache : false,
        success: function(data){
            $(data.assessmentItems).each(function(index,value){
                console.log(value.author);
                console.log(value.itemBody.p);
                console.log(value.correctResponse.value);
                tabla+="<tr>";
                tabla+='<td>'+value.author+'</td>';
                tabla+='<td>'+value.itemBody.p+'</td>';
                tabla+='<td>'+value.correctResponse.value+'</td>';
                tabla+="</tr>";

            });
            tabla+="</table>";
    
            document.getElementById('mostrar-Preguntas').innerHTML=tabla;
        }
    });
}