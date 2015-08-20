<?php
class Jogadores{

private $IntId;  
private $IntidTime; 
private $IntIdUsuario;
private $IntIdPosicao;
private $IntIdade;
private $StrNomeJogador;
private $StrNacionalidade;
private $dtDataDeCadastro;    
private $conn;

    public function __construct() {
        $registry = Registry::getInstance();
        $this->conn = $registry->get('Connection');
    }
/**************************************************************/ 
   public function PegarIntxId(){
        return $this->IntId;
    }
   public function CriarIntxId($IntId){
        $this->IntId = $IntId;
        return $this;
    }

/**************************************************************/ 
   public function PegarIntidTime(){
        return $this->IntidTime;
    }
   public function CriarIntidTime($IntidTime){
        $this->IntidTime = $IntidTime;
        return $this;
    }

/**************************************************************/   
        public function PegarIntIdUsuario(){
        return $this->IntIdUsuario;
    }
    public function CriarIntIdUsuario($IntIdUsuario){
        $this->IntIdUsuario = $IntIdUsuario;
        return $this;
    }
/**************************************************************/    
    public function PegarIntIdPosicao(){
        return $this->IntIdPosicao;
    }
    public function CriarIntIdPosicao($IntIdPosicao){
        $this->IntIdPosicao = $IntIdPosicao;
        return $this;
    }
/**************************************************************/    
    public function PegarIntIdade(){
        return $this->IntIdade;
    }
    public function CriarIntIdade($IntIdade){
        $this->IntIdade = $IntIdade;
        return $this;
    }
/**************************************************************/    
    public function PegarStrNomeJogador(){
        return $this->StrNomeJogador;
    }
    public function CriarStrNomeJogador($StrNomeJogador){
        $this->StrNomeJogador = $StrNomeJogador;
        return $this;
    }
/**************************************************************/      
    public function PegarStrNacionalidade(){
        return $this->StrNacionalidade;
    }
    public function CriarStrNacionalidade($StrNacionalidade){
        $this->StrNacionalidade = $StrNacionalidade;
        return $this;
    }
/**************************************************************/    
    public function PegardtDataDeCadastro(){
        return $this->dtDataDeCadastro;
    }
    public function CriardtDataDeCadastro($dtDataDeCadastro){
        $this->dtDataDeCadastro = $dtDataDeCadastro;
        return $this;
    }
/**************************************************************/    

