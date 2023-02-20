<?php

function procurarConta($numero){ //Procura uma conta no vetor da sessão, deleta-a e retorna seus conteúdos
    foreach($_SESSION['contas'] as  $indice => $conta){
        $conta = unserialize($conta);
        if($conta->getNumero() == $numero){
            unset($_SESSION['contas'][$indice]);
            return serialize($conta);
        }
    }
}

class Conta{
    private $agencia;
    private $numero;
    private $saldo;
    private $data_criacao;
    private $dono;

    function __construct($agencia, $numero, $saldo, $data_criacao, Cliente $dono){
        $this->agencia = $agencia;
        $this->numero = $numero;
        $this->saldo = $saldo;
        $this->data_criacao = $data_criacao;
        $this->dono = $dono;
        
        $this->dono->setConta($this);
    }

    function sacar($valor){
        if($valor < $this->saldo)
            $this->saldo -= $valor;
        else return -1;
    }

    function depositar($valor){
        $this->saldo += $valor;
    }

    function transferir($valor, Conta $recipiente){
        if($valor < $this->saldo){
            $this->saldo -= $valor;
            $recipiente->depositar($valor);
        }
        else return -1;
    }

    function getAgencia(){
        return $this->agencia;
    }

    function getNumero(){
        return $this->numero;
    }

    function getSaldo(){
        return $this->saldo;
    }

    function getDono(){
        return $this->dono;
    }

    function getDataCriacao(){
        return $this->data_criacao;
    }

    function setAgencia($agencia){
        $this->agencia = $agencia;
    }

    function setNumero($numero){
        $this->numero = $numero;
    }

    function setSaldo($saldo){
        $this->saldo = $saldo;
    }

    function setDataCriacao($data_cricao){
        $this->data_criacao = $data_criacao;
    }

    function setDono(Cliente $dono){
        $this->dono - $dono;
    }
}

?>