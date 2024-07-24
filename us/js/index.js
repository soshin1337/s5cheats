document.addEventListener('DOMContentLoaded', function () {
    loadContent("navbar", "/navbar.php");
    loadContent("footer", "/footer.php");

    window.addEventListener('load', function () {
        var toggleButton = document.getElementById('toggle-btn');
        var menu = document.getElementById('menu');
        var isOpen = false;

        toggleButton.addEventListener('click', function () {
            if (isOpen) {
                animateMenu(0, 0);
            } else {
                animateMenu(500, 1);
            }
        });

        function animateMenu(targetHeight, targetOpacity) {
            var startHeight = menu.offsetHeight;
            var startOpacity = parseFloat(window.getComputedStyle(menu).opacity);

            var duration = 500;
            var startTime = null;

            function animate(currentTime) {
                if (!startTime) startTime = currentTime;

                var progress = currentTime - startTime;

                menu.style.maxHeight = (progress / duration) * (targetHeight - startHeight) + startHeight + 'px';
                menu.style.opacity = (progress / duration) * (targetOpacity - startOpacity) + startOpacity;

                if (progress < duration) {
                    requestAnimationFrame(animate);
                } else {
                    menu.style.maxHeight = targetHeight + 'px';
                    menu.style.opacity = targetOpacity;
                    isOpen = !isOpen;
                }
            }

            requestAnimationFrame(animate);
        }
    });

});

function loadContent(elementId, contentFile) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", contentFile, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById(elementId).innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
