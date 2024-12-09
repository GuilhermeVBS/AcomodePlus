<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Imóvel</title>

    <!-- Incluindo o SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    require_once '../model/DAO/EnderecoDAO.php';
    require_once '../model/DAO/ImovelDAO.php';
    require_once '../model/DAO/ContratoImovelDAO.php';
    require_once '../model/DAO/ImgImovelDAO.php';
    require_once '../model/DAO/PagamentoDAO.php'; // DAO para pagamentos

    $id_endereco = $_GET['id_endereco'];
    $id_imovel = $_GET['id_imovel'];

    $imovelDAO = new ImovelDAO();
    $pagamentoDAO = new PagamentoDAO();
    $imgImovelDAO = new ImgImovelDAO();
    $contImovDAO = new ContratoImovelDAO();
    $enderecoDAO = new EnderecoDAO();

    // Busca o imóvel pelo ID
    $imovel = $imovelDAO->buscarImovelPorId($id_imovel);

    if ($imovel && $imovel['disponibilidade'] === 'disponível') {
        // Verifica se existem pagamentos relacionados ao imóvel
        $temPagamentos = $pagamentoDAO->verificarPagamentosPorImovel($id_imovel);

        if ($temPagamentos) {
            // Exclui os pagamentos relacionados
            $pagamentoExcluido = $pagamentoDAO->excluirPagamentosPorImovel($id_imovel);
            if (!$pagamentoExcluido) {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao excluir pagamentos!',
                    text: 'Tente novamente.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
                </script>";
                exit;
            }
        }

        // Prossegue com a exclusão das imagens, contrato, imóvel e endereço
        $imagensExcluidas = $imgImovelDAO->excluirImagensImovel($id_imovel);
        $contImovExcluido = $contImovDAO->excluirContratoImovel($id_imovel);
        $imovelExcluido = $imovelDAO->excluirImovel($id_imovel);
        $enderecoExcluido = $enderecoDAO->excluirEndereco($id_endereco);

        if ($imagensExcluidas && $contImovExcluido && $imovelExcluido && $enderecoExcluido) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Imóvel excluído com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../view/listarImoveis.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao excluir imóvel!',
                text: 'Tente novamente.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
            </script>";
        }
    } else {
        // Caso o imóvel não esteja disponível
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Imóvel não está disponível para exclusão, pois está sendo alugado.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../view/listarImoveis.php';
            });
            </script>";
    }
    ?>
</body>

</html>