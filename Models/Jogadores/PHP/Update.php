<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../../../Controller/preProcessor.php');
require('../ClasseUsuarios.php');

$Usuario = new Usuario();
$RodacadastroUsuario = new RodaDados();
    
$idUsuario = $Usuario->PegaId('idUsuario', 'tb_usuarios');
$Usuario->CriarIntxId(++$idUsuario);
#$Usuario->CriaIntSexoUsuario($_REQUEST['sexo']);
$Usuario->CriardTAgora(date('Y-m-d H:i:s'));
$Usuario->CriarArrCaminhoDaFoto('');
$Usuario->CriarStrLoginUsuario($_REQUEST['TxtLogin']);
$Usuario->CriarStrNomeUsuario($_REQUEST['TxtNome']);
$Usuario->CriarStrSitesUsuario($_REQUEST['TxtSite']);
$Usuario->CriarStrSenhaUsuario($_REQUEST['TxtSenha']);
$Usuario->CriarStrEmailUsuario($_REQUEST['TxtEmail']);
#$Usuario->CriaStrTelefonesUsuario($_REQUEST['tel']);
//$Usuario->CriadTDataDeNascimentoUsuario($_REQUEST['ano'].'-'.$_REQUEST['mes'].'-'.$_REQUEST['dia']);
$Usuario->CriardTDataDeNascimentoUsuario($_REQUEST['dtAno'].'-'.$_REQUEST['dtMes'].'-'.$_REQUEST['dtDia']);

$Usuario->insereCadastroUsuario($Usuario);

$RodacadastroUsuario->insereEmailUsuario($Usuario, $_SESSION['TipoUsuario']);
$RodacadastroUsuario->insereSiteUsuario($Usuario, $_SESSION['TipoUsuario']);

    $v = $MontaCadastroUsuario;
    $s = 'Usuario'; 

// Instanciar um novo cadastroUsuario e setar informações
$MontaCadastroUsuario->CriarIntxId($_SESSION['idUsuario']);
$MontaCadastroUsuario->CriarStrLoginUsuario($_REQUEST['txtLogin']);
$MontaCadastroUsuario->CriarStrSenhaUsuario($_REQUEST['txtSenha']);
$MontaCadastroUsuario->CriarStrEmailUsuario($_REQUEST['txtEmail']);
$MontaCadastroUsuario->CriarStrSitesUsuario($_REQUEST['txtSites']);
$MontaCadastroUsuario->CriarStrTelefonesUsuario($_REQUEST['tel']);
$MontaCadastroUsuario->CriarStrNomeUsuario($_REQUEST['txtNome']);
$MontaCadastroUsuario->CriarStrNomeUsuario($_REQUEST['txtSobreNome']);
$MontaCadastroUsuario->CriardTDataDeNascimentoUsuario($_REQUEST['ano'].'-'.$_REQUEST['mes'].'-'.$_REQUEST['dia']);
$MontaCadastroUsuario->CriarArrCaminhoDaFoto($_FILES["imagem"]);
criaCaminhoAlbunsFotos('u/p/', $MontaCadastroUsuario, $RodacadastroUsuario, 1);
$MontaCadastroUsuario->CriarIntSexoUsuario($_REQUEST['sexo']);
$MontaCadastroUsuario->CriarArrEstiloMusica($_REQUEST['estilo_musical']);
$MontaCadastroUsuario->CriarArrInstrumentoTocadoMusico($_REQUEST['instrumentos']);
$MontaCadastroUsuario->CriarIntAtivo($_REQUEST['ativo']);

