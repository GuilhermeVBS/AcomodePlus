<?php
session_start();
include '../control/listarUsuarioControl.php';
include_once '../model/DAO/UsuarioDAO.php';
include_once '../model/DTO/UsuarioDTO.php';

$id_usuario = $_SESSION['id_usuario'];
$usuarioDAO = new UsuarioDAO();
$imgUsuario = $usuarioDAO->buscarImagemPerfil($id_usuario);


// var_dump($todos);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuário</title>
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/listar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <section class="user-container">
        <table id="userTable" border="1px">
            <thead>
                <tr>
                    <th>Id do Usuário</th>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data Nascimento</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th colspan="2">Operações</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($todos as $t) { ?>
                <tr>
                    <td><?php echo $t['id_usuario']; ?></td>
                    <td><?php echo $t['tipoUsuario']; ?></td>
                    <td><?php echo $t['nome']; ?></td>
                    <td><?php echo $t['cpf']; ?></td>
                    <td>
                        <?php
                            $d = explode(" ", $t['dataNasc']);
                            $data = explode("-", $d[0]);
                            echo "$data[2]/$data[1]/$data[0]";
                            ?>
                    </td>
                    <td><?php echo $t['telefone']; ?></td>
                    <td><?php echo $t['email']; ?></td>
                    <td>
                        <button class="delete-btn"
                            onclick="confirmarExclusao(<?php echo $t['id_usuario']; ?>)">Excluir</button>
                    </td>
                    <td>
                        <a href="alterarUsuario.php?id_usuario=<?php echo $t['id_usuario']; ?>">
                            <button class="edit-btn">Alterar</button>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                </td>
            </tbody>
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

    <script>
    function confirmarExclusao(id_usuario) {
        Swal.fire({
            title: 'Tem certeza que deseja excluir este usuário?',
            text: 'Essa ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário confirmar, redireciona para a página de exclusão
                window.location.href = '../control/excluirUsuarioControl.php?id_usuario=' + id_usuario;
            }
        });
    }
    </script>
</body>

</html>