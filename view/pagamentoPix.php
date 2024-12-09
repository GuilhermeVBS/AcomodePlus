<?php
session_start();
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PIX</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/pagamentoPix.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

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
            <a style="margin-right:20px;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>
        </div>
    </header>
    <nav>
        <a href="../index.php">Home</a>
    </nav>

    <section class="payment-container">
        <h2>Faça seu pagamento</h2>
        <div class="qr-code">
            <!-- Imagem do QR Code - coloque um link válido ou uma imagem de exemplo -->
            <img src="../img/Capturar.PNG" alt="QR Code PIX">
        </div>
        <div class="pix-code">
            <!-- Código PIX para ser exibido e copiado -->
            00020126330014BR.GOV.BCB.PIX0114+55119999999990202BR5912NOME DO CLIENTE6009SAO PAULO62070503***6304ABCD
        </div>
        <button class="btn-copy" onclick="copyPixCode()">Copiar Código PIX</button>
        <p id="copyMessage">Código copiado!</p>
        <br>
        <a href="../index.php" class="btn-back">Voltar para a Tela Inicial</a>
    </section>

    <footer class="footer">
        <div class="footer-section logo-section">
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

    <script src="../js/pagamento"></script>
</body>

</html>