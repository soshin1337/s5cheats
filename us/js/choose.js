function switchTab(index) {
    var buttons = document.querySelectorAll('.buy-buttons .btn');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });

    buttons[index].classList.add('active');

    var priceText = document.getElementById('priceText');
    switch (index) {
        case 0:
            //priceText.innerHTML = '₽300 <span class="days">/ 1 день</span>';
            priceText.innerText = '₽300';
            break;
        case 1:
            //priceText.innerHTML = '₽700 <span class="days">/ 7 дней</span>';
            priceText.innerText = '₽700';

            break;
        case 2:
            //priceText.innerHTML = '₽1300 <span class="days">/ 30 дней</span>';
            priceText.innerText = '₽1300';

            break;
        default:
            break;
    }   
}