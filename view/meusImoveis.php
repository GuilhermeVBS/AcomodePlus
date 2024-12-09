<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

include_once '../model/DAO/ImovelDAO.php';
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);


if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

$id_proprietario = $_SESSION['id_usuario'];
$imovelDAO = new ImovelDAO();
$meusImoveis = $imovelDAO->buscarImovelPorProprietario($id_proprietario);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/slider.js" defer></script>
    <title>Acomode+</title>
</head>

<body>
    <header>
        <a href="../index.php">
            <div class="logo">
                <img src="../img/acomode+_redondo.png" alt="" style="margin-right: 20px;">
                <h1>Acomode+</h1>
                </img>
            </div>
        </a>
        <div class="perfil">
            <?php if (isset($_SESSION['id_usuario'])): ?>
            <a style="margin-right:20px ;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>
            <?php else: ?>
            <a href="/login.php" style="margin-right:20px ;">Entrar</a>
            <?php endif; ?>
        </div>
    </header>

    <section class="featured-properties">
        <h2>Meus Imoveis Cadastrados </h2>
        <div class="properties-row">

            <?php foreach ($meusImoveis as $imovel): ?>
            <div class="property-card">

                <div class="slider" data-slider-id="<?php echo $imovel['id_imovel']; ?>">
                    <div class="list">
                        <?php
                            if (!empty($imovel['imagens'])):
                                foreach ($imovel['imagens'] as $imagem): ?>
                        <div class="item">
                            <img src="../img/uploadsImovel/<?php echo htmlspecialchars($imagem); ?>"
                                alt="<?php echo htmlspecialchars($imovel['descricaoImovel']); ?>">
                        </div>
                        <?php endforeach;

                            else: ?>
                        <div class="item">
                            <img src=" " alt="Imagem Indisponível">
                        </div>
                        <?php endif; ?>

                    </div>

                    <div class="buttons">
                        <button class="prev" onclick="previousImage(this)">&#10094;</button>
                        <button class="next" onclick="nextImage(this)">&#10095;</button>
                    </div>

                    <ul class="dots">
                        <?php for ($i = 0; $i < count($imovel['imagens']); $i++): ?>
                        <li class="<?php echo $i === 0 ? 'active' : ''; ?>"></li>
                        <?php endfor; ?>
                    </ul>
                </div>


                <a
                        href="anuncio.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $imovel['id_endereco']; ?>">
                        <h3><?php echo htmlspecialchars($imovel['titulo']); ?></h3>
                        <p><?php echo ($imovel['subtitulo']); ?></p>
                        <p>Preço: R$ <?php echo number_format($imovel['precoImovel'], 2, ',', '.'); ?>/mês</p>
                        <p><?php echo htmlspecialchars($imovel['areaImovel']); ?></p>
                    </a>
            </div>
            <?php endforeach; ?>

        </div>

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

    <script src="../js/slider.js"></script>
</body>

</html>