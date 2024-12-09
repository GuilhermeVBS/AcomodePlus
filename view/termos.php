<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Termos de Uso e Política de Privacidade - AcomodePlus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/termos.css" />
    <link rel="stylesheet" href="../css/fonte.css" />
    <script src="form.js" defer></script>
</head>

<body>
    <header>
        <a href="../index.php">
            <div class="logo">
                <img src="../img/acomode+_redondo.png" alt="" style="margin-right: 20px;">
                <h1>Acomode+</h1>
                </img>
            </div>
        </a>
        <div class="perfil">
            <?php if (isset($_SESSION['id_usuario'])): ?>
            <a style="margin-right:20px ;" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <img id="profilePic"
                    src="<?php echo !empty($imgUsuario) ? '../img/uploadsUsuario/' . $imgUsuario : '../img/default.png'; ?>"
                    alt="Foto de perfil">
            </a>
            <?php else: ?>
            <a href="/login.php" style="margin-right:20px ;">Entrar</a>
            <?php endif; ?>
        </div>
    </header>
    <div class="form" style="margin-top: 40px; margin-bottom: 20px; width: 80%; max-width: 900px;">
        <div class="form-header">
            <h1>Termos de Uso e Política de Privacidade - AcomodePlus</h1>
        </div>

        <!-- Termos de Uso -->
        <div class="termos-conteudo">
            <h3>1. Aceitação dos Termos</h3>
            <p>Ao acessar ou utilizar o site **AcomodePlus**, você concorda com os presentes **Termos de Uso** e nossa **Política de Privacidade**. Caso não concorde com qualquer parte destes termos, não use nossos serviços.</p>

            <h3>2. Uso do Site</h3>
            <p>O site **AcomodePlus** é uma plataforma destinada ao aluguel de imóveis. Através do nosso site, você pode se cadastrar para buscar e alugar imóveis, com a garantia de que o processo será formalizado por meio de contrato de locação.</p>

            <h3>3. Cadastro e Responsabilidade</h3>
            <p>Para utilizar os serviços de aluguel, você precisa se cadastrar no site, fornecendo informações corretas e atualizadas. Você é responsável pela veracidade das informações fornecidas e pelo uso adequado de sua conta.</p>

            <h3>4. Contrato de Locação</h3>
            <p>Ao fechar um aluguel através do **AcomodePlus**, um contrato de locação será gerado entre o locador (proprietário do imóvel) e o locatário (inquilino). O contrato será formalizado de maneira digital e aceito pelas partes antes de qualquer pagamento.</p>

            <h3>5. Formas de Pagamento</h3>
            <p>Os pagamentos pelos aluguéis podem ser realizados via **Pix** ou **Cartão de Crédito**. O pagamento é feito diretamente na plataforma, e um recibo será enviado ao locatário assim que o pagamento for processado com sucesso.</p>

            <h3>6. Obrigações do Locatário</h3>
            <p>O locatário se compromete a pagar os valores acordados no contrato, respeitar as regras do imóvel e devolvê-lo no estado em que o recebeu, salvo o desgaste natural do uso.</p>

            <h3>7. Obrigações do Locador</h3>
            <p>O locador se compromete a garantir que o imóvel esteja em boas condições para locação, conforme descrito no contrato. O locador deve fornecer todas as informações necessárias sobre o imóvel e realizar os ajustes ou reparos quando necessário.</p>

            <h3>8. Alterações nos Termos</h3>
            <p>**AcomodePlus** se reserva o direito de modificar ou atualizar estes Termos de Uso a qualquer momento. Recomendamos que você revise periodicamente esta página para se manter informado sobre eventuais alterações.</p>

            <h3>9. Limitação de Responsabilidade</h3>
            <p>**AcomodePlus** não se responsabiliza por danos diretos ou indiretos causados por falhas nos serviços prestados pelos locadores ou locatários, ou por problemas no processo de pagamento. Nossa responsabilidade é limitada à mediação do processo de aluguel.</p>

            <h3>10. Suspensão ou Cancelamento de Conta</h3>
            <p>**AcomodePlus** pode suspender ou cancelar a conta de um usuário caso haja violação dos Termos de Uso, práticas fraudulentas ou qualquer outra ação que prejudique a integridade do serviço.</p>

            <p>Se você tiver dúvidas sobre os nossos Termos de Uso ou precisar de mais informações, entre em contato conosco através do nosso suporte ao cliente.</p>
            
            <!-- Política de Privacidade -->
            <hr>

            <h2>Política de Privacidade - AcomodePlus</h2>
            
            <h3>1. Introdução</h3>
            <p>Nosso compromisso é proteger a privacidade de nossos usuários e garantir a segurança dos dados fornecidos. Ao utilizar o site **AcomodePlus**, você concorda com os termos estabelecidos nesta **Política de Privacidade**.</p>

            <h3>2. Coleta de Informações</h3>
            <p>Ao se cadastrar e utilizar nossos serviços, coletamos as seguintes informações pessoais:</p>
            <ul>
                <li>Nome completo</li>
                <li>Data de nascimento</li>
                <li>CPF</li>
                <li>Telefone</li>
                <li>Endereço de e-mail</li>
                <li>Informações de pagamento (Pix ou Cartão de Crédito)</li>
            </ul>
            <p>Essas informações são necessárias para processar seu cadastro, realizar transações e enviar notificações relacionadas aos nossos serviços.</p>

            <h3>3. Uso das Informações</h3>
            <p>As informações que coletamos são utilizadas para:</p>
            <ul>
                <li>Gerenciar sua conta e personalizar sua experiência no site;</li>
                <li>Processar aluguéis e transações financeiras (via Pix ou Cartão de Crédito);</li>
                <li>Comunicar-se com você sobre o status de seu aluguel e serviços relacionados;</li>
                <li>Melhorar nossos serviços e oferecer suporte ao cliente;</li>
                <li>Enviar notificações importantes, como atualizações de contrato ou alertas sobre o pagamento.</li>
            </ul>

            <h3>4. Proteção de Dados</h3>
            <p>Tomamos medidas razoáveis para proteger seus dados pessoais, utilizando tecnologias seguras e práticas adequadas para evitar acesso não autorizado, alteração ou divulgação de suas informações pessoais.</p>

            <h3>5. Compartilhamento de Dados</h3>
            <p>Não compartilhamos suas informações pessoais com terceiros, exceto quando necessário para cumprir com o contrato de aluguel ou conforme exigido por lei. Exemplos de situações em que podemos compartilhar seus dados incluem:</p>
            <ul>
                <li>Com as instituições financeiras para processar pagamentos via Pix ou Cartão de Crédito;</li>
                <li>Com autoridades legais, caso seja exigido por lei ou para proteger nossos direitos e segurança.</li>
            </ul>

            <h3>6. Cookies</h3>
            <p>Usamos cookies para melhorar a experiência do usuário em nosso site, personalizando o conteúdo e oferecendo funcionalidades adequadas. Os cookies ajudam a identificar suas preferências e melhorar a navegação.</p>
            <p>Você pode configurar seu navegador para recusar cookies, mas isso pode afetar a funcionalidade de algumas partes do nosso site.</p>

            <h3>7. Retenção de Dados</h3>
            <p>Retemos suas informações pessoais pelo tempo necessário para cumprir com as finalidades descritas nesta política, a menos que a lei exija ou permita um período maior de retenção.</p>

            <h3>8. Seus Direitos</h3>
            <p>Você tem o direito de acessar, corrigir ou excluir suas informações pessoais. Para isso, basta entrar em contato com nosso suporte ao cliente. Também é possível solicitar a exclusão de sua conta a qualquer momento, desde que não haja pendências ou contratos em aberto.</p>

            <h3>9. Alterações na Política de Privacidade</h3>
            <p>Podemos atualizar esta Política de Privacidade periodicamente. Recomendamos que você a consulte regularmente para estar ciente de quaisquer mudanças. Alterações significativas serão comunicadas por e-mail ou por aviso no nosso site.</p>

            <h3>10. Contato</h3>
            <p>Se você tiver dúvidas sobre esta Política de Privacidade ou sobre o tratamento de seus dados, entre em contato conosco através do e-mail: <a href="mailto:acomodeplus.suporte@gmail.com">acomodeplus.suporte@gmail.com</a>.</p>

            <a href="cadastroUsuario.php" class="redirect-button">Voltar</a> <!-- Voltar para a página anterior -->
        </div>
    </div>
    <footer class="footer">
        <div class="footer-section logo-section">
            <img src="../img/acomode+_redondo.png" alt="Acomode Plus Logo" class="footer-logo">
        </div>
        <div class="footer-section">
            <h3>Siga-nos</h3>
            <a href="https://www.instagram.com/acomodeplus" target="_blank" class="social-link">
                <img src="../img/social.png" alt="Instagram" class="social-icon"> Instagram
            </a>
        </div>
        <div class="footer-section">
            <h3>Sobre nós</h3>
            <p>A Acomode Plus é dedicada a oferecer as melhores acomodações com excelência em serviço e atendimento ao
                cliente.</p>
        </div>
        <div class="footer-section">
            <h3>Informações de Contato</h3>
            <p>Email: <a href="mailto:acomodeplus.suporte@gmail.com">acomodeplus.suporte@gmail.com</a></p>
            <p>Telefone: <a href="tel:+556181318476">(61) 8131-8476</a></p>
        </div>
    </footer>
</body>

</html>
