<?php

session_start();

require_once '../model/DAO/UsuarioDAO.php';
require_once '../model/DTO/UsuarioDTO.php';


if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];


    $usuarioDAO = new UsuarioDAO();

    $sucesso = $usuarioDAO->validarLogin($cpf, $senha);

    if ($sucesso) {

        $_SESSION['id_usuario'] = $sucesso['id_usuario'];
        $_SESSION['nome'] = $sucesso['nome'];
        $_SESSION['dataNasc'] = $sucesso['dataNasc'];
        $_SESSION['cpf'] = $sucesso['cpf'];
        $_SESSION['telefone'] = $sucesso['telefone'];
        $_SESSION['email'] = $sucesso['email'];
        $_SESSION['senha'] = $sucesso['senha'];
        $_SESSION['tipoUsuario'] = $sucesso['tipoUsuario'];
        $loginSucesso = true;
        $perfil = $_SESSION['tipoUsuario'];
    } else {
        $loginSucesso = false;
        $perfil = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Logado</title>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
</head>

<body>

    <script>
        <?php if ($loginSucesso): ?>
            Swal.fire({
                title: "Sucesso!",
                text: "Login realizado com sucesso!!",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    switch ("<?= $perfil ?>") {
                        case 'inquilino':
                            window.location.replace('../index.php');
                            break;
                        case 'administrador':
                            window.location.replace('../view/painelAdmin.php');
                            break;
                        case 'proprietario':
                            window.location.replace('../index.php');
                            break;
                    }
                }
            });
        <?php else: ?>
            Swal.fire({
                title: "Erro!",
                text: "Erro ao logar. Tente novamente.",
                icon: "error"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace('../view/login.php');
                }
            });
        <?php endif; ?>
    </script>

</body>

</html>