document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.querySelector('.menu-btn');
    const sairPopup = document.getElementById('sairPopup');
    const closeSairPopup = document.getElementById('closeSairPopup');
    const btnSair = document.getElementById('btnSair');

    if (menuBtn && sairPopup && closeSairPopup && btnSair) {
        menuBtn.addEventListener('click', function () {
            sairPopup.style.display = 'block';
        });

        closeSairPopup.addEventListener('click', function () {
            sairPopup.style.display = 'none';
        });

        btnSair.addEventListener('click', function () {
            window.location.href = '../register.php';
        });

        // Fecha popup ao clicar fora do conteúdo
        sairPopup.addEventListener('click', function (e) {
            if (e.target === sairPopup) {
                sairPopup.style.display = 'none';
            }
        });
    }
});