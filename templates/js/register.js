document.getElementById('showEmailInput').onclick = function() {
    document.getElementById('emailForm').style.display = 'inline-block';
    this.style.display = 'none';
     document.getElementById('btnCriarConta').style.display = 'none'; // Esconde o botão CRIAR CONTA
};
document.getElementById('cancelEmailInput').onclick = function() {
    document.getElementById('emailForm').style.display = 'none';
    document.getElementById('showEmailInput').style.display = 'inline-block';
        document.getElementById('btnCriarConta').style.display = 'inline-block'; // Mostra de volta
};