    public function PegarId(){
        $statement = $this->conn->query(
            'SELECT * FROM tb_jogadores ORDER BY 1 DESC LIMIT 1'
        );
        return $this->processResultsId($statement);
    }
    private function processResultsId($statement) {
        $results = array();
        if($statement){
            $row = $statement->fetch(PDO::FETCH_OBJ);        
                $id = $row->idJogador;
        }
        return $id;
    }    

    
    
    
    /******************************************************/
    public function PegarJogadoresIndex(){
    $statement = $this->conn->query(
    "SELECT
    tb_jogadores.*, 
    tb_times.NomeTime, 
    tb_posicoes.posicao
    FROM 
    tb_jogadores 
    JOIN
    tb_times
    ON
    tb_jogadores.idTimeFK = tb_times.idTime
    JOIN
    tb_posicoes
    ON
    tb_posicoes.idPosicao = tb_jogadores.idPosicaoFK
    ORDER BY 6 ASC");
    
        return $this->processResultsPegarTodosTimesIndex($statement);    
    }

    private function processResultsPegarTodosTimesIndex($statement){ 
      
    
      if($statement) {
        $t=0;
        $tb = '';
        $th = '	<table class="tableCad">
		<tr class="title">
                <td>Nome</td>
                <td>Nacionalidade</td>
                <td>Posição</td>
                <td>Idade</td>
                <td>Time</td>
		</tr>';
         $tf = '</table>';
        
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
           $color =  $t % 2 == 0 ? " class='color'" : "";
            
           $tb .= '<tr '.$color.'>
			<td class="nomeTime">'.$row->NomeJogador.'</td>
			<td>'.$row->Nacionalidade.'</td>
			<td>'.$row->posicao.'</td>
			<td>'.$row->idade.'</td>
                        <td>'.$row->NomeTime.'</td>
		</tr>';
            
                $t++;
            }
        }
        $Table = $th.$tb.$tf;
        return $Table;
    }
    
/******************************************************/
    public function PegarJogadores(){
    $statement = $this->conn->query(
    "SELECT
    tb_jogadores.*, 
    tb_times.NomeTime, 
    tb_posicoes.posicao
    FROM 
    tb_jogadores 
    JOIN
    tb_times
    ON
    tb_jogadores.idTimeFK = tb_times.idTime
    JOIN
    tb_posicoes
    ON
    tb_posicoes.idPosicao = tb_jogadores.idPosicaoFK
    ORDER BY 6 ASC");
    
        return $this->processResultsPegarTodosTimes($statement);    
    }

    private function processResultsPegarTodosTimes($statement){ 
      
    
      if($statement) {
        $t=0;
        $tb = '';
        $th = '	<table class="tableCad">
		<tr class="title">
                <td>Nome</td>
                <td>Nacionalidade</td>
                <td>Posição</td>
                <td>Idade</td>
                <td>Time</td>
                <td></td>
		</tr>';
         $tf = '</table>';
        
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
           $color =  $t % 2 == 0 ? " class='color'" : "";
            
           $tb .= '<tr '.$color.'>
			<td class="nomeTime">'.$row->NomeJogador.'</td>
			<td>'.$row->Nacionalidade.'</td>
			<td>'.$row->posicao.'</td>
			<td>'.$row->idade.'</td>
                        <td>'.$row->NomeTime.'</td>
			<td class="icons">
                        <a href="javascript:void(0);" class="icoEdit" title="Editar" onclick="Edit('.$row->idJogador.');">
			<a href="javascript:void(0);" class="icoDel" title="Excluir" onclick="apagaDadosJogadores('.$row->idJogador.');">	
			</td>
		</tr>';
            
                $t++;
            }
        }
        $Table = $th.$tb.$tf;
        return $Table;
    }
    
/************************************************************************/         
     public function insereCadastroJogadores(Jogadores $Jogadores){
       
         $this->conn->beginTransaction();
         
         try {  
             $stmt = $this->conn->prepare(
             'INSERT INTO 
              tb_jogadores
             (idJogador, idTimeFK, idUsuarioFK, idPosicaoFK, idade, NomeJogador, Nacionalidade, 
             dataCadastro) 
             VALUES (:idJogador, 
             :idTimeFK, :idUsuarioFK, :idPosicaoFK, 
             :idade, :NomeJogador, :Nacionalidade, 
             :dataCadastro)'); 
             
            $dados = array(
            ':idJogador' => $Jogadores->PegarIntxId(),
            ':idTimeFK' => $Jogadores->PegarIntidTime(),    
            ':idUsuarioFK' => $Jogadores->PegarIntIdUsuario(),
            ':idPosicaoFK' => $Jogadores->PegarIntIdPosicao(),
            ':idade' => $Jogadores->PegarIntIdade(),
            ':NomeJogador' => $Jogadores->PegarStrNomeJogador(),
            ':Nacionalidade' => $Jogadores->PegarStrNacionalidade(),
            ':dataCadastro' => date('Y-m-d H:i:s'));
            
            $stmt->execute($dados);
            $this->conn->commit();
      
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }
    
 /*************************************************************/          

    public function deletaCadastroJogadores(Jogadores $Jogadores){
    $this->conn->beginTransaction();

    try{
    $stmt = $this->conn->prepare(
    'DELETE 
    FROM
    tb_jogadores 
    WHERE idJogador = :idJogador');

      $dados = array(
      ':idJogador' => $Jogadores->PegarIntxId());
      
          $stmt->execute($dados);
          $this->conn->commit();
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
    tb_times 
    SET 
    idTime=:idTime, 
    NomeTime=:NomeTime,
    Estado=:Estado,
    Cidade=:Cidade,
    divisao=:divisao
    WHERE idTime = :idTime');

            $dados = array(
            ':idTime' => $Times->PegarId(),
            ':NomeTime' => $Times->PegarStrNomeTime(),
            ':Estado' => $Times->PegarStrEstado(),
            ':Cidade' => $Times->PegarStrCidade(),
            ':Divisao' => $Times->PegarIntDivisao(),            
            ':dataCadastro' => date('Y-m-d H:i:s'));

        $stmt->execute($dados);
        $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }  
    
/*************************************************************/    
    public function ContaTotalJogadores(){
    $statement = $this->conn->query(
    "SELECT
    COUNT(idJogador) Total
    FROM
    tb_jogadores");
       
        return $this->processResultsContaTimes($statement);    
    }

    private function processResultsContaTimes($statement){
       if($statement) {
        $row = $statement->fetch(PDO::FETCH_OBJ);
                $Total= $row->Total;
        return $Total;
    }    
}

}
class Object extends Jogadores{

    public function __toString() {
        return basename( get_class( $this ) );
    }
}