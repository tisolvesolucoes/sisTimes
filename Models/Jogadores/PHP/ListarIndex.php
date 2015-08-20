<?php
session_start();
ob_start();

require('../Controller/Registry.php');   
require('../Controller/conn.php');
require('../Controller/preProcessor.php');
require('../Models/Jogadores/ClasseJogadores.php');

$Jogadores = new Jogadores();

$jogador = $Jogadores->PegarJogadoresIndex();

echo $jogador ;
sleep(1); 

?>