function formatName(name) {
  name = name.replace(/[0-9]/g, ""); // Remove todos os números
  return name;
}

function onNameInput(event) {
  const input = event.target;
  input.value = formatName(input.value);
} 

function formatCPF(cpf) {
  cpf = cpf.replace(/\D/g, ""); // Remove caracteres não numéricos
  cpf = cpf.replace(/^(\d{3})(\d)/, "$1.$2"); // Adiciona o primeiro ponto
  cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3"); // Adiciona o segundo ponto
  cpf = cpf.replace(/\.(\d{3})(\d)/, ".$1-$2"); // Adiciona o hífen
  return cpf;
}

function onCPFInput(event) {
  const input = event.target;
  input.value = formatCPF(input.value);
}

function onPhoneInput(event) {
  const input = event.target;
  input.value = formatPhoneNumber(input.value);
}

function formatPhoneNumber(phone) {
  phone = phone.replace(/\D/g, ""); // Remove caracteres não numéricos
  phone = phone.replace(/^(\d{2})(\d)/, "($1) $2"); // Adiciona os parênteses e espaço
  phone = phone.replace(/(\d{5})(\d)/, "$1-$2"); // Adiciona o hífen
  return phone;
}

function formatCEP(cep) {
  cep = cep.replace(/\D/g, ""); // Remove caracteres não numéricos
  cep = cep.replace(/^(\d{5})(\d)/, "$1-$2"); // Adiciona o hífen
  return cep;
}


function onCEPInput(event) {
  const input = event.target;
  input.value = formatCEP(input.value);
}

function formatArea(event) {
  const input = event.target;
  // Remove todos os caracteres não numéricos
  const numericValue = input.value.replace(/\D/g, "");
  
  // Atualiza o valor do input com os números seguidos de " m²"
  input.value = numericValue ? numericValue + " m²" : "";
}

function formatCurrency(value) {
  value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
  value = value.replace(/(\d+)(\d{2})$/, "$1,$2"); // Adiciona vírgula antes dos dois últimos dígitos
  return value;
}

function onCurrencyInput(event) {
  const input = event.target;
  input.value = formatCurrency(input.value);
}

function onlyNumbers(event) {
  const input = event.target;
  input.value = input.value.replace(/\D/g, "");
}

function onlyLetters(event) {
  const input = event.target;
  input.value = input.value.replace(/[^a-zA-Z]/g, "");
}


function formatCardNumber(number) {
  // Remove caracteres não numéricos
  number = number.replace(/\D/g, "");

  // Adiciona o primeiro hífen após os primeiros 4 dígitos
  number = number.replace(/^(\d{4})(\d)/, "$1-$2");

  // Adiciona o segundo hífen após o segundo grupo de 4 dígitos
  number = number.replace(/^(\d{4})-(\d{4})(\d)/, "$1-$2-$3");

  // Adiciona o terceiro hífen após o terceiro grupo de 4 dígitos
  number = number.replace(/^(\d{4})-(\d{4})-(\d{4})(\d)/, "$1-$2-$3-$4");

  return number;
}


document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("form").addEventListener("submit", function (event) {
      const senha = document.getElementById("senha").value;
      const confSenha = document.getElementById("Confsenha").value;
      
      if (senha !== confSenha) {
          event.preventDefault(); 
          alert("As senhas não coincidem. Por favor, verifique."); 
      }
  });

});