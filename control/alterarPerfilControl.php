<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Usuário</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();
    require_once '../model/DTO/UsuarioDTO.php';
    require_once '../model/DAO/UsuarioDAO.php';

    if (
        isset($_POST['id_usuario']) && isset($_POST['tipoUsuario']) &&
        isset($_POST['nome']) && isset($_POST['dataNasc']) &&
        isset($_POST['cpf']) && isset($_POST['telefone']) &&
        isset($_POST['email']) && isset($_POST['senha'])
    ) {
        $id_usuario = $_POST['id_usuario'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $nome = $_POST['nome'];
        $dataNasc = $_POST['dataNasc'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuarioDTO = new UsuarioDTO();
        $usuarioDTO->setIdUsuario($id_usuario);
        $usuarioDTO->setTipoUsuario($tipoUsuario);
        $usuarioDTO->setNome($nome);
        $usuarioDTO->setDataNasc($dataNasc);
        $usuarioDTO->setCpf($cpf);
        $usuarioDTO->setTelefone($telefone);
        $usuarioDTO->setEmail($email);
        $usuarioDTO->setSenha($senha);

        $usuarioDAO = new UsuarioDAO();
        $sucesso = $usuarioDAO->alterarUsuario($usuarioDTO);

        if ($sucesso) {
            if (isset($_FILES['imgUsuario']) && $_FILES['imgUsuario']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($_FILES['imgUsuario']['name'], PATHINFO_EXTENSION));
                $novoNome = "perfil_" . $_SESSION['id_usuario'] . "." . $extensao;
                $diretorio = "../img/uploadsUsuario/";

                if (move_uploaded_file($_FILES['imgUsuario']['tmp_name'], $diretorio . $novoNome)) {
                    $usuarioDAO->atualizarImagemPerfil($_SESSION['id_usuario'], $novoNome);
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Erro ao fazer upload da imagem. Tente novamente.',
                            icon: 'error'
                        }).then(function() {
                            window.location.href = '../view/perfil.php?id_usuario=" . $_SESSION['id_usuario'] . "';
                        });
                    </script>";
                    exit();
                }
            }

            echo "<script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Perfil atualizado com sucesso!',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '../view/perfil.php?id_usuario=" . $_SESSION['id_usuario'] . "';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao atualizar o perfil. Tente novamente.',
                    icon: 'error'
                }).then(function() {
                    window.location.href = '../view/perfil.php';
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Erro!',
                text: 'Preencha todos os campos obrigatórios.',
                icon: 'error'
            }).then(function() {
                window.location.href = '../view/perfil.php';
            });
        </script>";
    }
    ?>
</body>

</html>