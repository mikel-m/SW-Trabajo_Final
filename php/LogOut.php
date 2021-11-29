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
    <script type="text/javascript">
        alert("¡Hasta pronto!");
        window.location.href="Layout.php";
    </script>;
     <?php 
      session_unset();
      session_destroy();?>
      
    </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>
</html> 