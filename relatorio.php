<?php

include "Cliente.php";
include "Conta.php";

session_start();

date_default_timezone_set("America/Bahia");

echo("
    <h1>AgioBanco Ltda.</h1>
    <h3>Relatório Parcial</h3>
    <i>Gerado às ". date("h:i:s") ." em ". date("d/m/Y") ." por 'relatorio.php'.</i>
    <br><i>Todos os direitos reservados © 2022 SAA - Sociedade dos Agiotas Anônimos</i>
    <br><i>O acesso às informações contidas neste relatório são confidenciais e
    não devem ser distribuídas em hipótese alguma.</i>
");

echo("
    <h2>Contas</h2>
    <table style='border: 1px solid black;'>
        <tr style='background-color: #f0f0f0;'>
            <td>Agência</td>
            <td>Número</td>
            <td>Saldo</td>
            <td>Data de Criação</td>
            <td>Cliente</td>
        </tr>
 ");
$saldo_total = 0;
foreach($_SESSION['contas'] as $conta){
    $conta = unserialize($conta);
    $saldo_total += $conta->getSaldo();
    echo("
        <tr>
            <td>".$conta->getAgencia()."</td>
            <td>".$conta->getNumero()."</td>
            <td>R$ ".$conta->getSaldo().",00</td>
            <td>".$conta->getDataCriacao()."</td>
            <td>".$conta->getDono()->getNome()."</td>
        </tr>
    ");
}
echo("
    </table>
    <br>
    <h2>Clientes</h2>
    <table style='border: 1px solid black;'>
        <tr style='background-color: #f0f0f0;'>
            <td>Nome</td>
            <td>CPF</td>
            <td>Email</td>
        </tr>
");
foreach($_SESSION['clientes'] as $cliente){
    $cliente = unserialize($cliente);
    echo("
        <tr>
            <td>".$cliente->getNome()."</td>
            <td>".$cliente->getCpf()."</td>
            <td>".$cliente->getEmail()."</td>
        </tr>
    ");
}
echo("
    </table>
    <br>
    <i>
        Há ".count($_SESSION['contas'])." contas e ".count($_SESSION['clientes'])."
        clientes no total,
        com R$ $saldo_total,00 depositados ao todo.
    </i>
");

?>