<!-- 
Agio-Bank em PHP
 Autores: Joanna Ribeiro Cruz; João Felipe Silva Pereira
 Docente: Matheus Brito de Oliveira
 Disciplina: Desenvolvimento WEB II
-->

<?php
 
include "Cliente.php";
include "Conta.php";

session_start();

$url = 'http://localhost'.$_SERVER['REQUEST_URI'];
$params = array();

if(!isset($_SESSION['urlv'])){
    $_SESSION['urlv'] = explode("?", $url); //divide a url em "localhost/*/" e "action=*"

    $_SESSION['clientes'] = array(
        serialize(new Cliente("Adelaide Santos", "1", "as@mail.com")),
        serialize(new Cliente("Jurisceu Costa", "2", "jc@mail.com")),
    );
    
    $_SESSION['contas'] = array(
        serialize(new Conta("Agência A", 1, 50, "2001-01-01", unserialize($_SESSION['clientes'][0]))),
        serialize(new Conta("Agência B", 2, 50, "2002-02-02", unserialize($_SESSION['clientes'][1]))),
    );
}

if($url != $_SESSION['urlv'][0]){ //lê a url e extrai os parâmetros
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);
}

if(isset($params['action'])){ //Mostra as janelas caso o usuário esteja requisite algum serviço
    if($params['action']=="criarcliente"){
        echo("
            <div class='window'>
                <a class='close-button' href='".$_SESSION['urlv'][0]."'>
                    <img src='./res/x-lg.svg'/>
                </a>
                <h1>Cadastrar Cliente</h1>
                <form action='criarcliente.php' method='POST'>
                    <p>Nome:</p><input name='nome' type='text'><br>
                    <p>CPF:</p><input name='cpf' type='text'><br>
                    <p>E-mail:</p><input name='email' type='email'><br>
                    <br>
                    <p style='text-align: center;'>
                        <input style='width: 50px;' type='submit' value='Salvar'/>
                        <input style='width: 50px;' type='reset' value='Limpar'/>
                    </p>
                </form>
            </div> 
        ");
    }

    if($params['action']=="criarconta"){
        echo("
            <div class='window'>
                <a class='close-button' href='".$_SESSION['urlv'][0]."'>
                    <img src='./res/x-lg.svg'/>
                </a>
                <h1>Cadastrar Conta</h1>
                <form action='criarconta.php' method='POST'>
                    <p>Agência:</p><input name='agencia' type='text'><br>
                    <p>Número:</p><input name='numero' type='text'><br>
                    <p>Saldo:</p><input name='saldo' type='number'><br>
                    <p>Data de Criação:</p><input name='datacriacao' type='date'><br>
                    <p>CPF do cliente:</p><input name='donocpf' type='text'><br>
                    <br>
                    <p style='text-align: center;'>
                        <input style='width: 50px;' type='submit' value='Salvar'/>
                        <input style='width: 50px;' type='reset' value='Limpar'/>
                    </p>
                </form>
            </div> 
        ");
    }

    if($params['action']=="sacar"){
        echo("
            <div class='window'>
                <a class='close-button' href='".$_SESSION['urlv'][0]."'>
                    <img src='./res/x-lg.svg'/>
                </a>
                <h1>Sacar quantia</h1>
                <form action='sacar.php?no=".$params['no']."' method='POST'>
                    <p>Quantia (R$):</p><input name='valor' type='number'><br>
                    <br>
                    <p style='text-align: center;'>
                        <input style='width: 50px;' type='submit' value='Salvar'/>
                        <input style='width: 50px;' type='reset' value='Limpar'/>
                    </p>
                </form>
            </div> 
        ");
    }

    if($params['action']=="depositar"){
        echo("
            <div class='window'>
                <a class='close-button' href='".$_SESSION['urlv'][0]."'>
                    <img src='./res/x-lg.svg'/>
                </a>
                <h1>Depositar quantia</h1>
                <form action='depositar.php?no=".$params['no']."' method='POST'>
                    <p>Quantia (R$):</p><input name='valor' type='number'><br>
                    <br>
                    <p style='text-align: center;'>
                        <input style='width: 50px;' type='submit' value='Salvar'/>
                        <input style='width: 50px;' type='reset' value='Limpar'/>
                    </p>
                </form>
            </div> 
        ");
    }

    if($params['action']=="transferir"){
        echo("
            <div class='window'>
                <a class='close-button' href='".$_SESSION['urlv'][0]."'>
                    <img src='./res/x-lg.svg'/>
                </a>
                <h1>Transferir quantia</h1>
                <form action='transferir.php?no=".$params['no']."' method='POST'>
                    <p>Quantia (R$):</p><input name='valor' type='number'><br>
                    <p>Nº da conta do recipiente:</p><input name='no2' type='text'><br>
                    <br>
                    <p style='text-align: center;'>
                        <input style='width: 50px;' type='submit' value='Salvar'/>
                        <input style='width: 50px;' type='reset' value='Limpar'/>
                    </p>
                </form>
            </div> 
        ");
    }
}

echo("
    <table class='table-contas'>
        <tr style='background-color: #f0f0f0;'>
            <td class='table-contas-item'>Agência</td>
            <td class='table-contas-item'>Número</td>
            <td class='table-contas-item'>Saldo</td>
            <td class='table-contas-item'>Data de Criação</td>
            <td class='table-contas-item'>Cliente</td>
            <td class='table-contas-item' width='20%'>
                Ações
                <a class='button tooltip' href='?action=criarconta'>
                    <img src='res/credit-card.svg'/>
                        <span class='tooltip-text'>Criar nova conta
                    </span></a>
                <a class='button tooltip' href='?action=criarcliente'>
                    <img src='res/person-plus-fill.svg'/>
                        <span class='tooltip-text'>Criar novo cliente
                    </span></a>
                <a class='button tooltip' href='relatorio.php'>
                    <img src='res/file-earmark-text.svg'/>
                        <span class='tooltip-text'>Obter relatório
                    </span></a>
            </td>
        </tr>
 ");
foreach($_SESSION['contas'] as $conta){ //Mostra a tabela de contas linha por linha
    $conta = unserialize($conta);
    echo("
        <tr>
            <td class='table-contas-item'>".$conta->getAgencia()."</td>
            <td class='table-contas-item'>".$conta->getNumero()."</td>
            <td class='table-contas-item'>R$ ".$conta->getSaldo().",00</td>
            <td class='table-contas-item'>".$conta->getDataCriacao()."</td>
            <td class='table-contas-item'>".$conta->getDono()->getNome()."</td>
            <td class='table-contas-item'>
                <a class='button tooltip' href='?action=sacar&no=".$conta->getNumero()."'>
                    <img src='res/arrow-bar-down.svg'/>
                        <span class='tooltip-text'>Sacar
                    </span></a>
                <a class='button tooltip' href='?action=depositar&no=".$conta->getNumero()."'>
                    <img src='res/arrow-bar-up.svg'/>
                        <span class='tooltip-text'>Depositar
                    </span></a>
                <a class='button tooltip' href='?action=transferir&no=".$conta->getNumero()."'>
                    <img src='res/arrow-bar-right.svg'/>
                        <span class='tooltip-text'>Transferir
                    </span></a>
            </td>
        </tr>
    ");
}
echo("</table>");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>AgioBanco</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
</head>
<body style="margin: 0px;">

    <table width="100%" style="background-color: #2c3aa0;">
        <tr>
            <td width="90%">
                <a style="text-decoration: none;" href="<?php echo $_SESSION['urlv'][0] ?>"><h1>
                    <img height="32px" src="res/cash-coin.svg"/>
                    AgioBanco
                </h1></a>
            </td>
            <td width="200px">
                <p style="color: white;"><img height="20px" src="res/person.svg"/> Gerente</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p align="center" class="footer-text">
        AgioBanco © 2022 Sociedade dos agiotas anônimos.
        </p>
    </div>

</body>
</html>