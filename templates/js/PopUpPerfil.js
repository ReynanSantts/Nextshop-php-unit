document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openPerfilPopup');
    const popup = document.getElementById('perfilPopup');
    const closeBtn = document.getElementById('closePerfilPopup');

    if (openBtn && popup && closeBtn) {
        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            popup.style.display = 'flex';
        });

        closeBtn.addEventListener('click', function () {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function (e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });
    }
});