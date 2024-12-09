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
    /* Define uma largura máxima */
    margin: 0 auto;
    /* Centraliza horizontalmente */
    padding: 20px;
    /* Adiciona um espaço interno */
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
            <h1 class="title">Contrato de Propriedade</h1>
            <p class="description">
                Este contrato de aluguel serve como uma formalização do acordo entre a Acomode+ e o locador do imovel,
                especificando direitos e deveres de ambas as partes durante o período de locação.
                Para facilitar, disponibilizamos o contrato em formato PDF para que seja lido e assinado antes da
                realização do cadastro. Após assinar, envie o PDF pela próxima página para que o anúncio do seu imóvel possa ser exibido no site, permitindo que os futuros clientes tenham acesso às condições do aluguel antes de
                finalizar o processo. Em caso de dúvidas, nossa equipe de atendimento está à disposição.
            </p>


            <div class="input-group">
                <button class="redirect-button" onclick="window.open('contratoView.php')">Visualizar Contrato</button>
                <a href="../docs/modeloContrato.pdf" class="redirect-button"
                    download="../docs/modeloContrato.pdf">Baixar Contrato</a>
            </div>
        </div>
    </main>
    <div class="redirect">
<a href="cadastroImovel.php"><button>Cadastrar Imóvel</button></a>
    </div>

    <footer class="footer" style="margin-top:7px;position: absolute; bottom: 0; width: 97.86vw;">
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