<?php 
    include("conexion.php");
    if (!empty($_POST["login"])) {
        if (empty($_POST["email"]) and empty($_POST["password"])) {
            echo 'Esta vacios';
        } else {
            $email=$_POST["email"];
            $password=$_POST["password"];
            $sql=$conexion->query(" select * from datos where email=$email and contrasena=$password");
            if ($datos=$sql->fetch_object()) {
                header("Location:inicio.php");
            } else {
                echo 'Esta vacios';
            }
        }
    }


?>