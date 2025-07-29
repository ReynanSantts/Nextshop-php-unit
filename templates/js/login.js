document.addEventListener('DOMContentLoaded', function () {
    const switchEmail = document.getElementById('switchEmail');
    if (switchEmail) {
        switchEmail.onclick = function () {
            window.location.href = '../register.php?show=input';
        };
    }

    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.onclick = function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }
        };
    }
});