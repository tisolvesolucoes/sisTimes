<?php
class RodaDados{
    private $conn;
    public function __construct() {
        $registry = Registry::getInstance();
        $this->conn = $registry->get('Connection');
    }
    
public function SetCombo($dadoSysAdmin, $dados){

$TituloIndiceSysAdmin = array_keys($dadoSysAdmin);
#$TituloIndiceSys = array_keys($dados);
$intCounter = count($dadoSysAdmin[$TituloIndiceSysAdmin[0]]);

    for($i = 0; $i < $intCounter; $i++){
    ?>
<option      
      value="<?php echo $dadoSysAdmin[$TituloIndiceSysAdmin[0]][$i];?>" 
          <?php if($dadoSysAdmin[$TituloIndiceSysAdmin[0]][$i] == $dados)
          { 
            echo 'SELECTED'; 
          } ?> >
          <?php echo $dadoSysAdmin[$TituloIndiceSysAdmin[1]][$i+1]; ?></option> 
    <?php 
    }
}  

/******************************************************/
#
    #essa funcao pega os estados para encher o combo com estado
    #public function getAllDataEnderecoUf(){
    public function PegarTodosDadosSerie($ColunaRetorno, $ColunaRetorno1, $NomeTabela){
   
    $statement = $this->conn->query(
    "SELECT 
    ".$ColunaRetorno.", ".$ColunaRetorno1."
    FROM 
     ".$NomeTabela."
    ORDER BY 2");
      
        return $this->processResultsBuscaSerie($statement, $ColunaRetorno, $ColunaRetorno1);    
    }

    private function processResultsBuscaSerie($statement, $ColunaRetorno, $ColunaRetorno1){
        $dadoUsuarioBusca = array();

        if($statement){
        $t=0;    
            #$row = $statement->fetch(PDO::FETCH_OBJ);
            while($row = $statement->fetch(PDO::FETCH_OBJ)){
                $dadoUsuarioBusca[$ColunaRetorno][$t] = $row->$ColunaRetorno;          
                $dadoUsuarioBusca[$ColunaRetorno1][$t+1] = $row->$ColunaRetorno1;
                $t++;
            }
        }
        return $dadoUsuarioBusca;
    }



    public function apagarSessoes(){
    session_destroy();
    session_write_close(); 
    ?>
    <script>
    window.location.href='index.php';
    </script>       
    <?php
    
    }
}
?>
