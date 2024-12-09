<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aprovar Imóvel</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();

    include_once '../model/DAO/ImovelDAO.php';

    // Verifica se o usuário está logado e se é um administrador
    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipoUsuario'] != 'administrador') {
        header("Location: ../view/login.php");
        exit;
    }

    // Verifica se o id_imovel foi fornecido
    if (!isset($_GET['id_imovel'])) {
        echo "ID do imóvel não foi fornecido.";
        exit;
    }

    $id_imovel = $_GET['id_imovel'];

    $imovelDAO = new ImovelDAO();

    // Chama o método de aprovação do imóvel
    $resultado = $imovelDAO->aprovarImovel($id_imovel);

    if ($resultado) {
        echo "<script>
        Swal.fire({
            title: 'Sucesso!',
            text: 'O imóvel foi aprovado e redirecionado para a Página Inicial.',
            icon: 'success'
        }).then(function() {
            window.location.href = '../view/painelAdmin.php';
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Erro!',
            text: 'Erro ao aprovar imóvel. Tente novamente.',
            icon: 'error'
        }).then(function() {
            window.location.href = '../view/painelAdmin.php';
        });
    </script>";
    }
    ?>
</body>

</html>