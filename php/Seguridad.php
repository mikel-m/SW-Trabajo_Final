<?php
    include("VipUsers.php");
    include("database.php");

    // Iniciando sesion
    session_start();
    // Guardando la sesion
    $user_check = $_SESSION['login'];
    // SQL Query para completar la informacion del usuario
    $sql = "SELECT correo FROM users WHERE correo='$user_check'";
    $ses_sql = mysqli_query($cnx, $sql);
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session = $row['correo'];
    if (!isset($login_session)){
        mysqli_close($cnx); // Cerrando la conexion
        header('Location: Layout.php'); // Redirecciona a la pagina de inicio
    }
?>