<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nextshop - Página Principal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="paginaPrincipal.css" />
</head>
<body>
    <header>
        <div class="header-container">
            <div class="left-header">
                <img src="logo" alt="logo">
                <button class="menu-button" aria-label="Menu">
                    &#9776; <!-- hamburger icon -->
                </button>
            </div>
            <div class="search-container">
                <input type="search" placeholder="Buscar lojas e produtos..." />
            </div>
            <div class="cart-icon">
                &#128722; <!-- shopping cart icon -->
            </div>
        </div>
    </header>

    <main>
        <!-- Carousel de promoções -->
        <section class="promo-carousel">
            <img src="promo1.jpg" alt="Promoção 1" />
            <img src="promo2.jpg" alt="Promoção 2" />
            <img src="promo3.jpg" alt="Promoção 3" />
            <img src="promo4.jpg" alt="Promoção 4" />
            <img src="promo5.jpg" alt="Promoção 5" />
        </section>

        <!-- Categorias -->
        <section class="categories">
            <div class="category">
                <div class="icon">&#128717;</div>
                <div class="label">Mercados</div>
            </div>
            <div class="category">
                <div class="icon">&#128250;</div>
                <div class="label">Eletrônicos</div>
            </div>
            <div class="category">
                <div class="icon">&#128663;</div>
                <div class="label">Automóveis</div>
            </div>
            <div class="category">
                <div class="icon">&#128241;</div>
                <div class="label">Smartphones</div>
            </div>
        </section>

        <!-- Carousel de produtos -->
        <section class="product-carousel">
            <article class="product-card">
                <img src="fone1.jpg" alt="Fone De Ouvido In-ear Kz Edx Pro" />
                <h3>Fone De Ouvido In-ear Kz Edx Pro retorno de palco...</h3>
                <p>R$ 32<br /><small>em 12x R$ 4,55</small></p>
            </article>
            <article class="product-card">
                <img src="vestido1.jpg" alt="Vestido Midi Listrado Lima" />
                <h3>VESTIDO MIDI LISTRADO LIMA</h3>
                <p>R$29,99<br /><small>em 6x R$ 6,00</small></p>
            </article>
            <article class="product-card">
                <img src="m2.jpg" alt="M.2 2280, SATA III 6GB/s, Leitura 550MB/s..." />
                <h3>M.2 2280, SATA III 6GB/s, LEITURA 550MB/s...</h3>
                <p>R$ 159,99<br /><small>em 3x R$ 19,32</small></p>
            </article>
            <article class="product-card">
                <img src="pao.jpg" alt="Pão Frances a unidade" />
                <h3>PÃO FRANCES A UNIDADE</h3>
                <p>R$ 1,00</p>
            </article>
            <article class="product-card">
                <img src="fone1.jpg" alt="Fone De Ouvido In-ear Kz Edx Pro" />
                <h3>Fone De Ouvido In-ear Kz Edx Pro retorno de palco...</h3>
                <p>R$ 32<br /><small>em 12x R$ 4,55</small></p>
            </article>
            <article class="product-card">
                <img src="vestido1.jpg" alt="Vestido Midi Listrado Lima" />
                <h3>VESTIDO MIDI LISTRADO LIMA</h3>
                <p>R$29,99<br /><small>em 6x R$ 6,00</small></p>
            </article>
            <article class="product-card">
                <img src="m2.jpg" alt="M.2 2280, SATA III 6GB/s, Leitura 550MB/s..." />
                <h3>M.2 2280, SATA III 6GB/s, LEITURA 550MB/s...</h3>
                <p>R$ 159,99<br /><small>em 3x R$ 19,32</small></p>
            </article>
        </section>
    </main>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
