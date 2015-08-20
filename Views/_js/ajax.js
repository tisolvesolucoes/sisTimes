/** * Função para criar um objeto XMLHTTPRequest */ 
function CriaRequest()
{ 
try{ 
request = new XMLHttpRequest(); 
}
catch
(IEAtual){ 
try{ request = new ActiveXObject("Msxml2.XMLHTTP"); 
}catch(IEAntigo){
    
try{ request = new ActiveXObject("Microsoft.XMLHTTP"); 
}
catch(falha){ request = false; } } } 
if (!request) 
    alert("Seu Navegador não suporta Ajax!"); 
else return request; 
} 

/** * Função para enviar os dados */ 

function enviarDadosTimes() {
"use strict";
var xmlreq = CriaRequest();
var NomeDoTime = document.getElementById("NomeDoTime").value;
var estado = document.getElementById("estado").options[document.getElementById("estado").selectedIndex].value;
var cidade = document.getElementById("cidade").options[document.getElementById("cidade").selectedIndex].value;
var divisao = document.getElementById("divisao").options[document.getElementById("divisao").selectedIndex].value;

    xmlreq.open("POST", "../../Models/Times/PHP/Adicionar.php", true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState === 4 && xmlreq.status === 200) {
            getDadosTimes(); //Recarrega dados após o envio dos dados
        }
    };
    xmlreq.send("NomeDoTime=" + NomeDoTime + "&estado=" + estado + "&cidade=" + cidade + "&divisao=" + divisao);
}

/**********************************************************************/

/** * Função para enviar os dados */ 

function editarDadosTimes(
        idTime,
        tdNomeTime, 
        tdEstadoTime,
        tdCidadeTime,
        tdDivisaoTime){
"use strict";
var xmlreq = CriaRequest();

//var res = tdNomeTime.split("|");
var NomeDoTime = tdNomeTime;
var idTime = idTime;
var estado = tdEstadoTime;
var cidade = tdCidadeTime;
var divisao = tdDivisaoTime;

    xmlreq.open("POST", "../../Models/Times/PHP/Update.php", true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState === 4 && xmlreq.status === 200) {
            getDadosTimes(); //Recarrega dados após o envio dos dados
        }
    };
    xmlreq.send("idTime=" +idTime+ "&NomeDoTime=" + NomeDoTime + "&estado=" + estado + "&cidade=" + cidade + "&divisao=" + divisao);
}



/*********************************************************************************/

function getDadosTimes(){

// Declaração de Variáveis 
var result = document.getElementById("Resultado"); 
var xmlreq = CriaRequest(); 
//Exibi a imagem de progresso 
result.innerHTML = '<img height="15px" width="200px" src="../_img/loading.gif"/>';
// Iniciar uma requisição 
xmlreq.open("GET", "../../Models/Times/PHP/Listar.php", true); 
// Atribui uma função para ser executada sempre que houver uma mudança de ado 
xmlreq.onreadystatechange = function(){ 
// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
    
if (xmlreq.readyState == 4) { 
// Verifica se o arquivo foi encontrado com sucesso 
if (xmlreq.status == 200) { 
result.innerHTML = xmlreq.responseText; 
}
else{
result.innerHTML = "Erro: " + xmlreq.statusText; } } }; 
xmlreq.send(null); 
}

/*******************************************************/


/** * Função para apagar os dados */ 
function apagaDadosTimes(id) {
"use strict";

var r = confirm('Tem cereteza que quer apagar o time? ');
if (r == true){
    var id;  
    var xmlreq = CriaRequest();
    
        xmlreq.open("POST", "../../Models/Times/PHP/Deletar.php", true);
        xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlreq.onreadystatechange = function () {
            if (xmlreq.readyState === 4 && xmlreq.status === 200) {
                getDadosTimes(); //Recarrega dados após o envio dos dados
            }
        };
        xmlreq.send("idTime=" + id);

    }
    else
    {
     return false;
    }


}

/**********************************************/
/** * Função para enviar os dados */ 

function enviarDadosJogadores() {
"use strict";

var xmlreq = CriaRequest();
var NomeDoJogador = document.getElementById("NomeDoJogador").value;
var txtIdade = document.getElementById("txtIdade").value;
var Nacionalidade = document.getElementById("Nacionalidade").options[document.getElementById("Nacionalidade").selectedIndex].value;
var posicao = document.getElementById("posicao").options[document.getElementById("posicao").selectedIndex].value;
var idTime = document.getElementById("idTime").options[document.getElementById("idTime").selectedIndex].value;

    xmlreq.open("POST", "../../Models/Jogadores/PHP/Adicionar.php", true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState === 4 && xmlreq.status === 200) {
            getDadosJogadores(); //Recarrega dados após o envio dos dados
        }
    };
    xmlreq.send("NomeDoJogador=" + NomeDoJogador+ "&txtIdade=" + txtIdade + "&posicao=" + posicao + "&Nacionalidade=" + Nacionalidade+ "&idTime=" + idTime);
}

/*********************************************************************************/
function getDadosJogadores(){

// Declaração de Variáveis 
var result = document.getElementById("Resultado"); 
var xmlreq = CriaRequest(); 
//Exibi a imagem de progresso 
result.innerHTML = '<img height="15px" width="200px" src="../_img/loading.gif"/>';
// Iniciar uma requisição 
xmlreq.open("GET", "../../Models/Jogadores/PHP/Listar.php", true); 
// Atribui uma função para ser executada sempre que houver uma mudança de ado 
xmlreq.onreadystatechange = function(){ 
// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
    
if (xmlreq.readyState == 4) { 
// Verifica se o arquivo foi encontrado com sucesso 
if (xmlreq.status == 200) { 
result.innerHTML = xmlreq.responseText; 
}
else{
result.innerHTML = "Erro: " + xmlreq.statusText; } } }; 
xmlreq.send(null); 
}


/*************************************/
/** * Função para apagar os dados */ 
function apagaDadosJogadores(id) {
"use strict";

var r = confirm('Tem cereteza que quer apagar o Jogador? ');
if (r == true){
    var id;  
    var xmlreq = CriaRequest();

        xmlreq.open("POST", "../../Models/Jogadores/PHP/Deletar.php", true);
        xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlreq.onreadystatechange = function () {
            if (xmlreq.readyState === 4 && xmlreq.status === 200) {
               getDadosJogadores(); //Recarrega dados após o envio dos dados
            }
        };
        
        xmlreq.send("idJogador=" + id);
    }
    else
    {
     return false;
    }


}
