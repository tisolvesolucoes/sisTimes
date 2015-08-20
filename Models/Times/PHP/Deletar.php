<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
//require('../../../Controller/preProcessor.php');
require('../ClasseTimes.php');

$Times = new Times();
//$RodacadastroTimes = new RodaDados();
    
$idTime = $Times->CriarIntxId($_REQUEST['idTime']);

$Times->deletaCadastroTimes($Times);

?>