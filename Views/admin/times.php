<?php
include('../../Controller/header.php');
?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script> 
<link href="../_css/style.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-v0.2.js"></script>
<script type="text/javascript">
window.onload = function(){
new dgCidadesEstados(document.getElementById('estado'), document.getElementById('cidade'), true);
    getDadosTimes();
}

function Save(){
   //alert("save - "+idTime);
	var par = $(this).parent().parent(); 
	var tdNomeTime = par.children("td:nth-child(1)"); 
	var tdEstadoTime = par.children("td:nth-child(2)"); 
	var tdCidadeTime = par.children("td:nth-child(3)"); 
	var tdDivisaoTime = par.children("td:nth-child(4)"); 
        
        var tdButtons = par.children("td:nth-child(5)"); 
        
        tdNomeTime.html(tdNomeTime.children("input[type=text]").val()); 
	tdEstadoTime.html(tdEstadoTime.children("input[type=text]").val()); 
	tdCidadeTime.html(tdCidadeTime.children("input[type=text]").val());
        tdDivisaoTime.html(tdDivisaoTime.children("input[type=text]").val());
               
               
     /*       
      document.getElementById('txtNomeDoTime').value, 
              
        editarDadosTimes(
        tdNomeTime, 
        tdEstadoTime,
        tdCidadeTime,
        tdDivisaoTime);
        */
	tdButtons.html("<img src='../_img/edit_pencil.png' class='icoEdit' onclick='Edit();'/><img src='../_img/garbage_trash.png' class='icoDel'/>"); 
	$(".icoEdit").bind("click", Edit); 
	
}     
        
function Edit(idTime){ 
    
     //alert("edit - "+idTime);
    
	var par = $(this).parent().parent();  
	var tdNomeTime = par.children("td:nth-child(1)"); 
	var tdEstadoTime = par.children("td:nth-child(2)"); 
	var tdCidadeTime = par.children("td:nth-child(3)"); 
	var tdDivisaoTime = par.children("td:nth-child(4)");
        
        var tdButtons = par.children("td:nth-child(5)"); 
	
        tdNomeTime.html("<input type='text' name='txtNomeDoTime' id='txtNomeDoTime' value='"+tdNomeTime.html()+"'/>"); 
	tdEstadoTime.html("<input type='text' name='txtEstadoTime' id='txtEstadoTime' value='"+tdEstadoTime.html()+"'/>"); 
	tdCidadeTime.html("<input type='text' name='txtCidadeTime' id='txtCidadeTime' value='"+tdCidadeTime.html()+"'/>"); 
	tdDivisaoTime.html("<input type='text' name='txtDivisaoTime' id='txtDivisaoTime' value='"+tdDivisaoTime.html()+"'/>"); 
  
    tdButtons.html("<img src='../_img/save.png' class='btnSave' onclick='Save();'/>"); 
    
	$(".btnSave").bind('click', Save); 
	$(".icoEdit").bind('click', Edit); 
}

</script>

</head>
<body>

<header>

<div class="banner01"></div>

<?php
    include('../../Controller/head.php');
?>	        

</header>

<div class="container">

<h1>Times</h1>

<div class="barForm barCad">
    <h2>Cadastrar novo time:</h2>
    <span id="err" class="err" style="background-color: chartreuse "></span>
      <span id="loading"></span>
    <form method="post" target="_self" class="formHome" action="" id="frmCadastroTime" name="frmCadastroTime">
 <!--<form method="get" target="_blank" class="formHome" action="../../Models/Times/PHP/Adicionar.php" id="frmCadastroJogador" name="frmCadastroJogador">
 -->
     	
             <div class="colF">
                    <label>Nome do Time</label>
                    <input type="text" class="text" id="NomeDoTime" name="NomeDoTime"/>
            </div>

            <div class="colF">
                    <label>Estado</label>
                    
                    <select class="min" id="estado" name="estado"></select>
                   
            </div>

            <div class="colF">
                    <label>Cidade</label>
                <select id="cidade" name="cidade"></select>
            </div>

            <div class="colF last">
                    <label>Divisão</label>
                    <select style="width: 135px;" id="divisao" name="divisao">
                        <option value="1">1ª</option>
                        <option value="2">2ª</option>
                        <option value="3">3ª</option>
                        <option value="4">4ª</option>
                    </select>
            </div>
        <button onclick="ValidarTimes();" id="submit" class="button">Cadastrar</button>
       
    </form>

</div>
	
<div id="Resultado" style="float:left;"></div>

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