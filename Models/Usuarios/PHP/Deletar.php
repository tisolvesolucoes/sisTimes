<?php
session_start();
require_once 'Connect.php';


if(isset($_GET['id'])){
$id = $_GET['id'];
 
$query="delete from tb_usuarios where ID_USUARIOS='$id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
 
$result = $mysqli->affected_rows;
 
echo $json_response = json_encode($result);
}
?>