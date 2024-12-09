<?php
session_start();

require_once '../model/DTO/UsuarioDTO.php';
require_once '../model/DAO/UsuarioDAO.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
}
//var_dump($id_usuario);

$usuarioDAO = new UsuarioDAO();
if (!empty($id_usuario)) {
    $retorno = $usuarioDAO->buscarUsuarioPorId($id_usuario);
}
$retorno = $usuarioDAO->buscarUsuarioPorId($id_usuario);
$imgUsuario = $retorno['imgUsuario'];


//var_dump($retorno);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
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
    </header>

    <nav>
        <a href="../index.php">Home</a>
    </nav>

    <section class="profile-container">
       

            <form action="../control/alterarPerfilControl.php" method="post" class="form" enctype="multipart/form-data"
                onsubmit="return validarSenha();">

                <input type="hidden" name="id_usuario" value="<?php echo $retorno["id_usuario"]; ?>"><br>
                <input type="hidden" name="tipoUsuario" value="<?php echo $retorno["tipoUsuario"]; ?>"><br>

                <div class="profile-image">
                    <img id="profilePic"
                        src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                        alt="Foto de perfil">

                    </div>
                    <div class="input-box">
                        <label>Alterar Imagem</label>
                        <input type="file" name="imgUsuario" id="imgUsuario" accept="image/*">
                    </div>
                <div class="input-group" style="margin-top:20px; box-shadow: 0">
                    <div class="input-box">
                        <label>Nome:</label>
                        <i class="bi bi-person-circle" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="text" name="nome" placeholder="Digite seu nome" required
                            value="<?php echo $retorno["nome"]; ?>" oninput="onNameInput(event)" disabled />
                        <input type="hidden" name="nome" value="<?php echo $retorno["nome"]; ?>">
                    </div>

                    <div class="input-box">
                        <label>Data de Nascimento:</label>
                        <input type="date" name="dataNasc" required disabled value="<?php echo $retorno["dataNasc"];
                            ?>" />
                        <input type="hidden" name="dataNasc" value="<?php echo $retorno["dataNasc"]; ?>">
                    </div>

                    <div class="input-box">
                        <label>CPF:</label>
                        <i class="bi bi-person-vcard-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                            title="Informe o padrão correto: xxx.xxx.xxx-xx" required minlength="14" maxlength="14"
                            value="<?php echo $retorno["cpf"]; ?>" oninput="onCPFInput(event)" disabled />
                        <input type="hidden" name="cpf" value="<?php echo $retorno["cpf"]; ?>">
                    </div>

                    <div class="input-box">
                        <label>Número de Telefone:</label>
                        <i class="bi bi-telephone-plus-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="text" name="telefone" placeholder="(xx) xxxxx-xxxx" pattern="\(\d{2}\) \d{5}-\d{4}"
                            title="Informe o padrão correto: (xx) xxxxx-xxxx" required minlength="15" maxlength="15"
                            value="<?php echo $retorno["telefone"]; ?>" oninput="onPhoneInput(event)" />
                    </div>

                    <div class="input-box">
                        <label>Email:</label>
                        <i class="bi bi-envelope-at-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="email" name="email" placeholder="Informe o email" value="<?php echo $retorno["email"]; ?>" required />
                    </div>


                    <div class="input-box">
                        <label>Trocar senha:</label>
                        <i class="bi bi-lock-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="password" name="senha" id="senha" placeholder="Informe a senha"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}"
                            title="A senha deve conter entre 8 e 16 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um caractere especial (@$!%*?&)."
                            required minlength="8" maxlength="16" value="<?php echo $retorno["senha"]; ?>" />
                    </div>


                    <div class="input-box">
                        <label>Confirme a senha:</label>
                        <i class="bi bi-lock-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="password" name="Confsenha" id="Confsenha" placeholder="Informe a senha"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}"
                            title="A senha deve conter entre 8 e 16 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um caractere especial (@$!%*?&)."
                            required minlength="8" maxlength="16" />

                    </div>
                </div>
                <button type="submit" class="submit-button">Salvar Alterações</button>
            </form>
      
    </section>

    <div class="logout">
        <a href="../control/logoutControl.php"><button>Encerrar Sessão</button></a>
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
    <script>
        function validarSenha() {
            var senha = document.getElementById("senha").value;
            var confSenha = document.getElementById("Confsenha").value;

            if (senha !== confSenha) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'As senhas não coincidem. Por favor, verifique.',
                    icon: 'error'
                });
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }
    </script>

</body>

</html>