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

    include_once '../model/DTO/ImovelDTO.php';
    include_once '../model/DAO/ImovelDAO.php';
    include_once '../model/DTO/ContratoImovelDTO.php';
    include_once '../model/DAO/ContratoImovelDAO.php';
    include_once '../model/DTO/ImgImovelDTO.php';
    include_once '../model/DAO/ImgImovelDAO.php';
    include_once '../model/DTO/EnderecoDTO.php';
    include_once '../model/DAO/EnderecoDAO.php';
    include_once '../model/DTO/UsuarioDTO.php';
    include_once '../model/DAO/UsuarioDAO.php';


    if (isset($_SESSION['id_usuario']) && $_SESSION['tipoUsuario'] !== 'inquilino') {
        $id_proprietario = $_SESSION['id_usuario'];
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscarUsuarioPorId($id_proprietario);
        if ($usuario) {
            $email = $usuario['email'];
            $telefone = $usuario['telefone'];
        } else {

            die("Erro: usuario não encontrado.");
        }
        if (isset($_POST['tipoImovel'])) {
            $tipoImovel = $_POST['tipoImovel'];
        }
        if (isset($_POST['areaImovel'])) {
            $areaImovel = $_POST['areaImovel'];
        }
        if (isset($_POST['descricaoImovel'])) {
            $descricaoImovel = $_POST['descricaoImovel'];
        }
        if (isset($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
        }
        if (isset($_POST['subtitulo'])) {
            $subtitulo = $_POST['subtitulo'];
        }
        if (isset($_POST['precoImovel'])) {
            $precoImovel = $_POST['precoImovel'];
        }

        if (isset($_POST['cep'])) {
            $cep = $_POST['cep'];
        }

        if (isset($_POST['estado'])) {
            $estado = $_POST['estado'];
        }

        if (isset($_POST['cidade'])) {
            $cidade = $_POST['cidade'];
        }

        if (isset($_POST['bairro'])) {
            $bairro = $_POST['bairro'];
        }

        if (isset($_POST['rua'])) {
            $rua = $_POST['rua'];
        }

        if (isset($_POST['casa'])) {
            $casa = $_POST['casa'];
        }

        if (isset($_POST['referencia'])) {
            $referencia = $_POST['referencia'];
        }
        $nomeContrato = 'Contrato_' . $titulo;


        $enderecoDTO = new EnderecoDTO();
        $enderecoDTO->setCep($cep);
        $enderecoDTO->setEstado($estado);
        $enderecoDTO->setCidade($cidade);
        $enderecoDTO->setBairro($bairro);
        $enderecoDTO->setRua($rua);
        $enderecoDTO->setCasa($casa);
        $enderecoDTO->setReferencia($referencia);

        $enderecoDAO = new EnderecoDAO();
        $id_endereco = $enderecoDAO->salvarEndereco($enderecoDTO);

        //  echo " ".$id_endereco;

        if (!empty($id_endereco)) {

            $imovelDTO = new ImovelDTO();
            $imovelDTO->setAreaImovel($areaImovel);
            $imovelDTO->setDescricaoImovel($descricaoImovel);
            $imovelDTO->setPrecoImovel($precoImovel);
            $imovelDTO->setTitulo($titulo);
            $imovelDTO->setSubtitulo($subtitulo);
            $imovelDTO->setEnderecoId($id_endereco);
            $imovelDTO->setIdProprietario($id_proprietario);
            $imovelDTO->setEmail($email);
            $imovelDTO->setTelefone($telefone);

            $imovelDAO = new ImovelDAO();

            $id_imovel = $imovelDAO->salvarImovel($imovelDTO);

            if ($id_imovel) {

                if (!empty($id_imovel)) {
                    if ($id_imovel) {
                        // Processar as imagens
                        if (isset($_FILES['imagensImovel']) && !empty($_FILES['imagensImovel']['name'][0])) {
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
                                    $imgImovelDAO = new ImgImovelDAO();
                                    $imgImovelDAO->salvarImagensImovel($imgImovelDTO);
                                } else {
                                    echo "<script>Swal.fire('Erro!', 'Erro ao salvar a imagem.', 'error');</script>";
                                }
                            }
                        }
                    
                        // Processar o contrato
                        if (isset($_FILES['contratoImovel']) && $_FILES['contratoImovel']['error'] == 0) {
                            $diretorioDestino = '../img/uploadsContImov/';
                            if (!is_dir($diretorioDestino)) {
                                mkdir($diretorioDestino, 0777, true);
                            }
                        
                            $nomeArquivo = $_FILES['contratoImovel']['name'];
                            $tmpName = $_FILES['contratoImovel']['tmp_name'];
                            $nomeArquivoSalvo = uniqid('contrato_', true) . '.pdf';
                            $caminhoDestino = $diretorioDestino . $nomeArquivoSalvo;
                        
                            if (move_uploaded_file($tmpName, $caminhoDestino)) {
                                // Cria um objeto ContratoImovelDTO para salvar o contrato no banco de dados
                                $contratoImovDTO = new ContratoImovelDTO();
                                $contratoImovDTO->setDataContImov(date('Y-m-d'));
                                $contratoImovDTO->setIdUsuario($id_proprietario);  // O id do usuário que está fazendo o upload
                                $contratoImovDTO->setIdImovel($id_imovel);  // O id do imóvel ao qual o contrato está associado
                                $contratoImovDTO->setNomeContImov($nomeArquivoSalvo);  // O nome do arquivo gerado para o contrato
                        
                                // Chama o método salvarContratoImovel da classe ContratoImovelDAO
                                $contratoImovDAO = new ContratoImovelDAO();
                                $id_contImov = $contratoImovDAO->salvarContratoImovel($contratoImovDTO);
                                if ($id_contImov) {
                                    echo "<script>Swal.fire('Sucesso!', 'Imóvel e contrato cadastrados com sucesso!', 'success').then(() => { window.location.href = '../index.php'; });</script>";
                                } else {
                                    echo "<script>Swal.fire('Erro!', 'Erro ao salvar o contrato.', 'error');</script>";
                                }
                            } else {
                                echo "<script>Swal.fire('Erro!', 'Erro ao mover o contrato para o diretório de destino.', 'error');</script>";
                            }
                        } else {
                            echo "<script>Swal.fire('Erro!', 'Nenhum contrato foi enviado.', 'error');</script>";
                        }
                    } else {
                        echo "<script>Swal.fire('Erro!', 'Erro ao cadastrar o imóvel.', 'error');</script>";
                    }

                }}}}
    ?>

</body>

</html>