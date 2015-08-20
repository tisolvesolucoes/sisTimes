<?php
class Usuario{
    
private $IntId; 
private $StrLogin; 
private $StrEmail; 
private $StrNome;
private $StrSobreNome;
private $dtDataDeNascimento;
private $StrSenha;
private $IntSexo;
private $dtAgora;
private $IntAtivo;

#estilo de musica do musico

private $ArrEstiloMusicaMusico;
    
#instrumentos tocados pelo musico

private $ArrInstrumentoTocadoMusico;
    
private $conn;

    public function __construct() {
        $registry = Registry::getInstance();
        $this->conn = $registry->get('Connection');
    }

   public function PegarIntxId(){
        return $this->IntId;
    }
   public function CriarIntxId($IntId){
        $this->IntId = $IntId;
        return $this;
    }
/**************************************************************/ 
    public function PegarStrLoginUsuario(){
        return $this->StrLogin;
    }
    public function CriarStrLoginUsuario($StrLogin){
        $this->StrLogin = $StrLogin;
        return $this;
    }
/**************************************************************/    
     public function PegarStrSenhaUsuario(){
        return $this->StrSenha;
    }
    public function CriarStrSenhaUsuario($StrSenha){
        $this->StrSenha = $StrSenha;
        return $this;
    }
/**************************************************************/    
    public function PegarStrEmailUsuario(){
        return $this->StrEmail;
    }
    public function CriarStrEmailUsuario($StrEmail){
        $this->StrEmail = $StrEmail;
        return $this;
    }
/**************************************************************/      
    public function PegarStrNomeUsuario(){
        return $this->StrNome;
    }
    public function CriarStrNomeUsuario($StrNome){
        $this->StrNome = $StrNome;
        return $this;
    }
/**************************************************************/    
    public function PegarIntSexoUsuario(){
        return $this->IntSexo;
    }
    public function CriarIntSexoUsuario($IntSexo){
        $this->IntSexo = $IntSexo;
        return $this;
    }
/**************************************************************/    
    public function PegarStrSobreNomeUsuario(){
        return $this->StrSobreNome;
    }
    public function CriarStrSobreNomeUsuario($StrSobreNome){
        $this->StrSobreNome = $StrSobreNome;
        return $this;
    }
/**************************************************************/    
    public function PegardTDataDeNascimentoUsuario(){
        return $this->dtDataDeNascimento;
    }
    public function CriardTDataDeNascimentoUsuario($dtDataDeNascimento){
        $this->dtDataDeNascimento = $dtDataDeNascimento;
        return $this;
    }
/**************************************************************/   
    public function PegardTAgora(){
        return $this->dTAgora;
    }
    
    public function CriardTAgora($dtAgora){
        $this->dtAgora = $dtAgora;
        return $this;
    }
/**************************************************************/    
    public function PegarIntAtivo(){
        return $this->IntAtivo;
    }
    
    public function CriarIntAtivo($IntAtivo){
        $this->IntAtivo = $IntAtivo;
        return $this;
    }   

/**************************************************************/  
    
