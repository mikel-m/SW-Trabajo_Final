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

      <h2>Quiz: el juego de las preguntas</h2>

      <?php
        // creamos una nueva instancia de Google API client
      $client = new apiClient();
      $client->setApplicationName("Quiz");
      
      // Configuración de la aplicación los datos los obtendremos de SetUp.php
      $client->setClientId("206952799159-l850tbg2t1obhhaqcdfkotiakuqptlcc.apps.googleusercontent.com");
      $client->setClientSecret("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");
      $client->setDeveloperKey("AIzaSyD9_dUhsonJm9teNVF4tEaQkjgZBKhoJTE");
      $client->setRedirectUri("https://sw.ikasten.io/~mmorillo005/TrabajoFinal/php/Layout.php");
      $client->setApprovalPrompt(false);
      $oauth2 = new apiOauth2Service($client);
      
      // una redireccion de google, con un codigo temporal
      if (isset($_GET['code'])) {
      
        //Este método obtendrá el token de acceso real de Google,
        // para que podamos solicitar información del usuario
        $client->authenticate();
      
        // Obtenemos datos de usuario y lo almacenamos en la var $info
        $info = $oauth2->userinfo->get();
      
        // buscamos este usuario en la base de datos con el modelo base idiorm.php
        //lo almacenamos en la var $person
        //$person = ORM::for_table('google_users')->where('email', $info['email'])->find_one();
      
        //if(!$person){
            // usuario no encontardo. Registramos!
      
            //$person = ORM::for_table('google_users')->create();
      
            // Configuramos propiedades que se insertarán en la base de datos //aray de database
            //$person->email = $info['email'];
            //$person->name = $info['name'];
      
            /*
          //google utiliza una picture automática con la primera letra del nombre de usuario
          //creo que esto no es necesario pero por como no queremos errores lo condicicionamos.
            if(isset($info['picture'])){
                // Si el usuario ha establecido una foto pública de la cuenta de Google
                $person->photo = $info['picture'];
            }
            else{
                // caso contrario usamos el predeterminado del sistema
                $person->photo = 'view/assets/img/usuario.jpg';
            }
            */
      
            // grabamos al usuario en la dB
            //$person->save();
        }
      
        // guaradamos la sesion de usuario
        //$_SESSION['demo_sesion_google'] = $person->id();
        $_SESSION['correo']=$info['email'];
        $_SESSION['imagen']=$info['picture'];
        $_SESSION['tipo']='alu';
        $_SESSION['estado']='Activo';
        // redireccionamos a la url especificada
        header("Location: Layout.php");
        exit;
      //}
      
      //$person = null;
      
      /*
      //requerimos el header cargamos template html
      require_once('view/inc/header.php');
      
      if(isset($_SESSION['demo_sesion_google'])){
        // obtenemos datos de usuario de la base de datos con el id del usuario de google session
        $person = ORM::for_table('google_users')->find_one($_SESSION['demo_sesion_google']);
        //mostramos la vista index.php y pasamos la var $person para ser mostardo
        // cabe recalcar que con find_one() solo vamos a buscar una fila que coincida con el email buscado
        require_once('view/index.php');
      }else{
        // si no se a iniciado la sesión mostramos el botón de google
        require_once('view/inc/nosesion.php');
      
      }
      
      // requerimos el footer casi no hay mucho que mostrar
      require_once('view/inc/footer.php');
      */
      ?>


    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
