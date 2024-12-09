// Função de upload de imagem
document.getElementById('uploadTrigger').addEventListener('click', function() {
    document.getElementById('imgUsuario').click(); // Certifique-se de usar o ID correto
});

document.getElementById('imgUsuario').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('profilePic').src = e.target.result; // Define a imagem carregada
        };

        reader.readAsDataURL(file); // Lê o arquivo de imagem e exibe no img
    }
});

// Função para remover a imagem
document.getElementById('removeImagem').addEventListener('click', function() {
    // Definir uma imagem padrão quando o usuário remover a imagem
    document.getElementById('profilePic').src = 'https://www.gov.br/cdn/sso-status-bar/src/image/user.png'; // URL de imagem padrão
    document.getElementById('imgUsuario').value = ""; // Limpa o input de imagem
});

// Validação de senha
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        const senha = document.getElementById("senha").value;
        const confirmaSenha = document.getElementById("Confsenha").value;

        if (senha !== confirmaSenha) {
            event.preventDefault(); 
            alert("As senhas não coincidem. Por favor, verifique."); 
        }
    });
});
