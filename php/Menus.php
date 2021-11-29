<div id='page-wrap'>
<header class='main' id='h1'>
<?php if(!isset($_SESSION['correo'])){ 
  ?>

  
  <span class="right"><a href="SignUp.php">Registro</a></span>
  <span class="right"><a href="LogIn.php">Login</a></span>
  <?php }else{ ?>
  <span class="right"><a href="LogOut.php">Logout</a><?php echo '<img src="'.$_SESSION['imagen']. ' " width="50" height="50">'; ?></span>
  <?php } ?>

</header>
<nav class='main' id='n1' role='navigation'>
  <?php if(isset($_SESSION['correo'])){ 
    $correo = $_SESSION['correo'];
    $tipo = $_SESSION['tipo'];

    //$esProfesor = preg_match("/^([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/", $correo);
    if($tipo == 'prof'){?>
      <span><a href="Layout.php"> Inicio</a></span>
      <span><a href="Credits.php">Creditos</a></span>
      <span><a href="HandlingQuizesAjax.php"> Insertar Pregunta </a></span>
      <span><a href="ShowQuestionsWithImage.php"> Ver Preguntas </a></span>
      <span><a href="ShowXMLQuestionsWithImage.php"> Ver Preguntas XML</a></span>
      <span><a href="ShowJsonQuestionsWithImage.php"> Ver Preguntas JSON</a></span>
      <span><a href="IsVip.php"> Comprobar VIP</a></span>
      <span><a href="ShowVips.php"> Listado de VIP</a></span>
      <span><a href="AddVip.php"> Añadir VIP</a></span>
      <span><a href="DeleteVip.php"> Borrar VIP</a></span>
    <?php }
    if($tipo == 'alu'){ ?>
      <span><a href="Layout.php"> Inicio</a></span>
      <span><a href="Credits.php">Creditos</a></span>
      <span><a href="HandlingQuizesAjax.php"> Insertar Pregunta </a></span>
      <span><a href="ShowQuestionsWithImage.php"> Ver Preguntas </a></span>
      <span><a href="ShowXMLQuestionsWithImage.php"> Ver Preguntas XML</a></span>
      <span><a href="ShowJsonQuestionsWithImage.php"> Ver Preguntas JSON</a></span>
    <?php } 
    
    if($tipo == "admin"){?>
      <span><a href="Layout.php"> Inicio</a></span>
      <span><a href="Credits.php">Creditos</a></span>
      <span><a href="HandlingAccounts.php"> Gestionar usuarios</a></span>
    <?php }
    ?>
    


  <?php }else { ?>
  <span><a href="Layout.php"> Inicio</a></span>
  <span><a href="Credits.php">Creditos</a></span>
  <?php }?>
   
</nav>
