const email = document.getElementById('email-');
const botao = document.getElementById('botao');
const p = document.getElementById('p');

botao.addEventListener('click', validaEmail);

function validaEmail() {
    if (email.value === '') {
        p.innerHTML = 'Por favor inserir um endereço de e-mail ou CPF válido.';
    } else {
        p.innerHTML = '';
    }
}