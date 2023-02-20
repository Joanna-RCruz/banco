<?php

function procurarCliente($cpf){
    foreach($_SESSION['clientes'] as $cliente){
        $cliente = unserialize($cliente);
        if($cliente->getCpf() == $cpf) return serialize($cliente);
    }
}

class Cliente{
    private $nome;
    private $cpf;
    private $email;
    private $conta;

    function __construct($nome, $cpf, $email, Conta $conta = null){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->conta = $conta;
    }

    function getNome(){
        return $this->nome;
    }

    function getCpf(){
        return $this->cpf;
    }

    function getEmail(){
        return $this->email;
    }

    function getConta(){
        return $this->conta;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCpf($cpf){
        $this->cpf = $cpf;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setConta($conta){
        $this->conta = $conta;
    }
}
?>