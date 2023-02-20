<?php
session_start();

include "Conta.php";
include "Cliente.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(procurarCliente($_POST['donocpf']) != null){
        $_SESSION['contas'][] = serialize(new Conta(
            $_POST['agencia'],
            $_POST['numero'],
            $_POST['saldo'],
            $_POST['datacriacao'],
            unserialize(procurarCliente($_POST['donocpf'])),
        ));
    }
}

echo("<script>window.location.replace('".$_SESSION['urlv'][0]."');</script>");

?>