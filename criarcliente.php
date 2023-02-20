<?php
session_start();

include "Cliente.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['clientes'][] = serialize(new Cliente(
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['email'],
    ));
}

echo("<script>window.location.replace('".$_SESSION['urlv'][0]."');</script>");

?>