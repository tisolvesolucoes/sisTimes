<?php
class Times{
    
private $IntId; 
private $StrNomeTime; 
private $StrEstado; 
private $StrCidade;
private $IntDivisao;
private $dtDataDeCadastro;
private $IntIdUsuario;
    
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
    public function PegarStrNomeTime(){
        return $this->StrNomeTime;
    }
    public function CriarStrNomeTime($StrNomeTime){
        $this->StrNomeTime = $StrNomeTime;
        return $this;
    }
/**************************************************************/    
     public function PegarStrEstado(){
        return $this->StrEstado;
    }
    public function CriarStrEstado($StrEstado){
        $this->StrEstado = $StrEstado;
        return $this;
    }
/**************************************************************/    
    public function PegarStrCidade(){
        return $this->StrCidade;
    }
    public function CriarStrCidade($StrCidade){
        $this->StrCidade = $StrCidade;
        return $this;
    }
/**************************************************************/      
    public function PegarIntDivisao(){
        return $this->IntDivisao;
    }
    public function CriarIntDivisao($IntDivisao){
        $this->IntDivisao = $IntDivisao;
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
    public function PegarIntIdUsuario(){
        return $this->IntIdUsuario;
    }
    public function CriarIntIdUsuario($IntIdUsuario){
        $this->IntIdUsuario = $IntIdUsuario;
        return $this;
    }
/**************************************************************/    
   
    public function PegarId(){
        $statement = $this->conn->query(
            'SELECT * FROM tb_times ORDER BY 1 DESC LIMIT 1'
        );
        return $this->processResultsId($statement);
    }
    private function processResultsId($statement) {
        $results = array();
        if($statement){
            $row = $statement->fetch(PDO::FETCH_OBJ);        
                $id = $row->idTime;
        }
        return $id;
    }    

    /******************************************************/
    public function PegarTimesIndex(){
    $statement = $this->conn->query(
    "SELECT
    *
    FROM 
    tb_times 
    ORDER BY 3 ASC");
    
        return $this->processResultsPegarTodosTimesIndex($statement);    
    }

    private function processResultsPegarTodosTimesIndex($statement){ 
      
    
      if($statement) {
        $t=0;
        $tb = '';
        $th = '<table class="tableCad" id="tblData">	
        <thead>
        <tr class="title">
        <th>Nome do Time</td>
        <th>Estado</th>
        <th>Cidade</th>
        <th>Divisão</th>
        </tr>
        </thead><tbody>';
         $tf = '</tbody></table>';
        
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
           $color =  $t % 2 == 0 ? " class='color'" : "";
            
           $tb .= '<tr '.$color.'>
			<td class="nomeTime">'.$row->NomeTime.'</td>
			<td>'.$row->Estado.'</td>
			<td>'.$row->Cidade.'</td>
			<td>'.$row->Divisao.'ª</td>
			</tr>';
                $t++;
            }
        }
        $Table = $th.$tb.$tf;
        return $Table;
    }

    
    
/******************************************************/
    public function PegarTimes(){
    $statement = $this->conn->query(
    "SELECT
    *
    FROM 
    tb_times 
    ORDER BY 3 ASC");
    
        return $this->processResultsPegarTodosTimes($statement);    
    }

    private function processResultsPegarTodosTimes($statement){ 
      
    
      if($statement) {
        $t=0;
        $tb = '';
        $th = '<table class="tableCad" id="tblData">	
        <thead>
        <tr class="title">
        <th>Nome do Time</td>
        <th>Estado</th>
        <th>Cidade</th>
        <th>Divisão</th>
        <th></th>
        </tr>
        </thead><tbody>';
         $tf = '</tbody></table>';
        
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
           $color =  $t % 2 == 0 ? " class='color'" : "";
            
           $tb .= '<tr '.$color.'>
			<td class="nomeTime">'.$row->NomeTime.'</td>
			<td>'.$row->Estado.'</td>
			<td>'.$row->Cidade.'</td>
			<td>'.$row->Divisao.'ª</td>
			<td class="icons">
<a href="javascript:void(0);" class="icoEdit" title="Editar" onclick="Edit('.$row->idTime.');">
<a href="javascript:void(0);" class="icoDel" title="Excluir" onclick="apagaDadosTimes('.$row->idTime.');">	

</td></tr>';
            
                $t++;
            }
        }
        $Table = $th.$tb.$tf;
        return $Table;
    }
    
/************************************************************************/     
    
     public function insereCadastroTimes(Times $Times){
        
            
         $this->conn->beginTransaction();
         
         try {  
             $stmt = $this->conn->prepare(
             'INSERT INTO 
              tb_times
             (idTime, NomeTime, Estado, Cidade, Divisao, 
             dataCadastro) 
             VALUES (:idTime, :NomeTime, :Estado, :Cidade, :Divisao, 
             :dataCadastro)'); 
             
            $dados = array(
            ':idTime' => $Times->PegarIntxId(),
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

    public function deletaCadastroTimes(Times $Times){
    $this->conn->beginTransaction();

    try{
    $stmt = $this->conn->prepare(
    'DELETE 
    FROM
    tb_times 
    WHERE idTime = :idTime');

      $dados = array(
      ':idTime' => $Times->PegarIntxId());
      
          $stmt->execute($dados);
          $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        } 
    }
/************************************************************************/ 

public function updateCadastroTimes(Times $Times){
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
            ':Divisao' => $Times->PegarIntDivisao());

        $stmt->execute($dados);
        $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    } 
    
/*************************************************************/    
    public function ContaTotalTimes(){
    $statement = $this->conn->query(
    "SELECT
    COUNT(idTimes) Total
    FROM
    tb_times");
       
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
class Object extends Times{

    public function __toString() {
        return basename( get_class( $this ) );
    }
}