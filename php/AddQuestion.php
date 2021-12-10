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
      <?php
      
      //Inicializamos las variables que van a contener la información enviada por el formulario de login
      $correo = ""; 
      $enun = "";
      $correct = "";
      $inc1 = "";
      $inc2 = "";
      $inc3 = "";
      $compl = "";
      $tema = "";
      //die(print_r($_POST,1));

      if (isset($_POST['botonPreg'])){ //Si se ha pulsado el submit con nombre "login" se comienza a procesar el formulario

        $correo = $_POST['correo']; 
        $enun = $_POST['enun'];
        $correct = $_POST['correct'];
        $inc1 = $_POST['inc1'];
        $inc2 = $_POST['inc2'];
        $inc3 = $_POST['inc3'];
        $compl = $_POST['dif'];
        $tema = $_POST['tema'];

        //Conectamos con la base de datos mysql
        /*
        include 'DbConfig.php';
        $conn = mysqli_connect($server, $user, $pass, $basededatos);
        $conn->set_charset("utf8");

        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO preguntas (correo, enun, correct, inc1, inc2, inc3, compl, tema) VALUES ('$correo', '$enun', '$correct', '$inc1', '$inc2', '$inc3', '$compl', '$tema')";
        $anadir = mysqli_query($conn, $sql);
        if(!$anadir){
          echo "<h3>Se ha producido un error al intentar insertar la pregunta en la base de datos. :(</h3>";
          echo "<br>";
          echo "<a href="."HandlingQuizesAjax.php".">VOLVER A INSERTAR PREGUNTA</a>";
        }
        else{
          echo "<h3>Se ha introducido la pregunta en la base de datos. :)</h3>";
          echo "<br>";
          //echo "<a href="."ShowQuestions.php".">VISUALIZAR PREGUNTAS</a>";
          mysqli_close($conn);
        }
        */


        // PDO
        include 'DbConfig.php';
        try{
          $dsn = "mysql:host$server;dbname=$basededatos";
          $dbh = new PDO($dsn, $user, $pass);
        } catch (PDOException $e){
          echo $e->getMessage();
        }
        // prepare
        $stmt = $dbh->prepare("INSERT INTO preguntas (correo, enun, correct, inc1, inc2, inc3, compl, tema) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        // bind
        $stmt->bindParam(1, $correo);
        $stmt->bindParam(2, $enun);
        $stmt->bindParam(3, $correct);
        $stmt->bindParam(4, $inc1);
        $stmt->bindParam(5, $inc2);
        $stmt->bindParam(6, $inc3);
        $stmt->bindParam(7, $compl);
        $stmt->bindParam(8, $tema);
        // execute
        $stmt->execute();
        // cerrar conexión
        $dbh = null;
      }	
      ?>
    </div>
    </section>
    <?php include '../html/Footer.html' ?>
  </body>
</html>