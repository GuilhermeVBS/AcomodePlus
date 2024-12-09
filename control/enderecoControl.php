<?php

include_once '../model/DTO/EnderecoDTO.php';
include_once '../model/DAO/EnderecoDAO.php';

if (isset($_POST['cep'])) {
    $cep = $_POST['cep'];
}

if (isset($_POST['estado'])) {
    $estado = $_POST['estado'];
}

if (isset($_POST['cidade'])) {
    $cidade = $_POST['cidade'];
}

if (isset($_POST['bairro'])) {
    $bairro = $_POST['bairro'];
}

if (isset($_POST['rua'])) {
    $rua = $_POST['rua'];
}

if (isset($_POST['casa'])) {
    $casa = $_POST['casa'];
}

if (isset($_POST['referencia'])) {
    $referencia = $_POST['referencia'];
}

//var_dump($_POST);

$enderecoDTO = new EnderecoDTO();

$enderecoDTO->setCep($cep);
$enderecoDTO->setEstado($estado);
$enderecoDTO->setCidade($cidade);
$enderecoDTO->setBairro($bairro);
$enderecoDTO->setRua($rua);
$enderecoDTO->setCasa($casa);
$enderecoDTO->setReferencia($referencia);

// var_dump($enderecoDTO)

$EnderecoDAO = new EnderecoDAO();

$sucesso = $enderecoDAO->salvarEndereco($enderecoDTO);

echo "Endereco salvo com sucesso" . $sucesso;