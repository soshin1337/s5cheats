let itemsPerPage = 10;
let currentPage = 1;
let totalItems = 0;

const api = {
    fetchItems: async function(page, limit) {
        try {
            const response = await fetch(`/api/items?page=${page}&limit=${limit}`);
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Error fetching items:', error);
            return {
                items: [],
                totalItems: 0
            };
        }
    }
};

async function loadItems() {
    try {
        showGlobalLoader();
        const result = await api.fetchItems(currentPage, itemsPerPage);
        totalItems = result.totalItems;
        renderItems(result.items);
        updatePagination();
    } catch (error) {
        console.error('Error loading items:', error);
    } finally {
        hideGlobalLoader();
    }
}

function renderItems(items) {
    const itemsList = document.getElementById('items-list');
    itemsList.innerHTML = '';

    if (items.length === 0) {
        const emptyMessage = document.createElement('div');
        emptyMessage.className = 'empty-message';
        emptyMessage.textContent = 'Вы еще не купили ни одного товара';
        itemsList.appendChild(emptyMessage);
    } else {
        items.forEach(function(item) {
            const itemCard = createItemCard(item);
            itemsList.appendChild(itemCard);
        });
    }

    updatePagination();
}

function createItemCard(item) {
    const itemCard = document.createElement('div');
    itemCard.className = 'item-card';

    let keyHtml = '';
    let keysButton = '';

    if (item.key !== 'multiple') {
        keyHtml = `
          <p class="key-text">Ключ: <span class="key-value">${item.key}</span>
              <button class="copy-button">
                  <i class="fas fa-copy copy-icon" aria-label="Copy to clipboard" tabindex="0"></i>
              </button>
          </p>`;
    } else {
        keysButton = `<button class="loader-button" data-keys-path="${item.keys_path}" onclick="downloadKeys(this)">Скачать ключи</button>`;
    }

    itemCard.innerHTML = `
      <div class="item-info">
          <span style="user-select: none">${item.name} - ${item.price}</span>
          <span class="purchase-date" style="user-select: none">${item.purchaseDate}</span>
      </div>
      <div class="item-details">
          <p class="key-text">Номер заказа: <span class="key-value">${item.orderId}</span>
              <button class="copy-button">
                  <i class="fas fa-copy copy-icon" aria-label="Copy to clipboard" tabindex="0"></i>
              </button>
          </p>
          ${keyHtml}
          <div class="button-container">
              <button class="loader-button" onclick="openURL('${item.manualUrl}')">Инструкция</button>
              <button class="loader-button" onclick="openURL('${item.loaderUrl}')">Скачать лоадер</button>
          </div>
          <div class="button-container">
              <button product_id="${item.productId}" product_type="${item.productType}" class="loader-button repeat-purchase" onclick="buyAgain(this)">Повторить покупку</button>
              ${keysButton}
          </div>
      </div>
  `;

    return itemCard;
}

function handleItemClick(e) {
    const itemCard = e.target.closest('.item-card');
    if (itemCard && !e.target.closest('.item-details')) {
        toggleDetails(itemCard);
    }
    if (e.target.closest('.copy-button')) {
        const keyValue = e.target.closest('.key-text').querySelector('.key-value').textContent;
        copyKey(keyValue);
    }
}

function toggleDetails(itemCard) {
    itemCard.classList.toggle('expanded');
    document.querySelector('.purchased-items').classList.toggle('expanded');
}

function copyKey(key) {
    navigator.clipboard.writeText(key).catch(function(err) {
        console.error('Ошибка при копировании: ', err);
    });
}

function updatePagination() {
    const loadMoreButton = document.getElementById('load-more');
    if (totalItems === 0 || currentPage * itemsPerPage >= totalItems) {
        loadMoreButton.style.display = 'none';
    } else {
        loadMoreButton.style.display = 'block';
    }
}

function downloadKeys(button) {
    showButtonLoader(button);
    const keysPath = button.getAttribute('data-keys-path');
    const link = document.createElement('a');
    link.href = keysPath;
    link.download = keysPath.split('/').pop();
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    setTimeout(function() {
        hideButtonLoader(button);
    }, 1000);
}

function loadMoreItems() {
    currentPage++;
    loadItems();
}

function showGlobalLoader() {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'block';
}

function hideGlobalLoader() {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'none';
}

function showButtonLoader(button) {
    const originalName = button.innerHTML;
    button.innerHTML = 'Загрузка...';
    button.disabled = true;
    setTimeout(function() {
        button.innerHTML = originalName;
        button.disabled = false;
    }, 1000);
}

function buyAgain(button) {
    // showButtonLoader(button);
    const product_id = button.getAttribute('product_id');
    const product_type = button.getAttribute('product_type');
    window.open(`${window.location.protocol}//${window.location.hostname}/pay?product_id=${product_id}&product_type=${product_type}`, '_blank');
    // setTimeout(function() {
    //     hideButtonLoader(button);
    // }, 1000);
}

function openURL(url) {
    if (!/^https?:\/\//i.test(url)) {
        url = 'https://' + url;
    }
    window.open(url, '_blank');
}

document.addEventListener('DOMContentLoaded', loadItems);
document.getElementById('items-list').addEventListener('click', handleItemClick);
document.getElementById('load-more').addEventListener('click', loadMoreItems);
document.getElementById('supButton').addEventListener('click', function() {
    window.open('https://t.me/s5cheats_boss', '_blank');
});