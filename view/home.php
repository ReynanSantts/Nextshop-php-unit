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
    <link rel="stylesheet" href="css/custom.css" />
</head>
<body>
<!-- Header -->
<header class="d-flex align-items-center justify-content-between px-3 px-md-5" style="height: 60px; background-color: #00ff00;">
    <div class="d-flex align-items-center gap-3">
        <!-- Hamburger Menu -->
        <button class="btn btn-link p-0 d-md-none text-black" type="button" aria-label="Menu">
            <i class="bi bi-list fs-3"></i>
        </button>
        <!-- Logo -->
        <a href="#" class="d-flex align-items-center text-black text-decoration-none">
            <img src="../images/LogoNextShop.png" alt="NextShop Logo" height="30" style="filter: brightness(0) saturate(100%) contrast(100%)" />
            <span class="ms-2 fw-bold fs-5">nextshop</span>
        </a>
    </div>
    <!-- Search Bar -->
    <form class="flex-grow-1 mx-3 mx-md-5" role="search" aria-label="Buscar lojas e produtos">
        <div class="input-group rounded-pill border border-black bg-bright-green position-relative" style="max-width: 100%;">
            <span class="input-group-text bg-bright-green border-0 position-absolute start-0 top-50 translate-middle-y text-black" id="search-icon" style="width: 30px; height: 30px; justify-content: center; align-items: center;">
                <i class="bi bi-search"></i>
            </span>
            <input type="search" class="form-control border-0 bg-bright-green text-black ps-5" placeholder="Buscar lojas e produtos..." aria-label="Buscar lojas e produtos" aria-describedby="search-icon" />
        </div>
    </form>
    <!-- Cart Icon -->
    <a href="#" class="text-black fs-3" aria-label="Carrinho de compras">
        <i class="bi bi-cart3"></i>
    </a>
</header>

    <!-- Main Content -->
    <main class="bg-dark text-white p-3 p-md-5">
        <!-- Banner Placeholder -->
        <section class="banner mb-4 rounded-3"></section>

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
            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <div class="position-relative">
                    <img src="../images/fonekqz.png" alt="Fone De Ouvido In-ear Kz Edx Pro retorno de palco" class="img-fluid rounded-top" />
                    <span class="position-absolute top-0 end-0 bg-dark rounded-circle p-1 m-1" title="Localização">
                        <i class="bi bi-geo-alt-fill text-bright-green"></i>
                    </span>
                </div>
                <div class="p-2 text-dark small lh-sm">
                    Fone De Ouvido In-ear Kz Edx Pro retorno de palco
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$ 32<br />
                    <small class="text-muted">em 12x R$ 4,55</small>
                </div>
            </article>

            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <img src="../images/vestido.png" alt="Vestido Midi Listrado Lima" class="img-fluid rounded-top" />
                <div class="p-2 text-dark small lh-sm fw-bold text-uppercase">
                    VESTIDO MIDI LISTRADO LIMA
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$29,99<br />
                    <small class="text-muted">em 6x R$ 6,00</small>
                </div>
            </article>

            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <img src="../images/ssd.png" alt="M.2 2280, SATA III 6GB/S, LEITURA 550MB/S" class="img-fluid rounded-top" />
                <div class="p-2 text-dark small lh-sm text-uppercase">
                    M.2 2280, SATA III 6GB/S, LEITURA 550MB/S...
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$ 159,99<br />
                    <small class="text-muted">em 9x R$ 19,32</small>
                </div>
            </article>

            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <img src="../images/pão.png" alt="Pão Frances a Unidade" class="img-fluid rounded-top" />
                <div class="p-2 text-dark small lh-sm text-uppercase">
                    PÃO FRANCES A UNIDADE
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$ 1,00
                </div>
            </article>

            <!-- Repeat products to match the image -->
            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <div class="position-relative">
                    <img src="../images/fonekqz.png" alt="Fone De Ouvido In-ear Kz Edx Pro retorno de palco" class="img-fluid rounded-top" />
                    <span class="position-absolute top-0 end-0 bg-dark rounded-circle p-1 m-1" title="Localização">
                        <i class="bi bi-geo-alt-fill text-bright-green"></i>
                    </span>
                </div>
                <div class="p-2 text-dark small lh-sm">
                    Fone De Ouvido In-ear Kz Edx Pro retorno de palco
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$ 32<br />
                    <small class="text-muted">em 12x R$ 4,55</small>
                </div>
            </article>

            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <img src="../images/vestido.png" alt="Vestido Midi Listrado Lima" class="img-fluid rounded-top" />
                <div class="p-2 text-dark small lh-sm fw-bold text-uppercase">
                    VESTIDO MIDI LISTRADO LIMA
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$29,99<br />
                    <small class="text-muted">em 6x R$ 6,00</small>
                </div>
            </article>

            <article class="product-card bg-bright-green rounded-2 flex-shrink-0" style="width: 140px;">
                <img src="../images/ssd.png" alt="M.2 2280, SATA III 6GB/S, LEITURA 550MB/S" class="img-fluid rounded-top" />
                <div class="p-2 text-dark small lh-sm text-uppercase">
                    M.2 2280, SATA III 6GB/S, LEITURA 550MB/S...
                </div>
                <div class="px-2 pb-2 text-dark small">
                    R$ 159,99<br />
                    <small class="text-muted">em 9x R$ 19,32</small>
                </div>
            </article>
        </section>
    </main>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
