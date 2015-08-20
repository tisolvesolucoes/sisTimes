<?php

// Instanciar uma conexão com PDO
$conn = new PDO(  
    'mysql:host=179.188.16.40;port=3306;dbname=freead5', 'freead5', 'free6768'
);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Armazenar essa instância no Registry
$registry = Registry::getInstance();
$registry->set('Connection', $conn);

?>