<?php

session_start();

include_once '../model/DTO/UsuarioDTO.php';
include_once '../model/DAO/UsuarioDAO.php';

if (isset($_POST['nome'])) {
  $nome = $_POST['nome'];
}

if (isset($_POST['dataNasc'])) {
  $dataNasc = $_POST['dataNasc'];
}

if (isset($_POST['cpf'])) {
  $cpf = $_POST['cpf'];
}

if (isset($_POST['telefone'])) {
  $telefone = $_POST['telefone'];
}

if (isset($_POST['email'])) {
  $email = $_POST['email'];
}

if (isset($_POST['senha'])) {
  $senha = $_POST['senha'];
}

if (isset($_POST['tipoUsuario'])) {
  $tipoUsuario = $_POST['tipoUsuario'];
}

// var_dump($_POST);

$usuarioDTO = new UsuarioDTO();

$usuarioDTO->setNome($nome);
$usuarioDTO->setDataNasc($dataNasc);
$usuarioDTO->setCpf($cpf);
$usuarioDTO->setTelefone($telefone);
$usuarioDTO->setEmail($email);
$usuarioDTO->setSenha($senha);
$usuarioDTO->setTipoUsuario($tipoUsuario);

// var_dump($usuarioDTO);

$usuarioDAO = new UsuarioDAO();


$sucesso = $usuarioDAO->salvarUsuario($usuarioDTO);


if ($sucesso) {

  $_SESSION['id_usuario'] = $sucesso;
  $_SESSION['nome'] = $nome;
  $_SESSION['dataNasc'] = $dataNasc;
  $_SESSION['cpf'] = $cpf;
  $_SESSION['telefone'] = $telefone;
  $_SESSION['email'] = $email;
  $_SESSION['senha'] = $senha;
  $_SESSION['tipoUsuario'] = $tipoUsuario;
  $perfil = $_SESSION['tipoUsuario'];
  $cadastroSucesso = true;
} else {
  $cadastroSucesso = false;
  $perfil = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
</head>

<body>

  <script>
    <?php if ($cadastroSucesso): ?>
      Swal.fire({
        title: "Sucesso!",
        text: "Cadastro realizado com sucesso!!",
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
        text: "Erro ao cadastrar usuario. Tente novamente.",
        icon: "error"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('../view/cadastroUsuario.php'); // Redireciona para a página de login
        }
      });
    <?php endif; ?>
  </script>

</body>

</html>