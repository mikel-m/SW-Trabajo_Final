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
  <section class="main" id="s1">
    <div>
        <style>
          .imgPrev {
            display: block;
            width: auto;
            height: 100%;
          }
        </style>
        
        <form id="fquestion" name="fquestion" action="AddQuestionWithImage.php?correo=<?php echo $_GET["correo"]; ?>" enctype="multipart/form-data"  method = "POST" onsubmit = "return validacion()" actionstyle="width: 60%; margin: 0px auto;">
        
        <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Pregunta para el quiz</h2> 
            </caption>
            <tr>
              <td align="right">Dirección de correo (*): </td>
              <?php if (isset($_GET['correo'])){                                           
                echo '<td align="left"><input type="text" id="correo" name="correo" autofocus value ="'.$_GET["correo"].'"></td>';
               }else{ ?>  
                <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
              <?php }?>
            </tr>
            <tr>
              <td align="right">Enunciado de la pregunta (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="enun" name="enun" autofocus placeholder="Ej: Elemento HTML para añadir una tabla"></td>
            </tr>
            <tr>
              <td align="right">Respuesta correcta (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="correct" name="correct" autofocus placeholder="Ej: <TABLE>"></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 1 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc1" name="inc1" autofocus></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 2 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc2" name="inc2" autofocus></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 3 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc3" name="inc3" autofocus></td>
            </tr>
            <tr>
              <td align="right">Complejidad: </td>
              <td align="left">
                <select name="dif" id="dif" form="fquestion">
                  <option value="1">1 - Baja</option>
                  <option value="2">2 - Media</option>
                  <option value="3">3 - Alta</option>
                </select> 
              </td>
            </tr>
            <tr>
              <td align="right">Tema (*): </td>
              <td align="left"><input type="text" id="tema" name="tema" autofocus></td>
            </tr>
            <tr>
              <td align="right">Imagen: </td>
              <td align="left"><input id="subirImagen" name="subirImagen" type="file" onchange="" accept="image/png, image/jpeg"></td>
            </tr>
            <tr>
              <td></td>
              <td align ="left"><img id="preview" name="preview"  class="imgPreview" src="" height="200"></td>
            </tr>
            <tr>
            <td></td>
              <td align ="left"><input type="button" id="borrarImagen" name="borrarImagen" value="Borrar Imagen"></td>    
            </tr>
            <tr>
            <td></td>
              <td align="left"><input type="button" id="botonPreg" name="botonPreg" value="Enviar solicitud" onClick="addQuestion();showQuestions()"></td>
            </tr>
            <td></td>
              <td align="left"><input type="button" id="mostrarPreguntas" name="mostrarPreguntas" value="Mostrar preguntas" onClick="showQuestions()"></td>
            </tr>
          </table>
        </form>
    </div>
    <!-- https://www.w3schools.com/php/php_ajax_xml.asp -->
    <!-- Mirar este video: https://www.youtube.com/watch?v=M4LaQ3KUGOM -->
    <div class="table table-bordered table-striped center " id="mostrar-Preguntas"><b>Aqui se mostrará la tabla de las preguntas...</b></div>


  </section>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <script type="text/javascript" src="../js/RemoveImageInForm.js"></script>
  <script type="text/javascript" src="../js/ValidateFieldsQuestionJQ.js"></script>

  <!-- scripts del lab 6 -->
  <script type="text/javascript" src="../js/AddQuestionsAjax.js"></script>
  <script type="text/javascript" src="../js/ShowQuestionsAjax.js"></script>

  <?php include '../html/Footer.html' ?>
</body>
</html>
