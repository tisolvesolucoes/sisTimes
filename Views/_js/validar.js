
var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

function ValidarTimes(){
              
   if(document.frmCadastroTime.NomeDoTime.value==''){

        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o Nome do Time';
        document.frmCadastroTime.NomeDoTime.focus();
        return false;
    }
	else if(document.frmCadastroTime.estado.value==''){
        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o Estado';
        document.frmCadastroTime.estado.focus();
        return false;
    }
    else
    {  
        enviarDadosTimes();
    }
}


function ValidarJogadores(){
              
   if(document.frmCadastroJogador.NomeDoJogador.value==''){

        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o Nome do Jogador!';
        document.frmCadastroJogador.NomeDoJogador.focus();
        return false;
    }
	else if(document.frmCadastroJogador.txtIdade.value==''){
        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o campo Idade!';
        document.frmCadastroJogador.txtIdade.focus();
        return false;
    }
    else
    {  
        enviarDadosJogadores();
    }
}








function ValidarCadastroUpdate(){
              
   if(document.frmCadastro.txtLogin.value==''){
       alert('to aqui');
        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o campo Login';
        document.frmCadastro.txtLogin.focus();
        return false;
    }
	else if(document.frmCadastro.txtEmail.value==''){
        document.getElementById('err').innerHTML='';
        document.getElementById('err').innerHTML='Preencha o campo email';
        document.frmCadastro.txtEmail.focus();
        return false;
    }else if(!email.test(document.frmCadastro.txtEmail.value)){
        document.getElementById('err').innerHTML='';
        document.getElementById("err").innerHTML='E-mail inv&aacute;lido!.';
        document.frmCadastro.txtEmail.focus();
         return false;
	}
	
	else{

        document.frmCadastro.submit();
        return true;
    }
}



function ValidarLogin(){
    if(document.frmLogin.txtEmail.value==''){
        document.getElementById('errUsuario').innerHTML='';
        document.getElementById('errUsuario').innerHTML='Preencha o campo Email';
        document.frmLogin.txtEmail.focus();
        return false;
    }else if(document.frmLogin.txtSenha.value==''){
        document.getElementById('errUsuario').innerHTML='';
        document.getElementById('errUsuario').innerHTML='Preencha o campo Senha';
        document.frmLogin.txtSenha.focus();
    }else{

        document.frmLogin.submit();
    }
}
