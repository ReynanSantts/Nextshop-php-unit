document.addEventListener('DOMContentLoaded', () => {
  // Referências principais do DOM
  const openBtn = document.getElementById('openCartPopup'); // Botão de abrir carrinho
  const popup = document.getElementById('CartPopup'); // Popup do carrinho
  const closeBtn = document.getElementById('closeCartPopup'); // Botão de fechar popup
  const cartItemsContainer = popup.querySelector('.cart-items'); // Container com os itens
  const totalPriceElem = document.getElementById('totalPrice'); // Valor total do carrinho
  const checkoutBtn = document.getElementById('checkoutBtn'); // Botão de finalizar pagamento

  // Funções de abrir/fechar popup
  function openPopup() { popup.style.display = 'flex'; }
  function closePopup() { popup.style.display = 'none'; }

  // Fecha ao clicar fora do conteúdo
  window.addEventListener('click', e => { if (e.target === popup) closePopup(); });
  // Fecha ao clicar no X
  closeBtn.addEventListener('click', closePopup);
  // Abre ao clicar no botão do carrinho
  openBtn.addEventListener('click', e => {
    e.preventDefault();
    openPopup();
  });

  // Atualiza o valor total baseado na quantidade × preço de cada item
  function updateTotal() {
    let total = 0;
    cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
      const qtd = parseInt(item.getAttribute('data-qtd')) || 1;
      const price = parseFloat(item.getAttribute('data-price')) || 0;
      total += qtd * price;
    });
    totalPriceElem.textContent = total.toFixed(2); // Mostra com 2 casas decimais
  }

  // Cria visualmente um item no carrinho, com nome, imagem, preço e controles de quantidade
  function createCartItem(name, price, imageSrc, qtd = 1) {
    const item = document.createElement('div');
    item.classList.add('cart-item');

    // Atributos personalizados
    item.setAttribute('data-price', parseFloat(price).toFixed(2));
    item.setAttribute('data-name', name);
    item.setAttribute('data-qtd', qtd);
    item.setAttribute('data-image', imageSrc);

    // HTML interno com imagem, nome, preço e controles de quantidade
    item.innerHTML = `
      <div style="display:flex; align-items:center; gap: 10px;">
        <img src="${imageSrc}" alt="${name}" style="width: 50px; height: 50px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px;">
        <div>
          <p class="item-name" style="margin:0; font-weight: bold;">${name}</p>
          <p style="margin:0;">Preço: R$ ${parseFloat(price).toFixed(2)}</p>
          <div style="margin-top:5px; display: flex; align-items: center; gap: 5px;">
            <button class="btn-decrease" style="background-color:#00ff00; width: 2rem;">−</button>
            <span class="qtd-span">${qtd}</span>
            <button class="btn-increase" style="background-color:#00ff00; width: 2rem;">+</button>
          </div>
        </div>
      </div>
    `;

    // Botões de controle de quantidade
    const btnIncrease = item.querySelector('.btn-increase');
    const btnDecrease = item.querySelector('.btn-decrease');
    const qtdSpan = item.querySelector('.qtd-span');

    // Aumenta a quantidade ao clicar no "+"
    btnIncrease.addEventListener('click', () => {
      let qtd = parseInt(item.getAttribute('data-qtd')) || 1;
      qtd++;
      item.setAttribute('data-qtd', qtd);
      qtdSpan.textContent = qtd;
      updateTotal();
    });

    // Diminui a quantidade ao clicar no "-"
    btnDecrease.addEventListener('click', () => {
      let qtd = parseInt(item.getAttribute('data-qtd')) || 1;
      if (qtd > 1) {
        qtd--;
        item.setAttribute('data-qtd', qtd);
        qtdSpan.textContent = qtd;
      } else {
        item.remove(); // Se for 1, remove o item do carrinho
      }
      updateTotal();
    });

    return item;
  }

  // Ao clicar em "Comprar", adiciona item ao carrinho ou aumenta a quantidade
  document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();

      const name = button.getAttribute('data-name');
      const price = button.getAttribute('data-price');
      const image = button.getAttribute('data-image');

      // Verifica se o item já está no carrinho
      const existingItem = [...cartItemsContainer.children].find(item =>
        item.getAttribute('data-name') === name
      );

      if (existingItem) {
        // Se já estiver, aumenta a quantidade
        let qtd = parseInt(existingItem.getAttribute('data-qtd')) || 1;
        qtd++;
        existingItem.setAttribute('data-qtd', qtd);
        existingItem.querySelector('.qtd-span').textContent = qtd;
      } else {
        // Se for novo, cria um novo item
        const cartItem = createCartItem(name, price, image, 1);
        cartItemsContainer.appendChild(cartItem);
      }

      updateTotal();
      openPopup();
    });
  });

  // Finaliza o pagamento ao clicar no botão "Finalizar Pagamento"
  checkoutBtn.addEventListener('click', () => {
    if (cartItemsContainer.children.length === 0) {
      alert('Seu carrinho está vazio!');
      return;
    }

    // Coleta os itens do carrinho para enviar ao servidor
    const items = [];
    cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
      items.push({
        name: item.getAttribute('data-name'),
        price: parseFloat(item.getAttribute('data-price')),
        image: item.getAttribute('data-image') || '',
        qtd: parseInt(item.getAttribute('data-qtd')) || 1
      });
    });

    // Envia os itens ao PHP via fetch (AJAX)
    fetch('../Controller/finalizarPagamento.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ items }),
    })
    .then(res => res.text().then(text => {
      console.log('Resposta bruta do servidor:', text); // Log bruto para debug
      try {
        return JSON.parse(text); // Tenta converter em JSON
      } catch (err) {
        console.error('Erro ao fazer parse do JSON:', err);
        throw err;
      }
    }))
    .then(data => {
      if (data.success) {
        alert('Pagamento finalizado com sucesso! Obrigado pela compra.');
        cartItemsContainer.innerHTML = ''; // Limpa visualmente o carrinho
        updateTotal();
        closePopup();
      } else {
        alert('Erro ao finalizar o pagamento: ' + (data.message || ''));
      }
    })
    .catch(error => {
      alert('Erro na comunicação com o servidor: ' + error.message);
    });
  });
});
