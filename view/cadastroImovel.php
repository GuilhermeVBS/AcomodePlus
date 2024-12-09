<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {

    header('Location: ../view/login.php');
    exit();
}
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
    <title>Cadastro</title>

</head>



<body>
    <script src="../js/form.js" defer></script>
    <script src="../js/buscarCep.js" defer></script>

    <div class="form">
        <div class="form-header">
            <h1>Cadastro - Imóvel</h1>
        </div>
        <form action="../control/imovelControl.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="proprietario">

            <h2>Endereço</h2>
            <div class="input-group">
                <div class="input-box">
                    <label>CEP:</label>
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
                        onblur="pesquisacep(this.value);" required pattern="\d{5}-\d{3}" maxlength="9" minlength="9"
                        placeholder="xxxxx-xxx" onblur="pesquisacep(this.value);" />
                </div>
                <div class="input-box">
                    <label>Estado:</label>
                    <select id="estados" name="estado">
                        <option value="Acre">AC - Acre</option>
                        <option value="Alagoas">AL - Alagoas</option>
                        <option value="Amapá">AP - Amapá</option>
                        <option value="Amazonas">AM - Amazonas</option>
                        <option value="Bahia">BA - Bahia</option>
                        <option value="Ceará">CE - Ceará</option>
                        <option value="Distrito Federal">DF - Distrito Federal</option>
                        <option value="Espírito Santo">ES - Espírito Santo</option>
                        <option value="Goiás">GO - Goiás</option>
                        <option value="Maranhão">MA - Maranhão</option>
                        <option value="Mato Grosso">MT - Mato Grosso</option>
                        <option value="Mato Grosso do Sul">MS - Mato Grosso do Sul</option>
                        <option value="Minas Gerais">MG - Minas Gerais</option>
                        <option value="Pará">PA - Pará</option>
                        <option value="Paraíba">PB - Paraíba</option>
                        <option value="Paraná">PR - Paraná</option>
                        <option value="Pernambuco">PE - Pernambuco</option>
                        <option value="Piauí">PI - Piauí</option>
                        <option value="Rio de Janeiro">RJ - Rio de Janeiro</option>
                        <option value="Rio Grande do Norte">RN - Rio Grande do Norte</option>
                        <option value="Rio Grande do Sul">RS - Rio Grande do Sul</option>
                        <option value="Rondônia">RO - Rondônia</option>
                        <option value="Roraima">RR - Roraima</option>
                        <option value="Santa Catarina">SC - Santa Catarina</option>
                        <option value="São Paulo">SP - São Paulo</option>
                        <option value="Sergipe">SE - Sergipe</option>
                        <option value="Tocantins">TO - Tocantins</option>
                    </select>
                </div>
                <div class="input-box">
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <label>Cidade:</label>
                    <input name="cidade" type="text" id="cidade" required placeholder="Cidade" maxlength="50" />
                </div>
               
                <div class="input-box">
                    <label>Bairro:</label>
                    <i class="icon bi bi-houses-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="bairro" type="text" id="bairro" required placeholder="Bairro" maxlength="50" />
                </div>
                <div class="input-box">
                    <label>Rua:</label>
                    <i class="icon bi bi-geo-alt-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="rua" type="text" id="rua" required placeholder="Nome / N° da Rua" maxlength="60" />
                </div>
                <div class="input-box">
                    <label>Casa:</label>
                    <i class="bi bi-house-door-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input name="casa" type="number" id="casa" required placeholder="N° da Casa / Apartamento" maxlength="4" />
                </div>

                <div class="input-box"> 
                    <label>Área do imóvel:</label>
                    <i class="bi bi-rulers" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="areaImovel" oninput="formatArea(event)" required placeholder="Área">
                </div>
                <div class="input-box">
                    <label>Aluguel Mensal do imovel:</label>
                    <i class="bi bi-currency-dollar" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="precoImovel" placeholder="0,00" />
                </div>
                <div class="input-box">
                    <label>Ponto de Referência:</label>
                    <i class="bi bi-broadcast-pin" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="referencia" placeholder="Ponto de referência">
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
                        placeholder="Digite o título do imóvel (ex: Casa com 3 quartos)" maxlength="100">
                </div>
                <div class="input-box" style="max-width: none;">
                    <label for="subtitulo">Subtítulo do Imóvel</label>
                    <i class="bi bi-card-heading" style="padding-top: 37px; padding-left: 25px;"></i>
                    <input type="text" id="subtitulo" name="subtitulo" required
                        placeholder="Digite o subtítulo do imóvel (ex: Ótima localização, perto de escolas)"
                        maxlength="150" style="font-size: 11.5px;">
                </div>
            </div>
            <div class="input-box">
                <label for="descricao">Descrição do Imóvel</label>
                <textarea id="descricaoImovel" name="descricaoImovel" required
                    style=" max-width:55vw; max-height: 150px; min-width:55vw; min-height: 200px;" required
                    maxlength="1000"
                    placeholder="Descreva os detalhes do imóvel (ex: número de quartos, banheiros, área, estado de conservação)"
                    maxlength="500px"></textarea>
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
                    <input type="file" id="contratoImovel" name="contratoImovel" accept="application/pdf" required>
                </div>
            </div>
            <button type="submit" class="submit-button">Cadastrar Imóvel</button>
        </form>
        <a href="../index.php" class="redirect-button" style="padding: 0.6rem; width: 80px;">Voltar</a>
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