    public function PegarIntIdUsuario($MontaLoginUsuario){
        $statement = $this->conn->query("SELECT
        idUsuario
        FROM 
        tb_usuarios 
        WHERE
        senha = '".$MontaLoginUsuario->PegarStrSenhaUsuario()."'
        AND (email = '".$MontaLoginUsuario->PegarStrEmailUsuario()."')");     
        return $this->processResultsIdUser($statement);
    }

    private function processResultsIdUser($statement) {
        $results = array();
        if($row = $statement->fetch(PDO::FETCH_OBJ)){
                $_SESSION['idUsuario'] = $results[0] = $_SESSION['xId'] = $row->idUsuario;
             
        }
        return $results;
    }

/******************************************************/    
#2-
#essa funcao apos receber o o nome da tabela e o campo como parametros 
#que virao de um if para saber o que ele quer ver
#pega o ultimo id e devolve para fazer um novo insert e usar id em outras construcoes
#public function getId($campo, $tab){
    public function PegarId(){
        $statement = $this->conn->query(
            'SELECT * FROM tb_usuarios ORDER BY 1 DESC LIMIT 1'
        );
        return $this->processResultsId($statement);
    }
    private function processResultsId($statement) {
        $results = array();
        if($statement){
            $row = $statement->fetch(PDO::FETCH_OBJ);        
                $id = $row->idUsuario;
        }
        return $id;
    }    
        
/******************************************************/
    #3-
    #essa funcao apos receber o id do usuario como parametro pega os dados da tabela
    #public function getAllDataUsers($idUsuario, $tipoStatus){
    public function PegarTodosDadosUsuarios($idUsuario){
    $statement = $this->conn->query(
    "SELECT
    tb_usuarios.*
    FROM 
    tb_usuarios 
    WHERE
    idUsuario = $idUsuario");
        return $this->processResults($statement);    
    }

    private function processResults($statement){
        $dadoUsuario = array();

        if($statement){
            $row = $statement->fetch(PDO::FETCH_OBJ);
    
        $dadoUsuario['login'] = $_SESSION['login'] = $row->login;          
        $dadoUsuario['email'] = $row->email;  
        $dadoUsuario['Nome'] = $row->Nome;  
        $dadoUsuario['SobreNome'] = $row->SobreNome;  
        $dadoUsuario['senha'] = $row->senha;  
        $dadoUsuario['dataDeNascimento'] = $row->dataDeNascimento;
        $dadoUsuario['dataDeNascimentoCerto'] = explode("-", $row->dataDeNascimento);
        $dadoUsuario['dtDiaNascimento'] = $dadoUsuario['dataDeNascimentoCerto'][2];
        $dadoUsuario['dtMesNascimento'] = $dadoUsuario['dataDeNascimentoCerto'][1];
        $dadoUsuario['dtAnoNascimento'] = $dadoUsuario['dataDeNascimentoCerto'][0];
        $dadoUsuario['sexo'] = $row->sexo;
        $dadoUsuario['sexoView'] = $row->sexo == 1 ? "Masculino":"Feminino";
        $dadoUsuario['ativo'] = $row->ativo;
        $dadoUsuario['ativoView'] = $row->ativo == 1 ? "Sim":"Nao";          
        }
        return $dadoUsuario;
    }    
/**************************************************************/  

     public function insereCadastroUsuario(Usuario $Usuario){
        $this->conn->beginTransaction();
        try {  
             $stmt = $this->conn->prepare(
             'INSERT INTO 
              tb_usuarios
             (idUsuario, login, Nome, senha, dataDeNascimento, 
             dataCadastro, sexo) 
             VALUES (:idUsuario, :login, :nome, :senha, 
             :dataDeNascimento, :agora, :sexo)'); 
             
            $dados = array(
            ':idUsuario' => $Usuario->PegarIntxId(),
            ':login' => $Usuario->PegarStrLoginUsuario(),
            ':nome' => $Usuario->PegarStrNomeUsuario(),
            ':senha' => $Usuario->PegarStrSenhaUsuario(),
            ':dataDeNascimento' => $Usuario->PegardTDataDeNascimentoUsuario(),            
            ':agora' => date('Y-m-d H:i:s'),
            ':sexo' => $Usuario->PegarIntSexoUsuario());
            
            $stmt->execute($dados);
            $this->conn->commit();
            
            $_SESSION['idUsuario'] = $_SESSION['xId'] = $Usuario->PegarIntxId();
            
      
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }
/************************************************************************/ 

public function updateLoginUsuario(Usuario $Usuario){
    $this->conn->beginTransaction();

    try{
    $stmt = $this->conn->prepare(
    'UPDATE 
    tb_usuarios 
    SET 
    login=:login, 
    Nome=:Nome,
    SobreNome=:SobreNome,
    senha=:senha,
    sexo=:sexo,
    dataDeNascimento=:dataDeNascimento,
    dataAtualizacao=:dataAtualizacao,
    ativo=:ativo
    WHERE idUsuario = :idUsuario');

      $dados = array(
      ':login' => $Usuario->PegarStrLoginUsuario(),
      ':idUsuario' => $Usuario->PegarIntxId(),
      ':Nome' => $Usuario->PegarStrNomeUsuario(),
      ':SobreNome' => $Usuario->PegarStrSobreNomeUsuario(),
      ':senha' => $Usuario->PegarStrSenhaUsuario(),
      ':sexo' => $Usuario->PegarIntSexoUsuario(),
      ':dataDeNascimento' => $Usuario->PegardTDataDeNascimentoUsuario(),
      ':dataAtualizacao' => date('Y-m-d H:i:s'),
      ':ativo' => $Usuario->PegarIntAtivo());

        $stmt->execute($dados);
        $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }

    
/*************************************************************/          

#13
    ##essa funcao lista as bandas do usuario para encher o combo
    #public function PegarTodasBandasUsuario(){
    
    public function DesativaCadastro(Usuario $Usuario){

    $this->conn->beginTransaction();
    try{
    $stmt = $this->conn->prepare(
    'UPDATE 
    tb_usuarios 
    SET 
    ativo=:ativo
    WHERE idUsuario = :idUsuario');

      $dados = array(
      ':ativo' => $Usuario->PegarIntAtivo(),
      ':idUsuario' => $Usuario->PegarIntxId());

        $stmt->execute($dados);
        $this->conn->commit();
        }
        catch(Exception $e){
            $this->conn->rollback();
        }
        
        
    }
    
/*************************************************************/    
    #3
    #essa funcao traz os dados do anuncio do cara
    #public function PegarTodosDadosAnuncioUsuario($idUsuario){
    
    //QUE QUE O ANUNCIO TEM
    //DADOS PODE TER FOTO E VIDEO DO YOUTUBE
    public function ContaTotalUsuarios(){
    $statement = $this->conn->query(
    "SELECT
    COUNT(idUsuario) Total
    FROM
    tb_usuarios
    WHERE
    ativo = 1");
    
        #$statement->bindValue(':senha', $logarUsuario->PegarStrSenhaUsuario());
        #$statement->bindValue(':email', $logarUsuario->PegarStrEmailUsuario());   
        return $this->processResultsContaUsuarios($statement);    
    }

    private function processResultsContaUsuarios($statement){
       if($statement) {
        $row = $statement->fetch(PDO::FETCH_OBJ);
                $Total= $row->Total;
        return $Total;
    }    
}

/*************************************************************/
    
}

class Object extends usuario {

    public function __toString() {
        return basename( get_class( $this ) );
    }
}