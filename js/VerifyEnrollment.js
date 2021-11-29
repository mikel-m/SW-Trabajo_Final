function Verify() {
    var correo = document.getElementById("correo").value;
    XMLHttp= new XMLHttpRequest();
    XMLHttp.onreadystatechange = function() {
        if (XMLHttp.readyState==4 && XMLHttp.status==200){
            document.getElementById("verificacion").innerHTML=XMLHttp.responseText;
        }
    }
XMLHttp.open("GET","ClientVerifyEnrollment.php?correo="+correo, true);
XMLHttp.send();
}