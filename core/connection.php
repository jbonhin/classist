<?php

/* Criando uma nova conexão o base de dados. */
//$conn = new mysqli("127.0.0.1", "root", "", "classist");

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "classist";
$port = 3306;

try{
    // Conexão com a porta
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    // Conexão sem a porta
    $conn = new PDO("mysql:host={$host}; port={$port}; dbname={$dbname}; charset=utf8", $user, $pass);
    //echo "Conexão com banco de dados realizado com sucesso!";
}  catch(PDOException $err){
    die("Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $err->getMessage());
}
