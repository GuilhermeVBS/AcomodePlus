<?php
session_start();

include_once '../model/DAO/ImovelDAO.php';

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipoUsuario'] != 'administrador') {
    header("Location: ../view/login.php");
    exit;
}

// Valida o ID do imóvel
if (!isset($_GET['id_imovel']) || !is_numeric($_GET['id_imovel'])) {
    $_SESSION['mensagem'] = [
        'tipo' => 'erro',
        'conteudo' => 'ID do imóvel inválido.'
    ];
    header("Location: ../view/painelAdmin.php");
    exit;
}

$id_imovel = intval($_GET['id_imovel']);

// Se a ação foi confirmada, executa a rejeição do imóvel
if (isset($_GET['confirmado']) && $_GET['confirmado'] == 1) {
    $imovelDAO = new ImovelDAO();
    $resultado = $imovelDAO->rejeitarImovel($id_imovel);

    if ($resultado === true) {
        $_SESSION['mensagem'] = [
            'tipo' => 'sucesso',
            'conteudo' => 'Imóvel rejeitado com sucesso!'
        ];
    } else {
        $_SESSION['mensagem'] = [
            'tipo' => 'erro',
            'conteudo' => 'Erro ao rejeitar imóvel. Tente novamente.'
        ];
    }

    header("Location: ../view/painelAdmin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Confirmação</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
    Swal.fire({
        title: "Tem certeza?",
        text: "O imóvel não irá para o index",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, rejeitar!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redireciona para confirmar a rejeição
            window.location.replace(
                "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?id_imovel=<?= $id_imovel ?>&confirmado=1");
        } else {
            // Redireciona para o painel de administração
            window.location.replace('../view/painelAdmin.php');
        }
    });
    </script>
</body>

</html>