document.addEventListener('DOMContentLoaded', function () {
    // Verifica se veio com ?show=input na URL
    if (window.location.search.includes('show=input')) {
        document.getElementById('emailForm').style.display = 'inline-block';
        document.getElementById('showEmailInput').style.display = 'none';
        document.getElementById('btnCriarConta').style.display = 'none';
    }

    // Mostrar o formulário de email ao clicar no botão
    document.getElementById('showEmailInput').onclick = function () {
        document.getElementById('emailForm').style.display = 'inline-block';
        this.style.display = 'none';
        document.getElementById('btnCriarConta').style.display = 'none';
    };
    document.getElementById('cancelEmailInput').onclick = function () {
        document.getElementById('emailForm').style.display = 'none';
        document.getElementById('showEmailInput').style.display = 'inline-block';
        document.getElementById('btnCriarConta').style.display = 'inline-block';
    };

    // Sumir mensagem de erro
    var msg = document.getElementById('errorMsg');
    if (msg) {
        setTimeout(function () {
            msg.style.display = 'none';
        }, 700);
    }
});