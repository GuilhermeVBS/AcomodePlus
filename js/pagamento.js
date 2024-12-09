function copyPixCode() {
    // Código PIX para ser copiado
    const pixCode = document.querySelector('.pix-code').innerText;
    navigator.clipboard.writeText(pixCode).then(() => {
        document.getElementById('copyMessage').style.display = 'block';
        // Esconde a mensagem após 3 segundos
        setTimeout(() => {
            document.getElementById('copyMessage').style.display = 'none';
        }, 3000);
    });
}
