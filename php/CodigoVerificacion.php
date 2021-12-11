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
        <form id="flogin" name="flogin" action="CodigoVerificacion.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
          <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Restablecer contraseña</h2> 
            </caption>
            <tr>
              <td align="right">Introduce el codigo de verificación: </td>
              <td align="left"><input type="text" id="codigo" name="codigo" autofocus></td>
            </tr>
            <tr>
            <td></td>                               <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
              <td align="left"><input type="submit" id="rest" name="rest" value="Restablecer contraseña"></button></td>
            </tr>
          </table>
        </form>
        <?php
            $para = $_GET['correo'];
            $titulo = 'Código de cerificación';
            $mensaje = sprintf("%05d", mt_Rand(1, 99999));
            mail($para, $titulo, $mensaje);

            if (isset($_POST['rest'])){

                $codigo = $_POST['codigo'];

                if ($codigo == ""){
                    echo "<h3>Debes introducir el código de verificación.</h3>";
                    echo "<br>";
                } else {
                    if (strcmp($mensaje, $codigo) == 0){
                        echo '<script type="text/javascript"> alert("Código de verificación correcto");
                          window.location.href="ChangePassword.php?correo='. $para . '";
                          </script>';
                    } else {
                        echo "<h3>Código de verificación incorrecto. :(</h3>";
                        echo "<br>";
                    }
                }
            }
        ?>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html> 