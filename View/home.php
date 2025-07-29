<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NextShop - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../templates/assets/css/home.css" />
</head>

<body>
    <!-- Header -->
    <header class="custom-header">
        <div class="header-left">
            <button class="menu-btn" type="button" aria-label="Menu">
                <i class="bi bi-list"></i>
            </button>
            <a href="#" class="logo-link">
                <img src="../templates/images/LogoNextShopPreto.png" alt="NextShop Logo" class="logo-img" />
                <span class="logo-text">NextShop</span>
            </a>
        </div>
        <form role="search" aria-label="Buscar lojas e produtos" class="search-form">
            <div class="search-bar">
                <span class="search-icon">
                    <i class="bi bi-search"></i>
                </span>
                <input type="search" class="search-input" placeholder="Buscar lojas e produtos..."
                    aria-label="Buscar lojas e produtos" />
            </div>
        </form>
        <div class="header-right">
            <a href="#" class="cart-link" aria-label="Carrinho de compras">
                <i class="bi bi-cart3"></i>
            </a>
            <a href="#" class="user-link" aria-label="Perfil do usuário" id="openPerfilPopup">
                <i class="bi bi-person-circle"></i>
            </a>
        </div>
    </header>

    <!-- Modal Perfil do Usuário -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="perfilModalLabel">Perfil do Usuário</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($userName ?? ''); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($userEmail ?? ''); ?></p>
                    <p><strong>CPF:</strong> <?php echo htmlspecialchars($userCpf ?? ''); ?></p>
                    <p><strong>Senha:</strong> ********</p>
                </div>
            </div>
        </div>
    </div>
<script src="../templates/js/PopUpPerfil.js"></script>
    <!-- Main Content -->
    <main class="bg-dark text-white p-3 p-md-5">
        <!-- Banner CTA -->
        <section class="banner-cta">
            <h1>Ofertas Exclusivas NextShop</h1>
            <p>Descubra os melhores produtos e promoções para você economizar e comprar com segurança.</p>
            <button class="cta-btn">Ver Ofertas</button>
        </section>
        <section class="banner mb-4 rounded-3">
            <img src="../templates/images/banner.jpg" alt="Banner" class="img-fluid w-100 rounded-3" />
        </section>

        <!-- Categories -->
        <section class="categories d-flex justify-content-start gap-4 mb-4 flex-wrap">
            <!-- Category Item -->
            <div class="category-item text-center">
                <div class="category-icon rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2">
                    <i class="bi bi-bag-fill fs-3"></i>
                </div>
                <small>Mercados</small>
            </div>
            <div class="category-item text-center">
                <div class="category-icon rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2">
                    <i class="bi bi-tv-fill fs-3"></i>
                </div>
                <small>Eletronicos</small>
            </div>
            <div class="category-item text-center">
                <div class="category-icon rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2">
                    <i class="bi bi-car-front-fill fs-3"></i>
                </div>
                <small>Automóveis</small>
            </div>
            <div class="category-item text-center">
                <div class="category-icon rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2">
                    <i class="bi bi-phone-fill fs-3"></i>
                </div>
                <small>Smartphones</small>
            </div>
        </section>

        <!-- Products Carousel -->
        <section class="products-carousel d-flex gap-3 overflow-auto pb-3">
            <!-- Product Card -->
            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/fonekqz.png" alt="Fone De Ouvido In-ear Kz Edx Pro retorno de palco"
                        class="img-fluid" style="max-height: 140px; object-fit: contain;" />
                </div>
                <span class="position-absolute top-0 end-0" title="Localização">
                </span>
                <div class="p-2 small lh-sm">
                    Fone De Ouvido In-ear Kz Edx Pro retorno de palco
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 32</span><br />
                    <small class="text-muted">12x R$ 4,55</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/placa.jfif" alt="Vestido Midi Listrado Lima" class="img-fluid" />
                </div>
                <div class="p-2 small lh-sm fw-bold text-uppercase">
                    Placa de Vídeo RTX 4060 Ti Eagle OC Gigabyte NVIDIA GeForce, 8 GB GDDR6.
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 2.499,99</span><br />
                    <small class="text-muted">10x de R$ 277,77</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/tapete.png" alt="M.2 2280, SATA III 6GB/S, LEITURA 550MB/S"
                        class="img-fluid" />
                </div>
                <div class="p-2 small lh-sm text-uppercase">
                    Tapete personalizado fluff peludo
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 124,99</span><br />
                    <small class="text-muted">3x de R$42,91</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/ryzen.jpg" alt="Processador ryzen 5500" class="img-fluid" />
                </div>
                <div class="p-2 small lh-sm text-uppercase">
                    Processador AMD Ryzen 5 5500,
                    6-Core, 12-Threads, AM4

                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 489,99</span><br />
                    <small class="text-muted">12x de R$ 48,04</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <!-- Repeat products to match the image -->
            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/tenis.png" alt="Tênis Nike Air Max Excee 365 Masculino"
                        class="img-fluid" style="max-height: 140px; object-fit: contain;" />
                </div>
                <span class="position-absolute top-0 end-0" title="Localização">
                </span>

                <div class="p-2 small lh-sm">
                    Tênis Nike Air Max Excee 365 Masculino
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 379,99</span><br />
                    <small class="text-muted">5x de R$ 80,00</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/Moletom.png" alt="Vestido Midi Listrado Lima" class="img-fluid" />
                </div>
                <div class="p-2 small lh-sm fw-bold text-uppercase">
                    Moletom casual moda roupas masculinas
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 275,49 </span><br />
                    <small class="text-muted">4x de R$ 72,50</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>

            <article class="product-card">
                <div class="position-relative d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img src="../templates/images/ssd.png" alt="M.2 2280, SATA III 6GB/S, LEITURA 550MB/S"
                        class="img-fluid" />
                </div>
                <div class="p-2 small lh-sm text-uppercase">
                    M.2 2280, SATA III 6GB/S, LEITURA 550MB/S...
                </div>
                <div class="px-2 pb-2">
                    <span class="price">R$ 159,99</span><br />
                    <small class="text-muted">9x R$ 19,32</small>
                    <button class="buy-btn">Comprar</button>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <p>© NEXTSHOP 2025 . Todos os direitos reservados.</p>
        <div class="social-icons">
            <a href="https://web.whatsapp.com/" target="_blank"><i class="bi bi-whatsapp"></i></a>
            <a href="https://discord.com/" target="_blank"><i class="bi bi-discord"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>


    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>