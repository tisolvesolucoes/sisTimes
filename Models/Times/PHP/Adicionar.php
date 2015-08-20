<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../ClasseTimes.php');

$Times = new Times();
    
$idTime = $Times->PegarId();
$Times->CriarIntxId(++$idTime);
$Times->CriardtDataDeCadastro(date('Y-m-d H:i:s'));
$Times->CriarStrNomeTime($_REQUEST['NomeDoTime']);
$Times->CriarStrEstado($_REQUEST['estado']);
$Times->CriarStrCidade($_REQUEST['cidade']);
$Times->CriarIntDivisao($_REQUEST['divisao']);
$Times->CriarIntIdUsuario($_SESSION['idUsuario']);

$Times->insereCadastroTimes($Times);

?>