<?php
require_once '../model/DTO/UsuarioDTO.php';
require_once '../model/DAO/UsuarioDAO.php';

$id_usuario = $_GET['id_usuario'];
//var_dump($id_usuario);

$usuarioDAO = new UsuarioDAO();

$retorno = $usuarioDAO->buscarUsuarioPorId($id_usuario);
//var_dump($retorno);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/style-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Editar Usuário</title>
</head>

<body>

    <div class="form" style="margin-top: 40px; margin-bottom: 20px;" enctype="multipart/form-data">
        <form action="../control/alterarUsuarioControl.php" method="post">
            <input type="hidden" name="id_usuario" value="<?php echo $retorno["id_usuario"]; ?>"><br>
            <input type="hidden" name="tipoUsuario" value="<?php echo $retorno["tipoUsuario"]; ?>"><br>


            <div class=" form-header">
                <h1>Editar Usuário</h1>
            </div>

            <div class="input-group" style="margin-top:20px; box-shadow: 0">
                <div class="input-box">
                    <label>Nome:</label>
                    <i class="bi bi-person-circle" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="nome" placeholder="Digite seu nome completo" required oninput="onNameInput(event)"
                        value="<?php echo $retorno["nome"]; ?>" />
                </div>
                <div class="input-box">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="dataNasc" required value="<?php echo $retorno["dataNasc"]; ?>" />
                </div>
                <div class="input-box">
                    <label>CPF:</label>
                    <i class="bi bi-person-vcard-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                        title="Informe o padrão correto: xxx.xxx.xxx-xx" required minlength="14" maxlength="14"
                        oninput="onCPFInput(event)" value="<?php echo $retorno["cpf"]; ?>" />
                </div>
                <div class="input-box">
                    <label>Número de Telefone:</label>
                    <i class="bi bi-telephone-plus-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="telefone" placeholder="(xx) xxxxx-xxxx" pattern="\(\d{2}\) \d{5}-\d{4}"
                        title="Informe o padrão correto: (xx) xxxxx-xxxx" required minlength="15" maxlength="15"
                        oninput="onPhoneInput(event)" value="<?php echo $retorno["telefone"]; ?>" />
                </div>
                <div class="input-box">
                    <label>Email:</label>
                    <i class="bi bi-envelope-at-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="email" name="email" placeholder="Informe o email" required
                        value="<?php echo $retorno["email"]; ?>" />
                </div>
                <div class="input-box">
                    <div class="input-box">
                        <label>Senha:</label>
                        <i class="bi bi-lock-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="password" name="senha" id="senha" placeholder="Informe a senha"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}"
                            title="A senha deve conter entre 8 e 16 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um caractere especial (@$!%*?&)."
                            required minlength="8" maxlength="16" value="<?php echo $retorno["senha"]; ?>"
                            disabled /><input type="hidden" name="senha" value="<?php echo $retorno["senha"]; ?>">
                    </div>
                </div>

            </div>
            <button type="submit" class="submit-button" value="Alterar">Alterar Usuário</button>
        </form>
        <a href="../index.php" class="redirect-button" style="padding: 0.6rem; width: 80px;">Voltar</a>
    </div>
</body>

</html>