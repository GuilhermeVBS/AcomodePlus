<?php

include_once '../model/DAO/ImovelDAO.php';
include_once '../model/DTO/ImovelDTO.php';
include_once '../model/DAO/ContratoImovelDAO.php';
include_once '../model/DTO/ContratoImovelDTO.php';
include_once '../model/DAO/ImgImovelDAO.php';
include_once '../model/DTO/ImgImovelDTO.php';
include_once '../model/DAO/EnderecoDAO.php';
include_once '../model/DTO/EnderecoDTO.php';

$imovelDAO = new ImovelDAO();
$contratoImovDAO = new ContratoImovelDAO();
$enderecoDAO = new EnderecoDAO();
$imgImovelDAO = new ImgImovelDAO();

$todos = $imovelDAO->listarImoveis();

//echo '<pre>';
//var_dump($todos);