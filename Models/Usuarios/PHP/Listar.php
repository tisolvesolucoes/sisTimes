<?php
session_start();
ob_start();

require('../../../Controller/Registry.php');   
require('../../../Controller/conn.php');
require('../../../Controller/preProcessor.php');
require('../ClasseUsuarios.php');

$Usuario = new Usuario();
$RodacadastroUsuario = new RodaDados();

#fazer sistema unico de busca de dados, passando como fonte
$dadosUsuario = $vetor = $vetorFinal = $dadoUsuarioSite = $dadoUsuarioTelefone = $dadosBanda = array(); 

$TotalUsuarios = $Usuario->ContaTotalUsuarios();
$dadosUsuario[] = $Usuario->PegarTodosDadosUsuario($_SESSION['idUsuario'], $_SESSION['TipoUsuario'] );


sleep(1); 
/*
$result = mysql_query($sql); 
$cont = mysql_affected_rows($conexao); 
// Verifica se a consulta retornou linhas 
if ($cont > 0){ 
// Atribui o código HTML para montar uma tabela 
$tabela = "<table border='1'> <thead> <tr> <th>NOME</th></tr></thead><tbody> <tr>"; 
$return = "$tabela"; 
// Captura os dados da consulta e inseri na tabela HTML 

		<tr>
			<td class="nomeTime">João da Silva</td>
			<td>Brasileiro</td>
			<td>Meio-Campo</td>
			<td>27 anos</td>
			<td>XV de Piracicaba</td>
			<td class="icons">
				<a href="#" class="icoEdit" title="Editar"></a>
				<a href="#" class="icoDel" title="Excluir"></a>	
			</td>
		</tr>
		<tr class="color">
			<td class="nomeTime">João da Silva</td>
			<td>Brasileiro</td>
			<td>Meio-Campo</td>
			<td>27 anos</td>
			<td>XV de Piracicaba</td>
			<td class="icons">
				<a href="#" class="icoEdit" title="Editar"></a>
				<a href="#" class="icoDel" title="Excluir"></a>	
			</td>
		</tr>
		<tr>
			<td class="nomeTime">
				<input type="text" class="text" value="João da Silva" />
			</td>
			<td>
				<select class="min">
					<option>Brasileiro</option>
				</select>
			</td>
			<td>
				<select class="min">
					<option>Meio-Campo</option>
				</select>
			</td>
			<td>
				<input type="text" class="text" value="27 anos" />
			</td>
			<td>
				<select class="min">
					<option>XV de Piracicaba</option>
				</select>
			</td>
			<td class="icons">
				<a href="#" class="icoSave" title="Editar"></a>
				<a href="#" class="icoCancel" title="Excluir"></a>	
			</td>
		</tr>


    while ($linha = mysql_fetch_array($result)){ 
    $return.= "<td>" . utf8_encode($linha["TituloAlbumFotos"]) . "</td>"; 
    $return.= "</tr>"; 
    } 
    echo $return.="</tbody></table>"; 
    }
    else
    {
     // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário 
    echo "Não foram encontrados registros!"; 
    }
*/

?>