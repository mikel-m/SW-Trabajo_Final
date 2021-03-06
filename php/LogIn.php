<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <style>
          .imgPrev {
            display: block;
            width: auto;
            height: 100%;
          }
        </style>
        <form id="flogin" name="flogin" action="LogIn.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Login de usuario</h2> 
            </caption>
            <tr>
              <td align="right">Dirección de correo (*): </td>
              <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
            </tr>
            <tr>
              <td align="right">Contraseña (*): </td>
              <td align="left"><input style="width: 600px;" type="password" id="userpass" name="userpass" autofocus></td>
            </tr>
            <tr>
            <td></td>                               <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
              <td align="left"><input type="submit" id="botonLogin" name="botonLogin" value="Acceder"></button></td>
            </tr>
          </table>
        </form>
        <?php
        //Validación del registro en el servidor
        if (isset($_POST['botonLogin'])){

            $correo = $_POST['correo']; 
            $userpass = $_POST['userpass'];
            
            if($correo == ""){
                echo "<h3>Debes introducir una dirección de correo.</h3>";
                echo "<br>";
                echo "<a href='LogIn.php'>";
            }
            else if($userpass == ""){
                echo "<h3>Debes introducir una contraseña.</h3>";
                echo "<br>";
                echo "<a href='LogIn.php'>";
            }
            else{
              /*
              //Si no ha habido ningún error, se INTENTA logear al usuario
              //Conectamos con la base de datos mysql
              include 'DbConfig.php';
              $conn = mysqli_connect($server, $user, $pass, $basededatos);
              $conn->set_charset("utf8");

              if(!$conn){
                die("Connection failed: " . mysqli_connect_error());
              }

              // comprobar password cifrado
              // https://programacionconphp.com/encriptar-contrasena-en-php/
              // cifrar contraseña + PDO
              // https://www.baulphp.com/cifrar-contrasenas-usando-php-pdo-completo/
              $sql = "SELECT * from users where correo = '$correo'";
              $logear = mysqli_query($conn, $sql) or die(mysqli_error($conn));
              $row = mysqli_fetch_array($logear, MYSQLI_ASSOC) ; //Lo convertimos a array

              
              if(password_verify($userpass, $row['pass']) == 1){
                //Logear al usuario
                if(($row['correo'] == $correo)){
                  if($row['estado']=='Activo'){
                    $_SESSION['correo']=$row['correo'];
                    $_SESSION['nombre']=$row['nom'];
                    $_SESSION['apellido']=$row['apell'];
                    $_SESSION['imagen']=$row['img'];
                    $_SESSION['estado']=$row['estado'];
                    if($correo == 'admin@ehu.es'){
                      $_SESSION['tipo']='admin';
                    }else{
                      $_SESSION['tipo']=$row['tipouser'];
                    }
                    echo '<script type="text/javascript"> alert("Bienvenido al Sistema: '. $_SESSION['correo'] .' ");
                          window.location.href="Layout.php";
                          </script>';
                  } else {
                    echo '<script>
                      alert("Este usuario está bloqueado");
                      window.location.href="Layout.php";
                    </script>';
                  }
                }
                else{
                  echo "<h3>Datos de login incorrectos. :(</h3>";
                  echo "<br>";
                }
              } else {
                echo "<h3>Datos de login incorrectos. :(</h3>";
                echo "<br>";
              }
                // LAB 7 DE SEGURIDAD BASADA EN SESIONES
                // https://obedalvarado.pw/blog/formulario-inicio-sesion-php-mysql/

                //Logear al usuario
                //printf ("%s (%s)\n", $row["correo"], $row["pass"]);
                echo("<script> alert('Bienvenido:'); </script> ");
                if(($row['correo'] == $correo) && ($row['pass'] == $userpass)){
                      echo("<script> alert('Bienvenido:".$row['nom']."'); </script> ");
                  //window.location.href="Layout.php?correo='.$correo.'";
                  session_start();
                  $_SESSION['correo']=$row['correo'];
                  $_SESSION['nombre']=$row['nom'];
                  $_SESSION['apellido']=$row['apell'];
                  //$_SESSION['imagen']=$row['imagen_dir'];
                  if($correo == 'admin@ehu.es'){
                    $_SESSION['tipo']='admin';
                  }else{
                    $_SESSION['tipo']=$row['tipoUser'];
                  }
                  header("Location:Layout.php");
                }
                else{
                  echo "<h3>Datos de login incorrectos. :(</h3>";
                  echo "<br>";
                }
              } 
              $conn->close();
              $conn->close();
              */

              // PDO
              include 'DbConfig.php';
              try{
                $dsn = "mysql:host=$server;dbname=$basededatos";
                $dbh = new PDO($dsn, $user, $pass);
              } catch (PDOException $e){
                echo $e->getMessage();
              }
              // FETCH_OBJ
              $stmt = $dbh->prepare("SELECT * FROM users WHERE correo=?");
              $stmt->bindParam(1, $correo);
              // Especificamos el fetch mode antes de llamar a fetch()
              $stmt->setFetchMode(PDO::FETCH_OBJ);
              // ejecutamos
              $stmt->execute();
              $row = $stmt->fetch();
              if(password_verify($userpass, $row->pass) == 1){
                if($row->estado=='Activo'){
                  $_SESSION['correo']=$row->correo;
                  $_SESSION['nombre']=$row->nom;
                  $_SESSION['apellido']=$row->apell;
                  $_SESSION['imagen']=$row->img;
                  $_SESSION['estado']=$row->estado;
                  if($correo == 'admin@ehu.es'){
                    $_SESSION['tipo']='admin';
                  }else{
                    $_SESSION['tipo']=$row->tipouser;
                  }
                  $dbh = null;
                  echo '<script type="text/javascript"> alert("Bienvenido al Sistema: '. $_SESSION['correo'] .' ");
                          window.location.href="Layout.php";
                          </script>';
                } else {
                  $dbh = null;
                  echo '<script>
                      alert("Este usuario está bloqueado");
                      window.location.href="LogIn.php";
                    </script>';
                }
              } else {
                $dbh = null;
                echo "<h3>Datos de login incorrectos. :(</h3>";
                echo "<br>";
              }
              // cerrar conexión
              //$dbh = null;
          }
        }
        ?>
    </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html> 