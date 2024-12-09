<?php
session_start();
include '../control/listarImoveisControl.php';
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);


//var_dump($todos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title>Editar Imóvel</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/listar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/slider.css">
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
            <a style="margin-right:20px ;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>
        </div>

    </header>
    <nav>
        <a href="../index.php">Home</a>
        <a href="painelAdmin.php">Controles do Administrador</a>
    </nav>

    <section class="user-container" style="max-width: 100vw;">
        <table border="1px">
            <tr>
                <th>Id do Imóvel</th>
                <th>Imagem</th>
                <th>Contrato</th>
                <th>Descrição</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Rua</th>
                <th>Situação</th>
                <th>Disponibilidade</th>
                <th colspan="3">Operações</th>
            </tr>

            <?php foreach ($todos as $t) { ?>
                <tr>
                    <td>
                        <?php echo $t['id_imovel']; ?>
                    </td>
                    <td>

                        <div class="slider" data-slider-id="<?php echo $t['id_imovel']; ?>"
                            style=" height: 300px; width: 250px; overflow: hidden; border-radius: 20px;">
                            <div class="list">
                                <?php
                                if (!empty($t['imagens'])):
                                    foreach ($t['imagens'] as $imagem):
                                        $caminhoImagem = '../img/uploadsImovel/' . $imagem; ?>
                                        <div class="item">
                                            <img style="height:300px; width: 250px;" src="<?php echo $caminhoImagem; ?>"
                                                alt="Imagem do Imóvel">
                                        </div>
                                    <?php endforeach;
                                else: ?>
                                    <div class="item">
                                        <img src=" " alt="Imagem indisponível">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="buttons">
                                <button class="prev" onclick="previousImage(this)">&#10094;</button>
                                <button class="next" onclick="nextImage(this)">&#10095;</button>
                            </div>

                            <ul class="dots">
                                <?php for ($i = 0; $i < count($t['imagens']); $i++): ?>
                                    <li class="dot <?php echo $i === 0 ? 'active' : ''; ?>"
                                        onclick="currentSlide(this, <?php echo $i; ?>)"
                                        style="height: 10px; margin: 0 5px; margin-bottom: 10px; display: inline-block;"></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </td>
                     
                     <td>
    <a href="viewContImov.php?id_Imovel=<?php echo $t['id_imovel']; ?>&id_contImov=<?php echo $t['id_contImov']; ?>">
        <button class="contrato-btn">Visualizar</button>
    </a>
</td>
                
                    <td>
                        <?php echo $t['descricaoImovel']; ?>
                    </td>
                    <td>
                        <?php echo $t['estado']; ?>
                    </td>
                    <td>
                        <?php echo $t['cep']; ?>
                    </td>
                    <td>
                        <?php echo $t['rua']; ?>
                    </td>
                    <td>
                        <?php echo $t['situacao']; ?>
                    </td>
                    <td>
                        <?php echo $t['disponibilidade']; ?>
                    </td>

                    <td>
                        <a
                            href="../control/confExcImovel.php?id_imovel=<?php echo $t['id_imovel']; ?>&id_endereco=<?php echo $t['id_endereco']; ?>&id_contratoImovel=<?php echo $t['id_contImov']?>">
                            <button class="delete-btn">Excluir</button>
                        </a>
                    </td>
                    <td>
                        <a
                            href="alterarImovel.php?id_imovel=<?php echo $t['id_imovel']; ?>&id_endereco=<?php echo $t['id_endereco']; ?>">
                            <button class=" edit-btn">Alterar</button>
                        </a>
                    </td>
                    <td>
                        <a
                            href="anuncio.php?id_imovel=<?php echo $t['id_imovel']; ?>&id_endereco=<?php echo $t['id_endereco']; ?>">
                            <button class="anuncio-btn">Anuncio</button>
                        </a>

                    </td>
                </tr>

            <?php } ?>
        </table>
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