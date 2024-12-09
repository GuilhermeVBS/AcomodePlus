<?php
session_start();

include_once '../model/DAO/ImovelDAO.php';
include_once '../model/DTO/ImovelDTO.php';
include_once '../model/DAO/ContratoImovelDAO.php';
include_once '../model/DTO/ContratoImovelDTO.php';
include_once '../model/DAO/EnderecoDAO.php';
include_once '../model/DTO/EnderecoDTO.php';
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $usuarioDAO = new UsuarioDAO();
    $imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);
}

$enderecoDAO = new EnderecoDAO();
$imovelDAO = new ImovelDAO();
$contratoImovDAO = new ContratoImovelDAO();

$imoveisEnd = [];

if (isset($_GET['id_imovel']) && isset($_GET['id_endereco'])) {
    $id_imovel = $_GET['id_imovel'];
    $id_endereco = $_GET['id_endereco'];
    //var_dump($_GET);

    $imovel = $imovelDAO->buscarImovelPorId($id_imovel);
    if ($imovel) {

        $endereco = $enderecoDAO->buscarEnderecoPorId($id_endereco);
        $contratoImov = $contratoImovDAO->buscarContImovPorIdImovel($id_imovel);

        $imoveisEnd[] = ['imovel' => $imovel, 'endereco' => $endereco];
    } else {
        echo "Imóvel não encontrado.";
        exit;
    }
} else {
    echo "ID do imóvel ou do endereço não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anúncio</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/anuncio.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="../js/slider.js" defer></script>
</head>

<style>
.main-container {
    max-width: 800px;
    margin: 0 auto;
    margin-bottom: 20px;
}
</style>

<body>
    <header>
        <a href="../index.php">
            <div class="logo">
                <img src="../img/acomode+_redondo.png" alt="">
                <h1>Acomode+</h1>
            </div>
        </a>
        <div class="perfil">
            <?php if (isset($_SESSION['id_usuario'])) : ?>
            <a style="margin-right:20px;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>
            <?php else: ?>
            <a href="login.php" style="margin-right:20px;">Entrar</a>
            <?php endif; ?>
        </div>
    </header>

    <nav>
        <a href="../index.php">Home</a>
        <?php if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 'administrador'): ?>
        <a href="painelAdmin.php">Controles do Administrador</a>
        <?php endif; ?>
    </nav>

    <section class="property-details">
        <?php foreach ($imoveisEnd as $item): ?>
        <h2> <?php echo $imovel['titulo'] ?></h2>
        <?php $imovel = $item['imovel']; ?>
        <?php $endereco = $item['endereco']; ?>
        <div class="property-card">
            <div class="main-container">
                <div class="slider" data-slider-id="<?php echo $imovel['id_imovel']; ?>"
                    style="width:800px; overflow: hidden; border-radius: 20px;">
                    <div class="list">
                        <?php if (!empty($imovel['imagens'])): ?>
                        <?php foreach ($imovel['imagens'] as $imagem): ?>
                        <div class="item">
                            <img style="height: 500px; width: 800px;"
                                src="../img/uploadsImovel/<?php echo htmlspecialchars($imagem); ?>"
                                alt="<?php echo htmlspecialchars($imovel['descricaoImovel']); ?>">
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div class="item">
                            <img src="" alt="Imagem Indisponível">
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
            </div>

            <p style="font-size: 24px; font-weight: bold;"><?php echo htmlspecialchars($imovel['subtitulo']); ?></p>
            <p>Descrição: <?php echo htmlspecialchars($imovel['descricaoImovel']); ?></p>
            <p class="color">Preço mensal: R$ <?php echo number_format($imovel['precoImovel'], 2, ',', '.'); ?></p>
            <p class="color">Área: <?php echo htmlspecialchars($imovel['areaImovel']); ?></p>
            <h3>Endereço</h3>
            <p>Estado: <?php echo htmlspecialchars($endereco['estado']); ?></p>
            <p>Cidade: <?php echo htmlspecialchars($endereco['cidade']); ?></p>
            <p>Bairro: <?php echo htmlspecialchars($endereco['bairro']); ?></p>
            <p>Rua: <?php echo htmlspecialchars($endereco['rua']); ?></p>
            <p>Casa: <?php echo htmlspecialchars($endereco['casa']); ?></p>
            <p>Ponto de Referência: <?php echo htmlspecialchars($endereco['referencia']); ?></p>

            

            <?php if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 'administrador'): ?>
            <p>Status: <?php echo htmlspecialchars($imovel['situacao']); ?></p>
            <a class="redirect-button"
                href="../control/aprovarImovelControl.php?id_imovel=<?php echo $imovel['id_imovel']; ?>">Aprovar</a>
            <a class="redirect-button"
                href="../control/rejeitarImovelControl.php?id_imovel=<?php echo $imovel['id_imovel']; ?>">Rejeitar</a>
            <a class="redirect-button"
                href="alterarImovel.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>">Detalhes</a>
            <a class="redirect-button"
                href="viewContImov.php?id_Imovel=<?php echo $imovel['id_imovel']; ?>&id_contImov=<?php echo $contratoImov['id_contImov']; ?>">
                Contrato de Propriedade
            </a>

            <?php elseif (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $imovel['id_proprietario']): ?>
            <p>Status: <?php echo htmlspecialchars($imovel['situacao']); ?></p>
            <?php if ($imovel['situacao'] == 'rejeitado'): ?>
            <a class="redirect-button"
                href="alterarImovel.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>">Alterar
                e Reenviar</a>
            <?php endif; ?>
            <?php elseif (isset($_SESSION['id_usuario'])): ?>
            <a class="redirect-button"
                href="contratoAluguel.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>">Alugar</a>
            <?php else: ?>

            <a class="redirect-button" href="login.php">Faça Login para Alugar este imóvel</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
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