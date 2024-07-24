document.getElementById('search').addEventListener('input', function () {
    var searchQuery = this.value.toLowerCase();
    var elements = document.querySelectorAll('#searchResults .item');

    elements.forEach(function (element) {
        var name = element.getAttribute('data-name').toLowerCase();
        if (name.includes(searchQuery)) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });
});
