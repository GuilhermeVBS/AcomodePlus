<?php
session_start();
require_once '../model/DTO/ImovelDTO.php';
require_once '../model/DAO/ImovelDAO.php';
require_once '../model/DTO/ContratoImovelDTO.php';
require_once '../model/DAO/ContratoImovelDAO.php';
require_once '../model/DTO/ImgImovelDTO.php';
require_once '../model/DAO/ImgImovelDAO.php';
require_once '../model/DTO/EnderecoDTO.php';
require_once '../model/DAO/EnderecoDAO.php';


$id_imovel = $_GET['id_imovel'];
$id_endereco = $_GET['id_endereco'];
// var_dump($_GET);

$imovelDAO = new ImovelDAO();
$enderecoDAO = new EnderecoDAO();

$imovel = $imovelDAO->buscarImovelPorId($id_imovel);
$endereco = $enderecoDAO->buscarEnderecoPorId($id_endereco);
//var_dump($imovel);
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/style-form.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../js/form.js" defer></script>
    <title>Detalhes do Imóvel</title>

</head>



<body>
    <script src="../js/form.js" defer></script>
    <script src="../js/buscarEndereco.js" defer></script>

    <div class="form">
        <div class="form-header">
            <h1>Detalhes do Imóvel</h1>
        </div>
        <form action=" ../control/alterarImovelControl.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_imovel" value="<?php echo $imovel["id_imovel"]; ?>"><br>
            <input type="hidden" name="id_endereco" value="<?php echo $endereco["id_endereco"]; ?>"><br>
            <input type="hidden" name="email" value="<?php echo $imovel["email"]; ?>"><br>
            <input type="hidden" name="telefone" value="<?php echo $imovel["telefone"]; ?>"><br>


            <h2>Endereço</h2>
            <div class="input-group">
                <div class="input-box">
                    <label>CEP:</label>
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="cep" type="text" id="cep" size="10" maxlength="9" onblur="pesquisacep(this.value);"
                        required pattern="\d{5}-\d{3}" maxlength="9" minlength="9" placeholder="xxxxx-xxx"
                        value="<?php echo $endereco["cep"]; ?>">
                </div>
                <div class="input-box">
                    <label>Estado:</label>
                    <select id="estado" name="estado">
                        <?php
                        $estados = [
                            "Acre" => "Acre",
                            "Alagoas" => "Alagoas",
                            "Amapá" => "Amapá",
                            "Amazonas" => "Amazonas",
                            "Bahia" => "Bahia",
                            "Ceará" => "Ceará",
                            "Distrito Federal" => "Distrito Federal",
                            "Espírito Santo" => "Espírito Santo",
                            "Goiás" => "Goiás",
                            "Maranhão" => "Maranhão",
                            "Mato Grosso" => "Mato Grosso",
                            "Mato Grosso do Sul" => "Mato Grosso do Sul",
                            "Minas Gerais" => "Minas Gerais",
                            "Pará" => "Pará",
                            "Paraíba" => "Paraíba",
                            "Paraná" => "Paraná",
                            "Pernambuco" => "Pernambuco",
                            "Piauí" => "Piauí",
                            "Rio de Janeiro" => "Rio de Janeiro",
                            "Rio Grande do Norte" => "Rio Grande do Norte",
                            "Rio Grande do Sul" => "Rio Grande do Sul",
                            "Rondônia" => "Rondônia",
                            "Roraima" => "Roraima",
                            "Santa Catarina" => "Santa Catarina",
                            "São Paulo" => "São Paulo",
                            "Sergipe" => "Sergipe",
                            "Tocantins" => "Tocantins"
                        ];

                        foreach ($estados as $sigla => $nome) {
                            $selected = ($endereco["estado"] == $sigla) ? "selected" : "";
                            echo "<option value=\"$sigla\" $selected>$sigla - $nome</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-box">
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <label>Cidade:</label>
                    <input name="cidade" type="text" id="cidade" required placeholder="Cidade" maxlength="50"
                        value="<?php echo $endereco["cidade"]; ?>">
                </div>

                <div class="input-box">
                    <label>Bairro:</label>
                    <i class="icon bi bi-houses-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="bairro" type="text" id="bairro" required placeholder="Bairro" maxlength="50"
                        value="<?php echo $endereco["bairro"]; ?>">
                </div>
                <div class="input-box">
                    <label>Rua:</label>
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="rua" type="text" id="rua" required placeholder="Nome / N° da Rua" maxlength="60"
                        value="<?php echo $endereco["rua"]; ?>">
                </div>
                <div class="input-box">
                    <label>Casa:</label>
                    <i class="bi bi-house-door-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="casa" type="number" id="casa" required placeholder="N° da Casa / Apartamento"
                        maxlength="4" value="<?php echo $endereco["casa"]; ?>">
                </div>


                <div class="input-box">
                    <label>Área do imóvel:</label>
                    <i class="bi bi-rulers" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="areaImovel" oninput="formatArea(event)" required placeholder="Área"
                        value="<?php echo $imovel["areaImovel"]; ?>">
                </div>
                <div class="input-box">
                    <label>Aluguel Mensal do imovel:</label>
                    <i class="bi bi-currency-dollar" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="precoImovel" placeholder="0,00"
                        value="<?php echo $imovel["precoImovel"]; ?>">
                </div>
                <div class="input-box">
                    <label>Ponto de Referência:</label>
                    <i class="bi bi-broadcast-pin" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="referencia" placeholder="Ponto de referência"
                        value="<?php echo $endereco["referencia"]; ?>">
                </div>
            </div>
            <div class="input-box">
            </div>
            <h2>Descrição</h2>

            <div class="input-group">
                <div class="input-box" style="max-width: none;">
                    <label for="titulo">Título do Imóvel</label>
                    <i class="bi bi-house-door" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" id="titulo" name="titulo" required
                        placeholder="Digite o título do imóvel (ex: Casa com 3 quartos)" maxlength="100"
                        value="<?php echo $imovel["titulo"]; ?>">
                </div>
                <div class="input-box" style="max-width: none;">
                    <label for="subtitulo">Subtítulo do Imóvel</label>
                    <i class="bi bi-card-heading" style="padding-top: 37px; padding-left: 25px;"></i>
                    <input type="text" id="subtitulo" name="subtitulo" required
                        placeholder="Digite o subtítulo do imóvel (ex: Ótima localização, perto de escolas)"
                        maxlength="150" style="font-size: 11.5px;" value="<?php echo $imovel["subtitulo"]; ?>">
                </div>
            </div>
            <div class="input-box">
                <label for="descricao">Descrição do Imóvel</label>
                <textarea id="descricaoImovel" name="descricaoImovel" required
                    style=" max-width:55vw; max-height: 150px; min-width:55vw; min-height: 100px;" required
                    maxlength="255"
                    placeholder="Descreva os detalhes do imóvel (ex: número de quartos, banheiros, área, estado de conservação)"
                    maxlength="500"><?php echo $imovel["descricaoImovel"]; ?></textarea>
            </div>
            <div class="input-group">
                <div class="input-box" style="max-width: none;">
                    <label>Imagens:</label>
                    <input type="file" name="imagensImovel[]" id="imagensImovel" multiple accept="image/*">
                    <span id="previewImagem"></span>
                </div>

                <div class="input-box" style="max-width: none;">
                    <label for="contratoImovel" class="description">envie o contrato com suas Informações em um arquivo
                        com formato PDF:</label>
                    <input type="file" id="contratoImovel" name="contratoImovel" accept="application/pdf" disabled>
                </div>
            </div>
            <button type="submit" class="submit-button">Alterar Imóvel</button>
        </form>
        <a onclick="history.back()" class="redirect-button" style="padding: 0.6rem; width: 80px; ">Voltar
        </a>
    </div>

    <script>
    const imagensImovel = document.getElementById('imagensImovel');

    const previewImagem = document.getElementById('previewImagem');

    imagensImovel.addEventListener("change", function(e) {

        previewImagem.innerHTML = " ";
        for (const arquivo of e.target.files) {
            console.log(arquivo);

            const imagemHTML =
                `<img src="${URL.createObjectURL(arquivo)}" alt="${arquivo.name}" style="max-width: 100px; margin: 10px;">`;

            previewImagem.insertAdjacentHTML("beforeend", imagemHTML)
        }

    });
    </script>
</body>

</html>