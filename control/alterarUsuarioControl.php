<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    require_once '../model/DTO/UsuarioDTO.php';
    require_once '../model/DAO/UsuarioDAO.php';


    $nome = $_POST['nome'];
    $tipoUsuario = $_POST['tipoUsuario'];
    $cpf = $_POST['cpf'];
    $dataNasc = $_POST['dataNasc'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id_usuario = $_POST['id_usuario'];

    //var_dump($_POST);

    $usuarioDTO = new UsuarioDTO();

    $usuarioDTO->setIdUsuario($id_usuario);
    $usuarioDTO->setNome($nome);
    $usuarioDTO->setTipoUsuario($tipoUsuario);
    $usuarioDTO->setCpf($cpf);
    $usuarioDTO->setDataNasc($dataNasc);
    $usuarioDTO->setTelefone($telefone);
    $usuarioDTO->setEmail($email);
    $usuarioDTO->setSenha($senha);


    //var_dump($usuarioDTO);

    $usuarioDAO = new UsuarioDAO();

    $sucesso = $usuarioDAO->alterarUsuario($usuarioDTO);
    if ($sucesso) {
        echo "<script>
        Swal.fire({
            title: 'Sucesso!',
            text: 'Usuário atualizado com sucesso.',
            icon: 'success'
        }).then(function() {
            window.location.href = '../view/listarUsuarios.php';
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Erro!',
            text: 'Erro ao atualizar o usuário. Tente novamente.',
            icon: 'error'
        }).then(function() {
            window.location.href = '../view/listarUsuarios.php';
        });
    </script>";
    }
    ?>
</body>

</html>