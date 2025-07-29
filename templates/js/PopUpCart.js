document.addEventListener('DOMContentLoaded', () => {
  // Referências para elementos do DOM
  const openBtn = document.getElementById('openCartPopup'); // Botão para abrir o popup do carrinho
  const popup = document.getElementById('CartPopup'); // Popup do carrinho
  const closeBtn = document.getElementById('closeCartPopup'); // Botão para fechar o popup
  const cartItemsContainer = popup.querySelector('.cart-items'); // Container onde ficam os itens do carrinho
  const totalPriceElem = document.getElementById('totalPrice'); // Elemento que mostra o total do carrinho
  const checkoutBtn = document.getElementById('checkoutBtn'); // Botão para finalizar a compra

  // Função para abrir o popup do carrinho
  function openPopup() { popup.style.display = 'flex'; }
  // Função para fechar o popup do carrinho
  function closePopup() { popup.style.display = 'none'; }

  // Fecha o popup ao clicar fora dele (no fundo escuro)
  window.addEventListener('click', e => { if (e.target === popup) closePopup(); });
  // Fecha o popup ao clicar no botão fechar
  closeBtn.addEventListener('click', closePopup);
  // Abre o popup ao clicar no botão abrir carrinho (previne comportamento padrão)
  openBtn.addEventListener('click', e => { e.preventDefault(); openPopup(); });

  // Atualiza o total do carrinho somando os preços dos itens
  function updateTotal() {
    let total = 0;
    cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
      total += parseFloat(item.getAttribute('data-price')) || 0;
    });
    totalPriceElem.textContent = total.toFixed(2); // Mostra com 2 casas decimais
  }

  // Cria um elemento visual para o item no carrinho
  function createCartItem(name, price, imageSrc) {
    const item = document.createElement('div');
    item.classList.add('cart-item');
    // Estilos básicos inline para organização do item
    item.style.display = 'flex';
    item.style.alignItems = 'center';
    item.style.justifyContent = 'space-between';
    item.style.borderBottom = '1px solid #ccc';
    item.style.padding = '8px 0';

    // Atributos custom para guardar informações do item
    item.setAttribute('data-price', parseFloat(price).toFixed(2));
    item.setAttribute('data-name', name);

    // HTML interno do item, com imagem, nome, preço e botão remover
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

    // Evento do botão remover para tirar o item do carrinho e atualizar o total
    item.querySelector('.remove-btn').addEventListener('click', () => {
      item.remove();
      updateTotal();
    });

    return item;
  }

  // Para cada botão de comprar, adiciona evento para colocar o item no carrinho
  document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();

      // Pega os dados do produto dos atributos data-*
      const name = button.getAttribute('data-name');
      const price = button.getAttribute('data-price');
      const image = button.getAttribute('data-image');

      // Cria o elemento do item e adiciona ao container do carrinho
      const cartItem = createCartItem(name, price, image);
      cartItemsContainer.appendChild(cartItem);

      updateTotal(); // Atualiza o total
      openPopup(); // Abre o popup para mostrar o carrinho
    });
  });

  // Evento do botão finalizar compra
  checkoutBtn.addEventListener('click', () => {
    // Se o carrinho estiver vazio, avisa o usuário e cancela
    if (cartItemsContainer.children.length === 0) {
      alert('Seu carrinho está vazio!');
      return;
    }

    // Cria um array com os dados dos itens no carrinho para enviar ao servidor
    const items = [];
    cartItemsContainer.querySelectorAll('.cart-item').forEach(item => {
      items.push({
        name: item.getAttribute('data-name'),
        price: parseFloat(item.getAttribute('data-price')),
        image: item.querySelector('img')?.getAttribute('src') || '',
      });
    });

// Faz requisição POST para o PHP que finaliza o pagamento, enviando os itens como JSON
fetch('../Controller/finalizarPagamento.php', {
  method: 'POST', // Usa método POST para enviar dados com segurança e não via URL
  headers: { 'Content-Type': 'application/json' }, // Define o cabeçalho informando que o corpo da requisição é JSON
  body: JSON.stringify({ items }), // Transforma o objeto JavaScript 'items' em string JSON para enviar ao servidor
})
.then(res => {
  // Lê a resposta como texto para facilitar debug, já que às vezes o servidor pode enviar algo inválido
  return res.text().then(text => {
    console.log('Resposta bruta do servidor:', text); // Mostra a resposta bruta no console
    try {
      // Tenta transformar o texto recebido em objeto JSON para manipular no JS
      return JSON.parse(text);
    } catch (err) {
      // Caso o texto não seja um JSON válido, mostra o erro no console e lança exceção para tratar depois
      console.error('Erro ao fazer parse do JSON:', err);
      throw err;
    }
  })
})
.then(data => {
  // Se o servidor retornou sucesso, mostra mensagem, limpa o carrinho e fecha popup
  if (data.success) {
    alert('Pagamento finalizado com sucesso! Obrigado pela compra.');
    cartItemsContainer.innerHTML = ''; // Remove todos os itens do carrinho
    updateTotal(); // Atualiza o total (zerando)
    closePopup(); // Fecha o popup do carrinho
  } else {
    // Se o servidor retornou erro, mostra a mensagem recebida
    alert('Erro ao finalizar o pagamento: ' + (data.message || ''));
  }
})
.catch((error) => {
  // Caso a requisição falhe (ex: servidor off, erro de rede), mostra alerta ao usuário
  alert('Erro na comunicação com o servidor: ' + error.message);
    });
  });
});
