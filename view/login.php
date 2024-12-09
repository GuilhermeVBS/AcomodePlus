<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fonte.css">
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/style-form.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login</title>
</head>

<body>
    <script src="../js/form.js" defer></script>

    <div class="form" style="margin-top: 40px; margin-bottom: 20px; max-width: 40vw;">
        <div class="form-header">
            <h1>Login</h1>
            <a href="cadastroUsuario.php" class="redirect-button">cadastrar-se</a>
        </div>
        <form action="../control/loginControl.php" method="post">

            <div class="input-box">
                <label>CPF:</label>
                <i class="bi bi-person-vcard-fill" style="padding-top: 40px; padding-left: 25px;"></i>
                <input type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                    title="Informe o padrão correto: xxx.xxx.xxx-xx" required minlength="14" maxlength="14"
                    oninput="onCPFInput(event)">
            </div>
            <div class="input-box">
                <label>Senha:</label>
                <i class="bi bi-lock-fill" style="padding-top: 39px; padding-left: 25px;"></i>
                <input type="password" name="senha" required placeholder="Senha">
            </div>

            <button type="submit" class="submit-button">Entrar</button>
        </form>
        <a href="../index.php" class="redirect-button" style="padding: 0.6rem; width: 80px;">Voltar</a>
    </div>
</body>

</html>