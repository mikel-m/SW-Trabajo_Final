<?php
    session_start();
    if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin"){

        include "DbConfig.php";

        $correo = $_POST['correo'];
        $estado = $_POST['estado'];

        if ($estado == 'Activo'){
            $CambioEstado = "Bloqueado";
        }else{
            $CambioEstado = "Activo";
        }


        if ($correo == "admin@ehu.es"){
            exit();
        }

        /*
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);

        if (!$mysqli){
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "UPDATE users SET estado='$CambioEstado' WHERE correo='$correo'";

        $res = mysqli_query($mysqli, $query);

        if(!$res){
            die("An error ocurred while processing data " . mysqli_connect_error());
        }

        mysqli_close($mysqli);
        */

        // PDO
        try{
            $dsn = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dsn, $user, $pass);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        // prepare
        $stmt = $dbh->prepare("UPDATE users SET estado=? WHERE correo=?");
        // bind
        $stmt->bindParam(1, $CambioEstado);
        $stmt->bindParam(2, $correo);
        // execute
        $stmt->execute();
        // cerrar conexión
        $dbh = null;

        echo "<script>
            window.location.href='HandlingAccounts.php';
            </script>";

    }else{

        echo '<script>
              alert("No tienes acceso a esta página");
              window.location.href="Layout.php";
            </script>';
    }


?>