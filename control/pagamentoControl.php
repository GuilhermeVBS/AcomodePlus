<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Imóvel</title>

    <!-- Incluindo o SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    } else {
        die("Erro: Usuário não autenticado.");
    }

    include_once '../model/DAO/UsuarioDAO.php';
    include_once '../model/DTO/UsuarioDTO.php';
    include_once '../model/DTO/ImovelDTO.php';
    include_once '../model/DAO/ImovelDAO.php';
    include_once '../model/DAO/EnderecoDAO.php';
    include_once '../model/DTO/EnderecoDTO.php';
    include_once '../model/DTO/PagamentoDTO.php';
    include_once '../model/DAO/PagamentoDAO.php';
    include_once '../model/DTO/ContratoAluguelDTO.php';
    include_once '../model/DAO/ContratoAluguelDAO.php';

    $dataPaga = date('Y-m-d');

    $enderecoDAO = new EnderecoDAO();
    $imovelDAO = new ImovelDAO();


    if (isset($_POST['id_imovel']) && isset($_POST['id_endereco'])) {
        $id_imovel = $_POST['id_imovel'];
        $id_endereco = $_POST['id_endereco'];

        $imovel = $imovelDAO->buscarImovelPorId($id_imovel);
        if ($imovel) {
            $valorPaga = $imovel['precoImovel'];
        } else {
            die("Erro: Imóvel não encontrado.");
        }

        $endereco = $enderecoDAO->buscarEnderecoPorId($id_endereco);
    } else {
        echo "ID do imóvel ou do endereço não fornecido.";
        exit;
    }

    if (isset($_POST['tipoPaga'])) {
        $tipoPaga = $_POST['tipoPaga'];
    }

    if (isset($_POST['numCard'])) {
        $numCard = $_POST['numCard'];
    }

    if (isset($_POST['nomeCard'])) {
        $nomeCard = $_POST['nomeCard'];
    }

    if (isset($_POST['dataExpCard'])) {
        $dataExpCard = $_POST['dataExpCard'];
        $dataExpCardFormatada = date('m/Y', strtotime($dataExpCard));
    }

    if (isset($_POST['codCard'])) {
        $codCard = $_POST['codCard'];
    }

    $contratoAlugDAO = new ContratoAluguelDAO();
    $contratoAlug = $contratoAlugDAO->buscarContratoAluguelPorUsuario($id_usuario);

    // Salvando o contrato no banco de dados
    if (isset($_FILES['contratoAluguel']) && $_FILES['contratoAluguel']['error'] == 0) {
        $allowedMimeTypes = ['application/pdf'];
        $fileMimeType = mime_content_type($_FILES['contratoAluguel']['tmp_name']);

        if (in_array($fileMimeType, $allowedMimeTypes)) {
            $nomeArquivo = basename($_FILES['contratoAluguel']['name']);
            $destination = '../img/uploadsContrato/' . $nomeArquivo;

            if (move_uploaded_file($_FILES['contratoAluguel']['tmp_name'], $destination)) {
                // Criar o objeto DTO e salvar o contrato no banco
                $contratoAlugDTO = new ContratoAluguelDTO();
                $contratoAlugDTO->setIdUsuario($id_usuario);
                $contratoAlugDTO->setDataContAlug($dataPaga);
                $contratoAlugDTO->setNomeContAlug($nomeArquivo);

                $id_contAlug = $contratoAlugDAO->salvarContratoAluguel($contratoAlugDTO);

                if (!$id_contAlug) {
                    echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Erro ao salvar o contrato no banco de dados.',
                        icon: 'error'
                    }).then(() => {
                        window.history.back(); 
                    });
                </script>";
                    exit;
                }
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao salvar o arquivo do contrato.',
                    icon: 'error'
                }).then(() => {
                    window.history.back(); 
                });
            </script>";
                exit;
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Erro!',
                text: 'Somente arquivos PDF são permitidos.',
                icon: 'error'
            }).then(() => {
                window.history.back();
            });
        </script>";
            exit;
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Erro!',
            text: 'Nenhum arquivo de contrato enviado.',
            icon: 'error'
        }).then(() => {
            window.history.back(); 
        });
    </script>";
        exit;
    }

    // Criando o objeto PagamentoDTO após salvar o contrato com sucesso
    $pagamentoDTO = new PagamentoDTO();
    $pagamentoDTO->setIdUsuario($id_usuario);
    $pagamentoDTO->setIdImovel($id_imovel);
    $pagamentoDTO->setDataPagamento(date('Y-m-d'));
    $pagamentoDTO->setTipoPagamento($tipoPaga);
    $pagamentoDTO->setValorPagamento($valorPaga);
    $pagamentoDTO->setNumCard($numCard);
    $pagamentoDTO->setNomeCard($nomeCard);
    $pagamentoDTO->setDataExpCard($dataExpCard);
    $pagamentoDTO->setCodCard($codCard);
    $pagamentoDTO->setIdContratoAluguel($id_contAlug);  // Usando o ID do contrato salvo

    // Salvando o pagamento e retornando o ID gerado
    $pagamentoDAO = new PagamentoDAO();
    $id_pagamento = $pagamentoDAO->salvarPagamento($pagamentoDTO);

    if ($id_pagamento) {
        $imovelDAO->marcarImovelIndisponivel($id_imovel);

        echo "<script>
        Swal.fire({
            title: 'Sucesso!',
            text: 'Pagamento efetuado com sucesso!',
            icon: 'success'
        }).then(() => {
            window.location.href = '../view/comprovante.php?id_usuario=" . $_SESSION['id_usuario'] . "&id_imovel=" . $imovel['id_imovel'] . "&id_endereco=" . $endereco['id_endereco'] . "&id_pagamento=" . $id_pagamento . "';
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Erro!',
            text: 'Erro ao processar o pagamento.',
            icon: 'error'
        });
    </script>";
    }