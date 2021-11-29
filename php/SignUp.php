<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php include '../php/ClientVerifyEnrollment.php' ?>
  <section class="main" id="s1">
    <div>
        <style>
          .imgPrev {
            display: block;
            width: auto;
            height: 100%;
          }
        </style>
        <form id="fregister" name="fregister" action="SignUp.php" enctype="multipart/form-data" method = "POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Registro de usuario</h2> 
            </caption>
            <tr>
              <td align="right">Tipo de usuario: </td>
              <td align="left">
                <select name="user" id="user" form="fregister">
                  <option value="alu">Alumno</option>
                  <option value="prof">Profesor</option>
                </select> 
              </td>
            </tr>
            <tr>
              <td align="right">Dirección de correo (*): </td>
              <td align="left"><input type="text" id="correo" name="correo" onfocusout="Verify()"></td>
            </tr>
            <tr>
              <td align="right">Nombre (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="nom" name="nom" autofocus></td>
            </tr>
            <tr>
              <td align="right">Apellido/s (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="apell" name="apell" autofocus></td>
            </tr>
            <tr>
              <td align="right">Contraseña (*): </td>
              <td align="left"><input style="width: 600px;" type="password" id="userpass" name="userpass" autofocus></td>
            </tr>
            <tr>
              <td align="right">Repetir contraseña (*): </td>
              <td align="left"><input style="width: 600px;" type="password" id="repass" name="repass" autofocus></td>
            </tr>
            <tr>
              <td align="right">Foto de perfil: </td>
              <td align="left"><input id="subirImagen" name="subirImagen" type="file" onchange="" accept="image/png, image/jpeg"></td>
            </tr>
            <tr>
              <td></td>
              <td align ="left"><img id="preview" name="preview"  class="imgPreview" src="" height="200"></td>
            </tr>
            <tr>
            <td></td>
              <td align ="left"><button type="button" id="borrarImagen" name="borrarImagen">Borrar Imagen</button></td>    
            </tr>
            <tr>
            <td></td>
              <td align="left"><input type="submit" id="botonReg" name="botonReg" value="Registrarse"></button></td>
            </tr>
          </table>
        </form>
        <?php
        //Validación del registro en el servidor
        if (isset($_POST['botonReg'])){
            $tipoUser = "";
            $correo = "";
            $nom = "";
            $apell = "";
            $pass = "";
            $repass = "";

            //Validación en servidor 
            $er = "/^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/";
            $er2 = "/^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/";
            $er3 = "/^[a-zA-Z]+@ehu\.(eus|es)$/";
                
            $tipoUser = $_POST['user'];
            $correo = $_POST['correo']; 
            $nom = $_POST['nom'];
            $apell = $_POST['apell'];
            $userpass = $_POST['userpass'];
            $repass = $_POST['repass'];
            $imagen_nombre = $_FILES['subirImagen']['name'];
            $imagen_loc_tmp = $_FILES['subirImagen']['tmp_name']; //El directorio temporal donde está la imagen al subirla mediante el formulario.
            $nombre_imagen_separado = explode(".", $imagen_nombre); //Separamos el nobmre de la imagen para obtener su extensión.
            $imagen_extension = strtolower(end($nombre_imagen_separado)); //Cogemos la extensión.
            $nuevo_nombre_imagen = md5(time() . $imagen_nombre) . '.' . $imagen_extension; //Se le da un nombre único a la imagen que se va a guardar en el servidor.
            $imagen_dir = "../images/".$nuevo_nombre_imagen; //La base de datos guardará los directorios de las imagenes en el servidor.
            
            if($tipoUser == ""){
                echo "<h3>Debes introducir una respuesta correcta.</h3>";
                echo "<br>";
            }
            else if($correo == ""){
                echo "<h3>Debes introducir una dirección de correo.</h3>";
                echo "<br>";
            }
            else if(!(preg_match($er, $correo) || preg_match($er2, $correo) || preg_match($er3, $correo))){
                echo "<h3>Debes introducir una dirección de correo válida.</h3>";
                echo "<br>";
            }
            else if($nom == ""){
                echo "<h3>Debes introducir un nombre.</h3>";
                echo "<br>";
            }    
            else if(strlen($nom) < 2){
                echo "<h3>El nombre debe tener al menos dos caracteres.</h3>";
                echo "<br>";
            }
            else if($apell == ""){
                echo "<h3>Debes introducir apellido/s.</h3>";
                echo "<br>";
            }    
            else if(strlen($apell) < 2){
                echo "<h3>El apellido debe tener al menos dos caracteres.</h3>";
                echo "<br>";
            }
            else if($userpass == ""){
                echo "<h3>Debes introducir una contraseña.</h3>";
                echo "<br>";
            }
            else if(strlen($userpass) < 8){
                echo "<h3>La contraseñad debe tener más de 8 caracteres.</h3>";
                echo "<br>";
            }
            else if($repass != $userpass){
                echo "<h3>Las contraseñas deben ser iguales.</h3>";
                echo "<br>";
            }
            else{
              if(comprobar() == "SI"){
                //Si no ha habido ningún error, se registra al usuario
                //Conectamos con la base de datos mysql
                include 'DbConfig.php';
                $conn = mysqli_connect($server, $user, $pass, $basededatos);
                $conn->set_charset("utf8");

                if(!$conn){
                  die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "INSERT INTO users (tipouser, correo, nom, apell, pass, estado, img) VALUES ('$tipoUser', '$correo', '$nom', '$apell', '$userpass', 'Activo', '$imagen_dir')";
                $anadir = mysqli_query($conn, $sql);
                if(!$anadir){
                  echo "<h3>Se ha producido un error al intentar registrar al usuario. :(</h3>";
                  echo "<br>";
                }
                else{
                  //Si se puede introducir el usuario, entonces guardamos la imagen en el directorio images.
                  move_uploaded_file($imagen_loc_tmp, $imagen_dir);     
                  mysqli_close($conn);  
                  echo '<script type="text/javascript"> alert("Se ha realizado el registro de forma correcta");
                          window.location.href="LogIn.php";
                          </script>';        
                }
              }
            }
        }
        ?>
        <script>
          /*alert("Entra");
          var x = document.getElementById("fregister");
          x.addEventListener("focusout", comprobarCorreo);
          function comprobarCorreo(){
            var soapclient = new SoapClient("http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl");
            var existe = soapclient->comprobar(document.getElementById("correo").value);
              if (existe == "SI"){
                alert("El correo SI existe");
              } else {
                alert("El correo NO existe");
              }
          }*/
        </script>

        <!-- Lab 7 -->
        <?php
        /*
          $correo = $_POST['correo'];
          //instanciamos el objeto SoapClient con el WSDL del servicio
          $soapclient = new SoapClient('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl');

          //Llamamos a la funcion que habiamos implementado en el Web Service
          //y devolvemos el resultado
          if (isset($_POST['botonReg'])){
            echo '<h3> El correo ' . $correo . $soapclient->comprobar($correo) . ' existe </h3>';
          }
          */
        ?>
        <script>
          function blurFunction(){
            document.getElementById("correo").style.backgound = "red";
          }
        </script>
        



    </div>

    <div align="left" id="verificacion">

    </div>
    </section>
    <script src="../js/VerifyEnrollment.js"></script>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
    <script type="text/javascript" src="../js/RemoveImageInForm.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html>  