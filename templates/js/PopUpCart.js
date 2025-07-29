document.addEventListener('DOMContentLoaded', () => {
  const openBtn = document.getElementById('openCartPopup');
  const popup = document.getElementById('CartPopup');
  const closeBtn = document.getElementById('closeCartPopup');
  const cartItemsContainer = popup.querySelector('.cart-items');
  const totalPriceElem = document.getElementById('totalPrice');
  const checkoutBtn = document.getElementById('checkoutBtn');

  function openPopup() { popup.style.display = 'flex'; }
  function closePopup() { popup.style.display = 'none'; }

  window.addEventListener('click', e => { if (e.target === popup) closePopup(); });
  closeBtn.addEventListener('click', closePopup);
  openBtn.addEventListener('click', e => { e.preventDefault(); openPopup(); });

  function updateTotal() {
    let total = 0;
    cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
      total += parseFloat(item.getAttribute('data-price')) || 0;
    });
    totalPriceElem.textContent = total.toFixed(2);
  }

  function createCartItem(name, price, imageSrc) {
    const item = document.createElement('div');
    item.classList.add('cart-item');
    item.style.display = 'flex';
    item.style.alignItems = 'center';
    item.style.justifyContent = 'space-between';
    item.style.borderBottom = '1px solid #ccc';
    item.style.padding = '8px 0';

    item.setAttribute('data-price', parseFloat(price).toFixed(2));
    item.setAttribute('data-name', name);

    item.innerHTML = `
      <div style="display:flex; align-items:center; gap: 10px;">
        <img src="${imageSrc}" alt="${name}" style="width: 50px; height: 50px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px;">
        <div>
          <p class="item-name" style="margin:0; font-weight: bold;">${name}</p>
          <p style="margin:0;">Preço: R$ ${parseFloat(price).toFixed(2)}</p>
        </div>
      </div>
      <button class="remove-btn" style="background: #ff4d4d; border:none; color:white; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-left: 10rem;">Remover</button>
    `;

    item.querySelector('.remove-btn').addEventListener('click', () => {
      item.remove();
      updateTotal();
    });

    return item;
  }

  document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();
      const name = button.getAttribute('data-name');
      const price = button.getAttribute('data-price');
      const image = button.getAttribute('data-image');

      const cartItem = createCartItem(name, price, image);
      cartItemsContainer.appendChild(cartItem);

      updateTotal();
      openPopup();
    });
  });

  checkoutBtn.addEventListener('click', () => {
    if (cartItemsContainer.children.length === 0) {
      alert('Seu carrinho está vazio!');
      return;
    }

const items = [];
cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
  items.push({
    name: item.getAttribute('data-name'),
    price: parseFloat(item.getAttribute('data-price')),
    image: item.querySelector('img')?.getAttribute('src') || '',
  });
});

fetch('../Controller/finalizarPagamento.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ items }),
})
     .then(res => {
  return res.text().then(text => {
    console.log('Resposta bruta do servidor:', text);
    try {
      return JSON.parse(text);
    } catch (err) {
      console.error('Erro ao fazer parse do JSON:', err);
      throw err;
    }
  })
})
.then(data => {
  if (data.success) {
    alert('Pagamento finalizado com sucesso! Obrigado pela compra.');
    cartItemsContainer.innerHTML = '';
    updateTotal();
    closePopup();
  } else {
    alert('Erro ao finalizar o pagamento: ' + (data.message || ''));
  }
})
.catch((error) => {
  alert('Erro na comunicação com o servidor: ' + error.message);
})
  })
})
