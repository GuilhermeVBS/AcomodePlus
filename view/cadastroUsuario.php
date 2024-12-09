<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/style-form.css" />
    <title>Cadastro Usuario</title>
    <script src="../js/form.js" defer></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
</head>

<body>

    <div class="form" style="margin-top: 40px; margin-bottom: 20px;">
        <div class="form-header">
            <h1>Cadastre-se</h1>

            <a href="login.php" class="redirect-button">Entrar</a>
        </div>

        <form action="../control/usuarioControl.php" method="post" onsubmit="return validarSenha();">

            <div class="input-box" style="flex-direction: row; display: contents;">
                <label>Criar conta de:</label>
                <label style="padding-left: 20px;">Proprietário</label>
                <input type="radio" name="tipoUsuario" value="proprietario" required />
                <label style="padding-left: 20px;">Inquilino</label>
                <input style="margin-bottom: 10px;" type="radio" name="tipoUsuario" value="inquilino" required />
            </div>

            <div class="input-group" style="margin-top:20px; box-shadow: 0">
                <div class="input-box">
                    <label>Nome:</label>
                    <i class="bi bi-person-circle" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="nome" placeholder="Digite seu nome completo" required
                        oninput="onNameInput(event)" />
                </div>
                <div class="input-box">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="dataNasc" required />
                </div>
                <div class="input-box">
                    <label>CPF:</label>
                    <i class="bi bi-person-vcard-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                        title="Informe o padrão correto: xxx.xxx.xxx-xx" required minlength="14" maxlength="14"
                        oninput="onCPFInput(event)" />
                </div>
                <div class="input-box">
                    <label>Número de Telefone:</label>
                    <i class="bi bi-telephone-plus-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="text" name="telefone" placeholder="(xx) xxxxx-xxxx" pattern="\(\d{2}\) \d{5}-\d{4}"
                        title="Informe o padrão correto: (xx) xxxxx-xxxx" required minlength="15" maxlength="15"
                        oninput="onPhoneInput(event)" />
                </div>
                <div class="input-box">
                    <label>Email:</label>
                    <i class="bi bi-envelope-at-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="email" name="email" placeholder="Informe o email" required />
                </div>
                <div class="input-box">
                    <div class="input-box">
                        <label>Senha:</label>
                        <i class="bi bi-lock-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                        <input type="password" name="senha" id="senha" placeholder="Informe a senha"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}"
                            title="A senha deve conter entre 8 e 16 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um caractere especial (@$!%*?&)."
                            required minlength="8" maxlength="16" />
                    </div>
                </div>
                <div class="input-box">
                    <label>Confirmar Senha:</label>
                    <i class="bi bi-lock-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                    <input type="password" name="Confsenha" id="Confsenha" placeholder="Informe a senha" style="max-width:415px ;"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}"
                        title="A senha deve conter entre 8 e 16 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um caractere especial (@$!%*?&)."
                        required minlength="8" maxlength="16" />
                </div>
                <div class="input-box">
                    <div class="terms-container">
                        <label for="terms" class="terms-label">
                        <input type="checkbox" id="terms" name="terms" required>
                          Ao marcar esta caixa, eu confirmo que li e concordo com os 
                          <a href="termos.php" class="terms-link">Termos de Uso</a> 
                          e a 
                          <a href="termos.php" class="privacy-link">Política de Privacidade</a> 
                          do site. Estou ciente de que minha utilização dos serviços está sujeita a essas condições e que posso acessar a qualquer momento os documentos completos para obter mais informações sobre os direitos e responsabilidades envolvidos.
                        </label>
                      </div>
                </div>
            </div>
            <button type="submit" class="submit-button">Cadastrar</button>

        </form>

        <a href="../index.php" class="redirect-button" style="padding: 0.6rem; width: 80px;">Voltar</a>
    </div>

    <script>
    function validarSenha() {
        var senha = document.getElementById("senha").value;
        var confSenha = document.getElementById("Confsenha").value;

        // Verifica se as senhas não coincidem
        if (senha !== confSenha) {
            Swal.fire({
                title: 'Erro!',
                text: 'As senhas não coincidem. Por favor, verifique.',
                icon: 'error'
            });
            return false; // Impede o envio do formulário
        }
    }
    </script>

</body>

</html>