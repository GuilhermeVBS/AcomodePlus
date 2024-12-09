<?php
session_start();
include_once '../model/DTO/UsuarioDTO.php';
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/ImovelDTO.php';
include_once '../model/DAO/ImovelDAO.php';
include_once '../model/DTO/EnderecoDTO.php';
include_once '../model/DAO/EnderecoDAO.php';
include_once '../model/DTO/PagamentoDTO.php';
include_once '../model/DAO/PagamentoDAO.php';

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
}

$usuarioDAO = new UsuarioDAO();
if (!empty($id_usuario)) {
    $retorno = $usuarioDAO->buscarUsuarioPorId($id_usuario);
}


$enderecoDAO = new EnderecoDAO();
$imovelDAO = new ImovelDAO();
if (isset($_GET['id_imovel']) && isset($_GET['id_endereco'])) {
    $id_imovel = $_GET['id_imovel'];
    $id_endereco = $_GET['id_endereco'];
    //var_dump($_GET);

    $imovel = $imovelDAO->buscarImovelPorId($id_imovel);
    if ($imovel) {

        $endereco = $enderecoDAO->buscarEnderecoPorId($id_endereco);
        $usuario = $usuarioDAO->buscarUsuarioPorId($id_usuario);
    } else {
        echo "Imóvel não encontrado.";
        exit;
    }
} else {
    echo "ID do imóvel ou do endereço não fornecido.";
    exit;
}
if (isset($_GET['id_pagamento'])) {
    $id_pagamento = $_GET['id_pagamento'];
} else {
    echo "ID do pagamento não fornecido.";
    exit;
}
$pagamentoDAO = new PagamentoDAO();
$pagamento = $pagamentoDAO->buscarPagamentoPorId($id_pagamento);
if (!$pagamento) {
    echo "Pagamento não encontrado.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Pagamento</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/comprovante.css">
</head>

<body>
    <div class="comprovante-container">
        <div class="logo"><img src="../img/acomode+_redondo.png" alt="acomodeplus"></div>
        <header>
            <h1>Comprovante de Pagamento</h1>
            <p class="empresa-nome">Acomode Plus</p>
            <p class="empresa-slogan">Alugar é tão fácil quanto sonhar!</p>
        </header>
        <section class="info-section">
            <h2>Dados do Cliente</h2>
            <p><strong>Nome:</strong>
                <?php echo $retorno["nome"]; ?>
            </p>
            <p><strong>CPF:</strong> <?php echo $retorno["cpf"]; ?></p>
            <p><strong>Telefone:</strong> <?php echo $retorno["telefone"]; ?></p>
        </section>
        <section class="info-section">
            <h2>Dados do Imóvel</h2>
            <p>
                <strong>CEP: </strong><?php echo $endereco["cep"]; ?>
            </p>
            <p><strong>Endereço:</strong>
                <?php echo $endereco["estado"]; ?>,
                <?php echo $endereco["cidade"]; ?>,
                <?php echo $endereco["bairro"]; ?>,
                <?php echo $endereco["rua"]; ?>,
                <?php echo $endereco["casa"]; ?>
            </p>
            <strong>Valor do Aluguel:</strong>
            <?php echo isset($imovel['precoImovel']) && is_numeric($imovel['precoImovel']) ? 'R$ ' . number_format($imovel['precoImovel'], 2, ',', '.') : 'Preço não disponível'; ?>
            </p>
            <p><strong>Vencimento:</strong> <?php echo date('d/m/Y', strtotime('+1 month')); ?></p>
        </section>
        <section class="info-section">
            <h2>Dados da Empresa</h2>
            <p><strong>Nome:</strong> Acomode Plus</p>
            <p><strong>CNPJ:</strong> 42.463.670/0001-94</p>
            <p><strong>Telefone:</strong> (61) 98131-8476</p>
            <p><strong>E-mail:</strong> acomodeplus.suporte@gmail.com</p>
        </section>
        <section class="info-section">
            <h2>Dados do Pagamento</h2>
            <p><strong>Método:</strong> <?php echo ucfirst($pagamento["tipoPaga"]); ?>
            </p>
            <p><strong>ID da Transação:</strong> <?php echo ($pagamento["id_pagamento"]); ?>
            </p>
            </p>
            <p><strong>Data do Pagamento:</strong> <?php echo date('d/m/Y') ?></p>
            <p><strong>Status:</strong> Pago</p>
        </section>
        <footer>
            <button onclick="window.print()">Imprimir Comprovante</button>
            <a href="comprovante_pronto.html" download class="download-button"><button>Baixar Comprovante</button></a>
            <a href="../index.php" class="btn-back"><button>Voltar para Início</button></a>
        </footer>
    </div>

</body>

</html>