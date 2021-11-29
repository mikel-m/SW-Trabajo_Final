<?php
    session_start();
    if(!isset($_SESSION['tipo']) || $_SESSION['tipo']!='admin'){
      if (!isset($_SESSION['estado']) || $_SESSION['estado']=='bloqueado'){
        echo '<script>
            alert("Este usuario está bloqueado");
            window.location.href="Layout.php";
          </script>';
      } else {
        echo '<script>
              alert("No tienes acceso a esta página");
              window.location.href="Layout.php";
            </script>';
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
  <?php
        include "DbConfig.php";

        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);

        if (!$mysqli){
          exit('<p style="color:red;"> Ha ocurrido un error inesperado </p> <br> <a href="Layout.php"> Volver a la pagina principal </a>');
        }

        $query = "SELECT correo , pass, estado, img  FROM users WHERE correo != 'admin@ehu.es' ";

        $res = mysqli_query($mysqli, $query);

        if(!$res){
          exit('<p style="color:red;"> Ha ocurrido un error inesperado </p> <br> <a href="Layout.php"> Volver a la pagina principal </a>');
        }

        echo '<table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8" class="questionsTable"><tr> <th> Email </th> <th> Pass </th> <th> Imagen </th> <th> Cambiar Estado </th> <th> Borrar </th><th> Estado </th></tr>';

        while ($row = mysqli_fetch_array($res)){
            $confirmBorrar = "'Estas seguro que quieres borrar a:".$row['correo']."'";
            $confirmEstado = "'Estas seguro que cambiar el estado de ".$row['correo']."'";

             echo '<tr>
                    <td>' .$row['correo'].'</td>
                    <td>' .$row['pass'].'</td>
                    <td> <img width="80px" height="80px" src="'.$row['img'].'" ></td>
                    <td><form method="POST" action="ChangeUserState.php">
                        <input type="hidden" name="correo" value="'.$row['correo'].'">
                        <input type="hidden" name="estado" value="'.$row['estado'].'">
                        <input type="submit" value ="Cambiar Estado" onClick="return confirm('.$confirmEstado.')">
                    </form></td>
                    <td><form method="POST" action="RemoveUser.php">
                        <input type="hidden" name="correo" value="'.$row['correo'].'">
                        <input type="submit" value ="Borrar" onClick="return confirm('.$confirmBorrar.')">
                    </form></td>
                    <td>' .$row['estado'].'</td>
                </tr>';
        }

        echo '</table>';


        mysqli_close($mysqli);


?>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>