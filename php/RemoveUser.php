<?php
    session_start();
    if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin"){
        /*
        include "DbConfig.php";

        $correo = $_POST['correo'];

        if ($correo == "admin@ehu.es"){
            exit("Imposible ejecutar esta acción");
        }

        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);

        if (!$mysqli){
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "DELETE FROM users WHERE correo='$correo'";

        $res = mysqli_query($mysqli, $query);

        if(!$res){
            die("An error ocurred while deleting data " . mysqli_connect_error());
        }

        mysqli_close($mysqli);

        echo "<script>
            window.location.href='HandlingAccounts.php';
            </script>";
        */

        
        // PDO
        include "DbConfig.php";

        $correo = $_POST['correo'];

        if ($correo == "admin@ehu.es"){
            exit("Imposible ejecutar esta acción");
        }

        try{
            $dsn = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dsn, $user, $pass);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        // prepare
        $stmt = $dbh->prepare("DELETE FROM users WHERE correo=?");
        // bind
        $stmt->bindParam(1, $correo);
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