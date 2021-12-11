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
        <form id="cpass" name="cpass" action="LogIn.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Restablecer contraseña</h2> 
            </caption>
            <tr>
              <td align="right">Introduce la nueva contraseña: </td>
              <td align="left"><input style="width: 600px;" type="password" id="pass1" name="pass1" autofocus></td>
            </tr>
            <tr>
              <td align="right">Repite la contraseña: </td>
              <td align="left"><input style="width: 600px;" type="password" id="pass2" name="pass2" autofocus></td>
            </tr>
            <tr>
            <td></td>                               <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
              <td align="left"><input type="submit" id="confirmar" name="confirmar" value="Cambiar contraseña"></button></td>
            </tr>
          </table>
        </form>
        <?php
        //Validación del registro en el servidor
        if (isset($_POST['confirmar'])){

            $correo = $_GET['correo']; 
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            
            if($pass1 == ""){
                echo "<h3>Debes introducir una contraseña.</h3>";
                echo "<br>";
            } else if($pass2 == ""){
                echo "<h3>Debes repetir la contraseña.</h3>";
                echo "<br>";
            } else if (strlen($pass1) < 8){
              echo "<h3>La contraseñad debe tener más de 8 caracteres.</h3>";
              echo "<br>";
            } else if ($pass1 != $pass2){
              echo "<h3>Las contraseñas deben ser iguales.</h3>";
              echo "<br>";
            } else {
              include 'DbConfig.php';
              try{
                $dsn = "mysql:host=$server;dbname=$basededatos";
                $dbh = new PDO($dsn, $user, $pass);
              } catch (PDOException $e){
                echo $e->getMessage();
              }
              // prepare
              $stmt = $dbh->prepare("UPDATE users SET pass = ? WHERE correo = ?");
              // bind
              $hash = password_hash($pass1, PASSWORD_DEFAULT);
              $stmt->bindParam(1, $hash);
              $stmt->bindParam(2, $correo);
              // execute
              $stmt->execute();
              // cerrar conexión
              $dbh = null;
              echo '<script type="text/javascript"> alert("Se ha restablecido la contraseña");
                         window.location.href="LogIn.php";
                      </script>';
            }
          }
              
        ?>
    </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html> 