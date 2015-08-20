<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../ClasseTimes.php');

$Times = new Times();
    

$Times->CriarIntxId($_REQUEST['NomeDoTime']);
$Times->CriarStrNomeTime($_REQUEST['NomeDoTime']);
$Times->CriarStrEstado($_REQUEST['estado']);
$Times->CriarStrCidade($_REQUEST['cidade']);
$Times->CriarIntDivisao($_REQUEST['divisao']);


$Times->updateCadastroTimes($Times);

?>