$MontaCadastroUsuarioEndereco->CriaIntXId($_SESSION['xId']);
$MontaCadastroUsuarioEndereco->CriaIntTipoUsuario($_SESSION['TipoUsuario']);
$MontaCadastroUsuarioEndereco->CriaIntIdTbEnderecoUsuario($_REQUEST['IdTbEnderecoUsuario']);
$MontaCadastroUsuarioEndereco->CriaIntEnderecoRegiaoZona($_REQUEST['txtEndereco_regiao_zona']);
$MontaCadastroUsuarioEndereco->CriaIntTipoEndereco($_REQUEST['TipoLogradouro']);
$MontaCadastroUsuarioEndereco->CriaStrNumCep($_REQUEST['txtCep']);
$MontaCadastroUsuarioEndereco->CriaStrEndereco($_REQUEST['txtEndereco']);
$MontaCadastroUsuarioEndereco->CriaStrComplemento($_REQUEST['txtComplemento']);
$MontaCadastroUsuarioEndereco->CriaStrBairro($_REQUEST['txtBairro']);
$MontaCadastroUsuarioEndereco->CriaNumNumero($_REQUEST['txtNum']);
$MontaCadastroUsuarioEndereco->CriaIntEstadoFk($_REQUEST['uf']);
$MontaCadastroUsuarioEndereco->CriaNumLongitude($_REQUEST['txtLongitude']);
$MontaCadastroUsuarioEndereco->CriaNumLatitude($_REQUEST['txtLatitude']);
$MontaCadastroUsuarioEndereco->CriaStrCidadeNatal($_REQUEST['txtCidadeNatal']);
$MontaCadastroUsuarioEndereco->CriaStrCidadeAtual($_REQUEST['txtCidadeAtual']);
$MontaCadastroUsuarioEndereco->CriaIntPais(0);

    $MontaCadastroUsuario->updateLoginUsuario($MontaCadastroUsuario );
    $RodacadastroUsuario->updateEmailUsuario($MontaCadastroUsuario, $_SESSION['TipoUsuario'] );
    $RodacadastroUsuario->deleteSiteUsuario( $_SESSION['idUsuario'], $_SESSION['TipoUsuario'] );
    $RodacadastroUsuario->insereSiteUsuario($MontaCadastroUsuario, $_SESSION['TipoUsuario']);
    $dadoUsuarioEndereco = $MontaCadastroUsuarioEndereco->PegaTodosDadosEnderecoUsuario($_SESSION['idUsuario'], $_SESSION['TipoUsuario']);

    #instrumentos que o cara toca
    $RodacadastroUsuario->deleteInstrumentosUsuario($_SESSION['idUsuario'], $_SESSION['TipoUsuario'] );
    $RodacadastroUsuario->insereInstrumentosUsuario($s, $v, $_SESSION['TipoUsuario'], 1 );

    #estilos que o cara gosta
    $RodacadastroUsuario->deleteEstiloMusicaUsuario($_SESSION['idUsuario'], $_SESSION['TipoUsuario']);
    $RodacadastroUsuario->insereEstilosUsuario( $s, $v, $_SESSION['TipoUsuario']);

        #dados relativos ao endereco sao obrigatorios para o modulo de regiao      
        $MontaCadastroUsuarioEndereco->updateEnderecoUsuario($MontaCadastroUsuarioEndereco, $_SESSION['TipoUsuario']);
        
        #TRECHO SOBRE DESATIVAR O CADASTRO E EXCLUIR OS ANUNCIOS, EVENTOS, CLASSIFICADOS
        if($dadoUsuario['ativo'] == 1 AND($_REQUEST['ativo'] == 0)){
          $MontaCadastroUsuario->DesativaCadastro($MontaCadastroUsuario );
          
          #PRECISO SABER A LISTA DE ALBUNS COM IMAGENS DOS USUARIOS DOS
          #BANDAS EXCLUIR BANDAS PERGUNTAR PRO FABIO?
          #ANUNCIO
          #CLASSIFICADOS
          #EVENTOS 
          #
          #? BANDA
          #unlink('view/images/u/a/'.$dadosAnuncioFoto[0]);
          #unlink('view/images/u/c/'.$dadosClassificadosFoto[0]);
          #unlink('view/images/u/e/'.$dadosEventoFoto[0]);
          
        }


/*
session_start();
 
require_once 'Connect.php';


$query="UPDATE
			tb_usuarios
		SET 
			NOME='" . $_POST['NOME'] . "',
			NOME_DO_MEIO='" . $_POST['NOME_DO_MEIO'] . "',
			SOBRENOME='" . $_POST['SOBRENOME'] . "'
		WHERE 
			ID_USUARIOS=" . $_POST['id'];
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
*/
	
?>