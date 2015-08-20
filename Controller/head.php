<?php
if($_SESSION['idUsuario']){
?>	
<div class="header">
    <a href="index.php?sair=1">Sair</a>
    <div class="container">
        <nav>
            <ul class="menu">
                <li class="logo"><a href="index.php" title="COSMOS"><img src="../_img/logo.png" alt="Cosmos" /></a></li>
                <li class="link left"><a href="times.php" title="TIMES">TIMES</a></li>
                <li class="link left"><a href="jogadores.php" title="JOGADORES">JOGADORES</a></li>

<?php
}
?>
        
            </ul>
        </nav>
    </div> 
</div>
