<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imóvel</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();
    
    require_once '../model/DAO/ImovelDAO.php';
    require_once '../model/DTO/ImovelDTO.php';
    require_once '../model/DAO/ImgImovelDAO.php';
    require_once '../model/DTO/ImgImovelDTO.php';
    require_once '../model/DAO/EnderecoDAO.php';
    require_once '../model/DTO/EnderecoDTO.php';
    require_once '../model/DAO/ContratoImovelDAO.php';
    require_once '../model/DTO/ContratoImovelDTO.php';

    $imovelDAO = new ImovelDAO();
    $imgImovelDAO = new ImgImovelDAO();
    $enderecoDAO = new EnderecoDAO();
    $contratoDAO = new ContratoImovelDAO(); // Adicionado aqui

    $id_imovel = $_POST['id_imovel'];
    $id_endereco = $_POST['id_endereco'];
    $areaImovel = $_POST['areaImovel'];
    $descricaoImovel = $_POST['descricaoImovel'];
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $precoImovel = str_replace(',', '.', str_replace('.', '', $_POST['precoImovel']));
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $casa = $_POST['casa'];
    $referencia = $_POST['referencia'];

    $imovelDTO = new ImovelDTO();
    $imovelDTO->setIdImovel($id_imovel);
    $imovelDTO->setAreaImovel($areaImovel);
    $imovelDTO->setDescricaoImovel($descricaoImovel);
    $imovelDTO->setPrecoImovel($precoImovel);
    $imovelDTO->setTitulo($titulo);
    $imovelDTO->setSubtitulo($subtitulo);
    $imovelAlterado = $imovelDAO->alterarImovel($imovelDTO);

    $enderecoDTO = new EnderecoDTO();
    $enderecoDTO->setIdEndereco($id_endereco);
    $enderecoDTO->setCep($cep);
    $enderecoDTO->setEstado($estado);
    $enderecoDTO->setCidade($cidade);
    $enderecoDTO->setBairro($bairro);
    $enderecoDTO->setRua($rua);
    $enderecoDTO->setCasa($casa);
    $enderecoDTO->setReferencia($referencia);
    $enderecoAlterado = $enderecoDAO->alterarEndereco($enderecoDTO);

    if ($imovelAlterado && $enderecoAlterado) {
        // Upload das imagens
        if (isset($_FILES['imagensImovel']) && !empty($_FILES['imagensImovel']['name'][0])) {
            $imagensAntigas = $imgImovelDAO->buscarImagensPorImovel($id_imovel);
            foreach ($imagensAntigas as $imagem) {
                $caminhoImagemAntiga = '../img/uploadsImovel/' . $imagem['nomeImagem'];
                if (file_exists($caminhoImagemAntiga)) {
                    unlink($caminhoImagemAntiga);
                }
            }
            $imgImovelDAO->excluirImagensImovel($id_imovel);
            $files = $_FILES['imagensImovel'];
            $names = $files['name'];
            $tmp_name = $files['tmp_name'];
            foreach ($names as $index => $name) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $nomeImagem = uniqid() . '.' . $extension;
                if (move_uploaded_file($tmp_name[$index], '../img/uploadsImovel/' . $nomeImagem)) {
                    $imgImovelDTO = new ImgImovelDTO();
                    $imgImovelDTO->setIdImovel($id_imovel);
                    $imgImovelDTO->setNomeImagem($nomeImagem);
                    $imgImovelDAO->salvarImagensImovel($imgImovelDTO);
                }
            }
        }

        // Upload do contrato
        if (isset($_FILES['contratoImovel']) && $_FILES['contratoImovel']['error'] === 0) {
            $allowedMimeTypes = ['application/pdf'];
            $fileMimeType = mime_content_type($_FILES['contratoImovel']['tmp_name']);
            if (in_array($fileMimeType, $allowedMimeTypes)) {
                $nomeArquivo = uniqid() . '_' . basename($_FILES['contratoImovel']['name']);
                $destination = '../img/uploadsContImov/' . $nomeArquivo;
                if (move_uploaded_file($_FILES['contratoImovel']['tmp_name'], $destination)) {
                    $contratoDTO = new ContratoImovelDTO();
                    $contratoDTO->setDataContImov(date('Y-m-d'));
                    $contratoDTO->setNomeContImov($nomeArquivo);
                    $contratoDTO->setIdUsuario($_SESSION['id_usuario']);
                    $contratoDTO->setIdImovel($id_imovel);
                    $contratoDAO->salvarContratoImovel($contratoDTO);
                } else {
                    echo "<script>Swal.fire({title: 'Erro!', text: 'Erro ao salvar o contrato.', icon: 'error'});</script>";
                }
            } else {
                echo "<script>Swal.fire({title: 'Erro!', text: 'Apenas arquivos PDF são permitidos.', icon: 'error'});</script>";
                exit;
            }
        }

        $redirectUrl = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '../index.php';
        echo "<script>
        Swal.fire({
            title: 'Sucesso!',
            text: 'Alteração enviada para análise.',
            icon: 'success'
        }).then(function() {
            window.location.href = '$redirectUrl';
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Erro!',
            text: 'Erro ao alterar o imóvel. Tente novamente.',
            icon: 'error'
        }).then(function() {
            window.location.href = '../view/alterarImovel.php';
        });
    </script>";
    }
    ?>

</body>

</html>