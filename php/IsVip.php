<?php
  session_start();
  if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!='prof')){
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
        td, th {
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          padding: 6px;
          border: solid 2px #c1e9f6;
        }
        table {
          border-collapse: collapse;
        }
        .imgPrev {
            display: block;
            width: 100%;
            height: auto;
        }
        .imgPrev2 {
            display: block;
            width: 100px;
            height: 100px;
        }
      </style>
      
        <h1>Cliente REST para saber si el usuario es VIP</h1><br>
        <form id="fisVip" name="fisVip" method="POST">
          <input type="text" id="id" name="id">
          <input type="submit" id="esVIP" name="esVIP" value="Es VIP?">
        </form>
        <?php
          if (isset($_POST['esVIP'])){
            $culr = curl_init();
            $url = "https://sw.ikasten.io/~G24/LabWebServices/php/VipUsers.php?id=" . $_POST['id'];
            curl_setopt($culr, CURLOPT_URL, $url);
            curl_setopt($culr, CURLOPT_RETURNTRANSFER, 1);
            $str = curl_exec($culr);
            echo $str;
          }
        ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
