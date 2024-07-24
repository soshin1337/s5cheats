// полная хуйня

// document.getElementById('search').addEventListener('input', function () {
//     var searchQuery = this.value.toLowerCase();
//     var elements = document.querySelectorAll('#searchResults .item');

//     elements.forEach(function (element) {
//         var name = element.getAttribute('data-name').toLowerCase();
//         if (name.includes(searchQuery)) {
//             element.style.display = 'block';
//         } else {
//             element.style.display = 'none';
//         }
//     });
// });


document.getElementById('search').addEventListener('input', function () {
    var searchQuery = this.value.toLowerCase();
    var elements = document.querySelectorAll('#searchResults > a');

    elements.forEach(function (element) {
        var name = element.querySelector('.item').getAttribute('data-name').toLowerCase();
        if (name.includes(searchQuery)) {
            element.style.display = ''; // Показываем элемент
        } else {
            element.style.display = 'none'; // Скрываем элемент
        }
    });
});
