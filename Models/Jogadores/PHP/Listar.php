<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../../../Controller/preProcessor.php');
require('../ClasseJogadores.php');

$Jogadores = new Jogadores();

$jogador = $Jogadores->PegarJogadores();

echo $jogador ;
sleep(1); 

?>