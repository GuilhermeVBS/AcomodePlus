<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar usuario</title>

    <!-- Incluindo o SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    require_once '../model/DAO/EnderecoDAO.php';
    require_once '../model/DTO/EnderecoDTO.php';
    require_once '../model/DAO/ImovelDAO.php';
    require_once '../model/DTO/ImovelDTO.php';
    require_once '../model/DAO/ContratoImovelDAO.php';
    require_once '../model/DTO/ContratoImovelDTO.php';
    require_once '../model/DAO/ImgImovelDAO.php';
    require_once '../model/DTO/ImgImovelDTO.php';

    $id_endereco = $_GET['id_endereco'];
    $id_imovel = $_GET['id_imovel'];

    $enderecoDAO = new EnderecoDAO();
    $imovelDAO = new ImovelDAO();
    $contratoimovDAO = new ContratoImovelDAO();
    $imgImovelDAO = new ImgImovelDAO();

    $contrato = $contratoimovDAO->buscarContImovPorIdImovel($id_imovel);
    
    if ($contrato) {
        $id_contImov = $contrato['id_contImov'];
    } else {
        $id_contImov = null;
    }

    echo "<script>
        Swal.fire({
            title: 'Tem certeza que deseja excluir este imóvel?',
            text: 'Esta ação não pode ser desfeita!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Não, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário confirmar, realiza a exclusão
                var url = 'excluirImovelControl.php?id_endereco={$id_endereco}&id_imovel={$id_imovel}&id_contImov={$id_contImov}';
                window.location.href = url;
            } else {
                // Caso o usuário cancele, redireciona para a página de listagem de imóveis
                window.location.href = '../view/listarImoveis.php';
            }
        });
      </script>";
    ?>

</body>

</html>