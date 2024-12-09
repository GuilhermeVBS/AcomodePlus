<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    require_once '../model/DAO/UsuarioDAO.php';

    if (isset($_GET['id_usuario'])) {
        $id_usuario = $_GET['id_usuario'];

        $usuarioDAO = new UsuarioDAO();
        $sucesso = $usuarioDAO->excluirUsuario($id_usuario);

        if ($sucesso === true) {
            // Se a exclusão foi bem-sucedida
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Usuário excluído com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../view/listarUsuarios.php';
            });
          </script>";
        } else {
            // Se a exclusão não foi permitida (usuário com imóveis associados)
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: '{$sucesso}',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
          </script>";
        }
    }
    ?>

</body>

</html>