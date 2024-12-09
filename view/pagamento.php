<?php
session_start();
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';
include_once '../model/DAO/EnderecoDAO.php';
include_once '../model/DTO/EnderecoDTO.php';
include_once '../model/DAO/ImovelDAO.php';
include_once '../model/DTO/ImovelDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);

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

$faturaId = rand(100000, 999999);

$dataAtual = date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="../css/pagamento.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/form.css">
</head>

<script src="../js/form.js" defer></script>

<body>
    <header>
        <a href="../index.php">
            <div class="logo">
                <img src="../img/acomode+_redondo.png" alt="">
                <h1>Acomode+</h1>
                </img>
            </div>
        </a>
        <div class="perfil">

            <a style="margin-right:20px ;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>

        </div>

    </header>
    <nav>
        <a href="../index.php">Home</a>
    </nav>
    <div class="payment-container">
        <div class="billing-info">

            <h2>Fatura #<?php echo $faturaId; ?> (<?php echo $dataAtual; ?>)</h2>
            <div class="description">
                <strong>Descrição:</strong> Mensal Recorrente
            </div>
            <div class="total">
                <strong>Total a Pagar: </strong>
                <?php echo isset($imovel['precoImovel']) && is_numeric($imovel['precoImovel']) ? 'R$ ' . number_format($imovel['precoImovel'], 2, ',', '.') : 'Preço não disponível'; ?>
            </div>
        </div>


        <div class="form" style="max-width: 45vw;">
            <h2>Pagamento com Cartão</h2>

            <!-- Imagens dos bancos -->
            <div class="bank-logos">
                <img src="../img/elo.png" alt="Banco 1" class="bank-logo">
                <img src="../img/master.png" alt="Banco 2" class="bank-logo">
                <img src="../img/visa.png" alt="Banco 3" class="bank-logo">
            </div>

            <form action="../control/pagamentoControl.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_imovel" value="<?php echo $imovel['id_imovel']; ?>">
                <input type="hidden" name="id_endereco" value="<?php echo $endereco['id_endereco']; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">


                <div class="input-group">
                    <div class="input-box">
                        <label for="card-number">Número do Cartão</label>
                        <input type="text" name="numCard" placeholder="xxxx-xxxx-xxxx-xxxx"
                            pattern="\d{4}\-\d{4}\-\d{4}-\d{4}" maxlength="19" required
                            oninput="this.value = formatCardNumber(this.value)">
                    </div>
                    <div class="input-box">
                        <label for="card-name">Nome no Cartão</label>
                        <input type="text" name="nomeCard" placeholder="Nome do cartão" required
                            oninput="onlyLetters(event)">
                    </div>
                    <div class="input-box">
                        <label for="expiry-date">Data de Expiração</label>
                        <input type="month" name="dataExpCard" required>
                    </div>
                    <div class="input-box">
                        <label for="cvv">Código de Segurança</label>
                        <input type="text" name="codCard" placeholder="xxx" maxlength="3" required
                            oninput="onlyNumbers(event)">
                    </div>
                    <label for="payment-type">Tipo de Pagamento</label>

                    <div class="input-box" style="flex-direction: row ;">

                        <label style="padding-left: 20px;">Débito</label>
                        <input type="radio" name="tipoPaga" value="debito" required />
                        <label style="padding-left: 20px;">Crédito</label>
                        <input style="margin-bottom: 10px;" type="radio" name="tipoPaga" value="credito" required />
                    </div>

                </div>

                <div class="action-buttons">
                    <div class="upload-container">
                        <label>Carregar Contrato (PDF)</label>
                        <input type="file" name="contratoAluguel" id="contratoAluguel" accept="application/pdf" required>
                    </div>
                    <a href="../control/pagamentoControl.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"
                        style="text-decoration: none; color: #fff;">
                        <button class="submit-button">Efetuar Pagamento</button>
                    </a>


                </div>
                <a href="../view/contratoAluguel.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"
                    class="
                    btn-back">Voltar</a>
            </form>
        </div>
    </div>


    <footer class="footer">
        <div class=" footer-section logo-section">
            <img src="../img/acomode+_redondo.png" alt="Acomode Plus Logo" class="footer-logo">
        </div>
        <div class="footer-section">
            <h3>Siga-nos</h3>
            <a href="https://www.instagram.com/acomodeplus" target="_blank" class="social-link">
                <img src="../img/social.png" alt="Instagram" class="social-icon"> Instagram
            </a>
        </div>
        <div class="footer-section">
            <h3>Sobre nós</h3>
            <p>A Acomode Plus é dedicada a oferecer as melhores acomodações com excelência em serviço e atendimento ao
                cliente.</p>
        </div>
        <div class="footer-section">
            <h3>Informações de Contato</h3>
            <p>Email: <a href="mailto:acomodeplus.suporte@gmail.com">acomodeplus.suporte@gmail.com</a></p>
            <p>Telefone: <a href="tel:+556181318476">(61) 8131-8476</a></p>
        </div>
    </footer>

</body>

</html>