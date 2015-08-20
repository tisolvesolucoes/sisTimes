<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../ClasseJogadores.php');

$Jogadores = new Jogadores();
    
$idJogador = $Jogadores->PegarId();
$Jogadores->CriarIntxId(++$idJogador);
$Jogadores->CriarStrNomeJogador($_REQUEST['NomeDoJogador']);
$Jogadores->CriarIntidTime($_REQUEST['idTime']);
$Jogadores->CriarIntIdade($_REQUEST['txtIdade']);
$Jogadores->CriarStrNacionalidade($_REQUEST['Nacionalidade']);
$Jogadores->CriarIntIdPosicao($_REQUEST['posicao']);
$Jogadores->CriardtDataDeCadastro(date('Y-m-d H:i:s'));
$Jogadores->CriarIntIdUsuario($_SESSION['idUsuario']);

$Jogadores->insereCadastroJogadores($Jogadores);
?>