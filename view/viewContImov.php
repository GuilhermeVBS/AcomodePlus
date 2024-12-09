<?php 
session_start();
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';
include_once '../model/DAO/ContratoImovelDAO.php';
include_once '../model/DTO/ContratoImovelDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);

if(isset($_GET['id_contImov'])){
    $id_contImov = $_GET['id_contImov'];
    $contratoImovDAO = new ContratoImovelDAO();
    
    $contratoImov = $contratoImovDAO->buscarContratoImovelPorId($id_contImov);

    if ($contratoImov) {
        $nomeArquivoSalvo = $contratoImov['nomeContImov'];
        $caminhoPDF = '../img/uploadsContImov/' . $nomeArquivoSalvo;  // Caminho do contrato
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Contrato</title>
</head>

<style>
.main-container {
    margin: 0 auto;
    padding: 20px;
}
</style>

<body style="margin: 0; padding: 0;">
    <header>
        <a href="../index.php">
            <div class="logo">
                <img src="../img/acomode+_redondo.png" alt="">
                <h1>Acomode+</h1>
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
        <a onclick="history.back()">Voltar
        </a>
        <a href="../index.php">Home</a>

    </nav>

    <div class="main-container" style="height: 100vh; width: 95vw;">
        <?php if (isset($caminhoPDF)): ?>
            <div style="width: 100%; height: 80vh;">
                <embed src="<?php echo $caminhoPDF; ?>" width="100%" height="100%" type="application/pdf">
            </div>
        <?php else: ?>
            <p>Erro ao carregar o contrato.</p>
        <?php endif; ?>
       <?php 
} else {
    echo "ID do contrato não fornecido.";
    exit;
}?> 
    </div>

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

</body>

</html>
