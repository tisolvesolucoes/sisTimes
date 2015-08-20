<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
//require('../../../Controller/preProcessor.php');
require('../ClasseJogadores.php');

$Jogadores = new Jogadores();
//$RodacadastroTimes = new RodaDados();
    
$Jogadores->CriarIntxId($_REQUEST['idJogador']);

$Jogadores->deletaCadastroJogadores($Jogadores);

?>