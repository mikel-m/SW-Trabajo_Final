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
        <form id="rpass" name="rpass" action="RecuperarPassword.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Restablecer contraseña</h2> 
            </caption>
            <tr>
              <td align="right">Dirección de correo: </td>
              <td align="left"><input style="width: 600px;" type="text" id="correo" name="correo" autofocus></td>
            </tr>
            <tr>
            <td></td>                               <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
              <td align="left"><input type="submit" id="recpass" name="recpass" value="Restablecer contraseña"></button></td>
            </tr>
          </table>
        </form>
        <?php
          if (isset($_POST['recpass'])){

              $correo = $_POST['correo'];

              if ($correo == ""){
                  echo "<h3>Debes introducir una dirección de correo.</h3>";
                  echo "<br>";
                  echo "<a href='RecuperarPassword.php'>";
              } else {
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
                  if (row->correo==$correo){
                      $dbh = null;
                      echo '<script>
                          window.location.href="CodigoVerificacion.php?correo='. $correo . '";
                          </script>';
                  } else {
                    $dbh = null;
                    echo "<h3>El correo no existe. :(</h3>";
                    echo "<br>";
                  }
                }
            }
        ?>
    </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html> 