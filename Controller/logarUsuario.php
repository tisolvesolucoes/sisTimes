<?php
include('header.php');

require('Registry.php');
require('conn.php');
require('../Models/Usuarios/ClasseUsuarios.php');    
require('preProcessor.php');

if(isset($_REQUEST['enviaFormLogin']))
{
 
// Instanciar um novo cadastroUsuario e setar informações
$MontaLoginUsuario = new Usuario();

$MontaLoginUsuario->CriarStrSenhaUsuario($_REQUEST['txtSenha']);
$MontaLoginUsuario->CriarStrEmailUsuario($_REQUEST['txtEmail']);

    if($MontaLoginUsuario->PegarIntIdUsuario($MontaLoginUsuario)){     // Resgatar o id para iniciar sessao no sistema 
       header('location: ../Views/admin/');
    }
    else
    {
         header('location: ../Views/admin/?err=1');
    }
        
}
?>