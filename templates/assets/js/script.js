/* script.js - Script para NextShop login */

/**
 * Alterna entre exibir email atual e campo para trocar email
 */
document.addEventListener('DOMContentLoaded', function () {
    const switchEmailLink = document.getElementById('switchEmail');
    const userEmailDiv = document.getElementById('userEmail');
    const emailInput = document.getElementById('emailInput');

    switchEmailLink.addEventListener('click', function (e) {
        e.preventDefault();
        if (emailInput.classList.contains('d-none')) {
            // Mostrar campo para trocar email
            emailInput.classList.remove('d-none');
            userEmailDiv.classList.add('d-none');
            emailInput.focus();
            switchEmailLink.textContent = 'Cancelar';
        } else {
            // Voltar para exibir email atual
            emailInput.classList.add('d-none');
            userEmailDiv.classList.remove('d-none');
            switchEmailLink.textContent = 'Trocar';
            emailInput.value = '';
        }
    });

    // Função para alternar visibilidade da senha
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = togglePasswordBtn.querySelector('i');

    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        // Alterna o ícone
        if (type === 'password') {
            toggleIcon.classList.remove('bi-eye-fill');
            toggleIcon.classList.add('bi-eye-slash-fill');
        } else {
            toggleIcon.classList.remove('bi-eye-slash-fill');
            toggleIcon.classList.add('bi-eye-fill');
        }
    });
});
