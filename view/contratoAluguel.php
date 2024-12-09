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
    <title>Contrato de Aluguel</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/contrato.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<style>
.main-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}
</style>

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

    <main class="main-container">

        <div class="form" style="margin:40px 0;">
            <h1 class="title">Contrato de Aluguel</h1>
            <p class="description">
                Este contrato de aluguel formaliza o acordo entre a Acomode+ e o locatário, assegurando os direitos e
                deveres de ambas as partes durante o período de locação.
                O documento especifica as condições de uso do imóvel, valores, prazos e demais normas essenciais para a
                convivência harmônica e preservação do patrimônio.
                Aqui esta o contrato disponível para visualização e download no formato PDF. Em caso de dúvidas, entre
                em contato com nossa equipe de atendimento.
            </p>



            <div class="input-group">
                <button class="redirect-button" onclick="window.open('contratoView.php')">Visualizar Contrato</button>
                <a href="../docs/modeloContrato.pdf" class="redirect-button"
                    download="../docs/modeloContrato.pdf">Baixar Contrato</a>
            </div>

            <p class="description" style="margin-top: 30px;">
                Após a leitura do contrato, assine o contrato e o escaneie para reenviar
            </p>
            <a href="pagamento.php?id_imovel=<?php echo $imovel['id_imovel']; ?>&id_endereco=<?php echo $endereco['id_endereco']; ?>"
                style="text-decoration: none; color: #fff;">
                <button class="submit-button">
                    Pagar</button></a>
        </div>

    </main>

    <footer class="footer" style="position: absolute; bottom: 0; width: 97.86vw;">
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
            <p class="description" style="margin-top: 30px;">
                Por favor, leia atentamente, assine o contrato e o reenvie na próxima etapa.
            </p>
        </div>
        <div class="footer-section">
            <h3>Informações de Contato</h3>
            <p>Email: <a href="mailto:acomodeplus.suporte@gmail.com">acomodeplus.suporte@gmail.com</a></p>
            <p>Telefone: <a href="tel:+556181318476">(61) 8131-8476</a></p>
        </div>
    </footer>
</body>

</html>