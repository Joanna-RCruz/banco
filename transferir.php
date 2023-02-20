<?php
session_start();

include "Conta.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $url = 'http://localhost'.$_SERVER['REQUEST_URI'];
    $params = array();
    $url_components = parse_url($url);
	parse_str($url_components['query'], $params);

    $conta = unserialize(procurarConta($params['no']));
    $conta2 = unserialize(procurarConta($_POST['no2']));

    $conta->sacar($_POST['valor']);
    $conta2->depositar($_POST['valor']);
    $_SESSION['contas'][] = serialize($conta);
    $_SESSION['contas'][] = serialize($conta2);
}

echo("<script>window.location.replace('".$_SESSION['urlv'][0]."');</script>");

?>