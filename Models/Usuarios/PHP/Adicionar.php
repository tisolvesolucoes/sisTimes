<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../../../Controller/preProcessor.php');
require('../ClasseUsuarios.php');

$Usuario = new Usuario();
$RodacadastroUsuario = new RodaDados();
    
$idUsuario = $RodacadastroUsuario->PegaId('idUsuario', 'tb_usuarios');
$Usuario->CriaIntxId(++$idUsuario);
#$Usuario->CriaIntSexoUsuario($_REQUEST['sexo']);
$Usuario->CriadTAgora(date('Y-m-d H:i:s'));
$Usuario->CriaArrCaminhoDaFoto('');
$Usuario->CriaStrLoginUsuario($_REQUEST['TxtLogin']);
$Usuario->CriaStrNomeUsuario($_REQUEST['TxtNome']);
$Usuario->CriaStrSitesUsuario($_REQUEST['TxtSite']);
$Usuario->CriaStrSenhaUsuario($_REQUEST['TxtSenha']);
$Usuario->CriaStrEmailUsuario($_REQUEST['TxtEmail']);
#$Usuario->CriaStrTelefonesUsuario($_REQUEST['tel']);
//$Usuario->CriadTDataDeNascimentoUsuario($_REQUEST['ano'].'-'.$_REQUEST['mes'].'-'.$_REQUEST['dia']);
$Usuario->CriadTDataDeNascimentoUsuario($_REQUEST['dtAno'].'-'.$_REQUEST['dtMes'].'-'.$_REQUEST['dtDia']);

$Usuario->insereCadastroUsuario($Usuario);
$RodacadastroUsuario->insereSiteUsuario($Usuario, $_SESSION['TipoUsuario']);
$RodacadastroUsuario->insereEmailUsuario($Usuario, $_SESSION['TipoUsuario']);

?>