<?php

try {
    //tentar conectar ao banco
    $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $conexao = new PDO("mysql:host=localhost;dbname=acomodePlus", "root", "");
    echo "conexao realizada com sucesso";
} catch (PDOException $exe) {
    //captura o erro para tratamento
    echo "se chegou tem erro, mostre o erro: " . $exe->getMessage();
}
