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
    <?php
    $mensajeInsertarEnBD = insertarPreguntaBD();
    $mensajeInsertarEnXML = insertarPreguntaXML();
    $mensajeInsertrJSon = insertarJson();

    echo($mensajeInsertarEnBD);
    echo($mensajeInsertarEnXML);
    echo($mensajeInsertrJSon);

   // if($mensajeInsertarEnBD == "" || $mensajeInsertarEnBD == null || $mensajeInsertarEnXML == "" || $mensajeInsertarEnXML == null || $mensajeInsertrJSon == "" || $mensajeInsertrJSon == null){
      ?>
      <script type="text/javascript">
        alert("Pregunta añadida con exito");
      </script>
      <?php
    //}
    

    ?>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
<?php


    function insertarPreguntaBD(){
      include "DbConfig.php";


      $correo = $_POST['correo']; 
      $enun = $_POST['enun'];
      $correct = $_POST['correct'];
      $inc1 = $_POST['inc1'];
      $inc2 = $_POST['inc2'];
      $inc3 = $_POST['inc3'];
      $compl = $_POST['dif'];
      $tema = $_POST['tema'];
      $urlBack = "?correo=".$correo;


      // Validacion de tipo de usuario
      $esAlumno = preg_match("/^[a-z]+\\d{3}@ikasle\.ehu\.(eus|es)$/", $correo);
      $esProfesor = preg_match("/^([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/", $correo);
      if(!($esAlumno || $esProfesor)){
        return "<p id='msgBD' style='color:red;'> El email no es valido </p> <br> <a href='QuestionFormWithImage.php".$urlBack."'> Volver a la pagina principal </a>";
      }

      //Validacion campos vacios
      if($correo=="" || $enun=="" || $correct=="" || $inc1=="" || $inc2=="" || $inc3=="" || $tema==""){
        return "<p id='msgBD' style='color:red;'> No puedes haber ningun campo vacio </p> <br> <a href='QuestionFormWithImage.php".$urlBack."'> Volver a la pagina principal </a>";
      }


      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);

      if (!$mysqli){
        return "<p id='msgBD' style='color:red;'> Ha ocurrido un error inesperado </p> <br> <a href='QuestionFormWithImage.php".$urlBack."'> Volver a la pagina principal </a>";
      }

      /*if(!empty($_FILES['imagenPregunta']['tmp_name'])){

        $path = "../images/preguntas/" . strtotime('now') . "_" . $_FILES['imagenPregunta']['name'];

        if(!move_uploaded_file($_FILES['imagenPregunta']['tmp_name'], $path)) {
          return "<p id='msgBD' style='color:red;'>Error al subir la imagen, porfavor introduzca la pregunta de nuevo </p> <br> <a href='QuestionFormWithImage.php".$urlBack."'> Insertar pregunta </a>";

        }

      }else{
        $path = "../images/noimage.png";
      }*/
      $path = "../images/placeholder.png";
      $query = "INSERT INTO Preguntas(correo, enun, correct, inc1, inc2, inc3, compl, tema, imagen)
              VALUES ('$correo', '$enun', '$correct', '$inc1', '$inc2', '$inc3', '$compl', '$tema', '$path')";

      if(!mysqli_query($mysqli, $query)){
        return "<p id='msgBD' style='color:red;'>  Ha ocurrido un error inesperado </p> <br> <a href='QuestionFormWithImage.php".$urlBack."'> Volver a la pagina principal </a>";
      }

      mysqli_close($mysqli);

      return "<p id='msgBD'> La pregunta se guarda correctamente en la Base de Datos</p><br>";

    }

    function insertarPreguntaXML(){

      $correo = $_POST['correo']; 
      $enun = $_POST['enun'];
      $correct = $_POST['correct'];
      $inc1 = $_POST['inc1'];
      $inc2 = $_POST['inc2'];
      $inc3 = $_POST['inc3'];
      $compl = $_POST['dif'];
      $tema = $_POST['tema'];
      $urlBack = "?correo=".$correo;

      if($correo=="" || $enun=="" || $correct=="" || $inc1=="" || $inc2=="" || $inc3=="" || $tema==""){
        return "<p id='msgXML' style='color:red;'> No puedes haber ningun campo vacio </p> ";;
      }

      /* cargar fichero Questions.xml y leerlo */
      $questions_path = "../xml/Questions.xml";
      if(!file_exists($questions_path)){
        return "<p id='msgXML'style='color:red;'>Error: No se puede insertar en el xml </p> <br>";

      }
      $xml = simplexml_load_file($questions_path);

      $new_assesment = $xml->addChild('assessmentItem');
      $new_assesment -> addAttribute('subject', $tema);
      $new_assesment -> addAttribute('author', $correo);
      $nueva_pregunta = $new_assesment -> addChild('itemBody');
      $nueva_pregunta -> addChild('p', $enun);
      $correct_response = $new_assesment -> addChild('correctResponse');
      $correct_response -> addChild('response', $correct);
      $respuestas_incorrectas = $new_assesment -> addChild('incorrectResponses');
      $respuestas_incorrectas -> addChild('response', $inc1);
      $respuestas_incorrectas -> addChild('response', $inc2);
      $respuestas_incorrectas -> addChild('response', $inc3);

      $xml->asXML('../xml/Questions.xml');

      return "<p id='msgXML'> La pregunta se ha guardado correctamente en el fichero XML  </p> <br>";


    }

    function insertarJson(){

      $correo = $_POST['correo']; 
      $enun = $_POST['enun'];
      $correct = $_POST['correct'];
      $inc1 = $_POST['inc1'];
      $inc2 = $_POST['inc2'];
      $inc3 = $_POST['inc3'];
      $compl = $_POST['dif'];
      $tema = $_POST['tema'];
      $urlBack = "?correo=".$correo;

      if($correo=="" || $enun=="" || $correct=="" || $inc1=="" || $inc2=="" || $inc3=="" || $tema==""){
        return "<p id='msgXML' style='color:red;'> No puedes haber ningun campo vacio </p> ";;
      }


      $json = file_get_contents('../json/Questions.json');
      $tempArr = json_decode($json);
      $arrayInc = array($inc1, $inc2, $inc3);
      $pregunta = new stdClass();
      $pregunta->subject=$tema;
      $pregunta->author=$correo;
      $pregunta->itemBody=array("p"=>$enun);
      $pregunta->correctResponse=array("value"=>$correct);
      $pregunta->incorrectResponses=array("value"=>$arrayInc);
      $preguntaarray[0] = $pregunta;
      array_push($tempArr->assessmentItems, $preguntaarray[0]);
      $jsonData = json_encode($tempArr, JSON_PRETTY_PRINT);
      file_put_contents("../json/Questions.json", $jsonData);

    }


?>