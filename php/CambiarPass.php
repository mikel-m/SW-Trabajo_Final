<?php
    session_start();
    if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!='prof' && $_SESSION['tipo']!='alu')){
        echo '<script>
                alert("No tienes acceso a esta página");
                window.location.href="Layout.php";
              </script>';
    }
?>
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
        <form id="fpass" name="fpass" action="CambiarPass.php" enctype="multipart/form-data" method = "POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Cambiar contraseña</h2> 
            </caption>
            <tr>
              <td align="right">Contraseña actual: </td>
              <td align="left"><input style="width: 600px;" type="password" id="passAct" name="passAct" autofocus></td>
            </tr>
            <tr>
              <td align="right">Nueva contraseña: </td>
              <td align="left"><input style="width: 600px;" type="password" id="newPass1" name="newPass1" autofocus></td>
            </tr>
            <tr>
              <td align="right">Repite la nueva contraseña: </td>
              <td align="left"><input style="width: 600px;" type="password" id="newPass2" name="newPass2" autofocus></td>
            </tr>
            <td></td>
              <td align="left"><input type="submit" id="changePass" name="changePass" value="Cambiar contraseña"></button></td>
            </tr>
          </table>
        </form>
        <?php
        //Validación del registro en el servidor
        if (isset($_POST['changePass'])){ 
            $correo = $_SESSION['correo']; 
            $pass = $_POST['passAct'];
            $newpass1 = $_POST['newPass1'];
            $newpass2 = $_POST['newPass2'];
            
            if($pass == ""){
                echo "<h3>Debes introducir todos los campos.</h3>";
                echo "<br>";
            }
            else if($newpass1 == ""){
                echo "<h3>Debes introducir todos los campos.</h3>";
                echo "<br>";
            }
            else if($newpass2 == ""){
                echo "<h3>Debes introducir todos los campos.</h3>";
                echo "<br>";
            }
            else if(strlen($newpass1) < 8){
                echo "<h3>La contraseñad debe tener más de 8 caracteres.</h3>";
                echo "<br>";
            }
            else if($newpass1 != $newpass2){
                echo "<h3>Las contraseñas deben ser iguales.</h3>";
                echo "<br>";
            }
            else{
                // PDO
                // Abrir una conexión a MySql
                include 'DbConfig.php';
                try{
                  $dsn = "mysql:host=$server;dbname=$basededatos";
                  $dbh = new PDO($dsn, $user, $pass);
                } catch (PDOException $e){
                  echo $e->getMessage();
                }
                // prepare
                $stmt = $dbh->prepare("SELECT * FROM users WHERE correo=?");
                // bind
                $stmt->bindParam(1, $correo);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_OBJ); 
                // Execute
                $stmt->execute();
                $row = $stmt->fetch();
                if (password_verify($pass, $row->pass) == 1){
                    $correcto = "true";
                } else {
                    echo "<h3>La contraseña es incorrecta.</h3>";
                    echo "<br>";
                    echo password_verify($pass, $row->pass);
                }
                // cerrar conexión
                $dbh = null;
                if ($correcto == "true") {
                    try{
                        $dsn = "mysql:host=$server;dbname=$basededatos";
                        $dbh = new PDO($dsn, $user, $pass);
                    } catch (PDOException $e){
                        echo $e->getMessage();
                    }
                    // prepare
                    $stmt = $dbh->prepare("UPDATE users SET pass=? WHERE correo=?");
                    // bind
                    $hash = password_hash($newpass1, PASSWORD_DEFAULT);
                    $stmt->bindParam(1, $hash);
                    $stmt->bindParam(2, $correo);
                    // Excecute
                    $stmt->execute();
                    // cerrar conexión
                    $dbh = null;
                    echo '<script type="text/javascript"> alert("La contraseña se ha cambiado correctamente.");
                         window.location.href="Layout.php";
                      </script>';
                }
            }
        }
        ?>
        <script>
          /*var x = document.getElementById("fregister");
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
          $correo = $_POST['correo'];
          //instanciamos el objeto SoapClient con el WSDL del servicio
          $soapclient = new SoapClient('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl');

          //Llamamos a la funcion que habiamos implementado en el Web Service
          //y devolvemos el resultado
          if (isset($_POST['botonReg'])){
            echo '<h3> El correo ' . $correo . $soapclient->comprobar($correo) . ' existe </h3>';
          }
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