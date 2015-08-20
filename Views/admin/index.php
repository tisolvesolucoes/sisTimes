<?php
include('../../Controller/header.php');
require('../../Controller/Registry.php');
require('../../Controller/conn.php');   
require('../../Controller/preProcessor.php');

    if($_REQUEST['sair'] == 1){
    $RodacadastroUsuario = new RodaDados();
    $RodacadastroUsuario->apagarSessoes();
    }

    if($_REQUEST['err'] == 1){
    ?>
    <script>alert(".. email ou senha nao encontrados!! =(")</script>    
    <?php
    }
?>
<link href="../_css/style.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>

<header>

<div class="banner01"></div>

</header>

<div class="container">    
    
    <h1>Bem vindo</h1>

	<div class="barForm barCad">
		<h2>Sistema de times</h2>                
                      <span id="errUsuario" class="errInput" style="background-color: chartreuse "></span>
<?php
if(!($_SESSION['idUsuario'])){
?>
        <form method="post" enctype="multipart/form-data" action="../../Controller/logarUsuario.php" class="formHome" onsubmit="return false" action="" id="frmCadastro" name="frmLogin" >                

          <div class="colF">
                  <label>Email:</label>
                  <input value="junior.netmaster@gmail.com" type="text" size="8" name="txtEmail" id="txtEmail" class="text"/>
          </div>

          <div class="colF">
                  <label>Senha:</label>
                  <input type="password"  value="123mudar" size="4" name="txtSenha" id="txtSenha" class="text"/>				
          </div>
          <div class="colF"> 
<input type="button" class="button" align="left" name="entrar" id="entrar" value="Logar" onclick="ValidarLogin();" /> 
                            
        </div>  <input type="hidden" name="enviaFormLogin" id="enviaFormLogin" value="1" >
    
                </form>
<?php
}
else
{
    include('../../Controller/head.php');
}
?>	        

        </div>

<footer>
	<div class="footer">
		<div class="container">
			<div class="col1">				


			</div>
			<div class="col2">
	
			</div>
			<div class="col3">
				
				Teste Desenvolvedor PHP <br /> Freead Comunicação 2015.
		
			</div>
		</div>
	</div>
</footer>
<!-- JS -->
<link href='http://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
</body>
</html>