function switchTab(index) {
    var buttons = document.querySelectorAll('.buy-buttons .btn');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });
    var selectedButton = buttons[index];
    selectedButton.classList.add('active');
    
    var price = selectedButton.getAttribute('price');
    var days = selectedButton.getAttribute('days');
    var type = selectedButton.getAttribute('type');
    var priceText = document.getElementById('priceText');
    
    priceText.innerHTML = `₽${price} <span class="days">/ ${days} ${getDeclension(days)}</span>`;

    var payLink = document.getElementById('payLink');
    var url = new URL(payLink.href);
    url.searchParams.set('product_type', type);
    payLink.href = url.toString();
}

function getDeclension(days) {
    if (days == '1') return 'день';
    if (days == '7') return 'дней';
    if (days == '30') return 'дней';
    return 'дней';
}