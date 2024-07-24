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

    // Добавление функционала // Добавление функционала 

    // Получаем все ссылки с классом ".product-description-link"
    const accLinks = document.querySelectorAll(".product-description-link");

    // Для каждой ссылки добавляем слушатель события "click"
    accLinks.forEach(function (accLink) {
        accLink.addEventListener("click", function (e) {
            // Отменяем стандартное действие по клику на ссылку
            e.preventDefault();

            // Проверяем, содержит ли текущая ссылка класс активности
            const isActive = accLink.classList.contains("product-description-link--active");

            // Для каждой ссылки удаляем класс активности, скрываем текст и меняем стиль плюса и иконки
            accLinks.forEach(function (link) {
                link.classList.remove("product-description-link--active");
                link.querySelector(".product-description-text").style.display = "none";
                link.querySelector(".plus").classList.remove("inverted");
                link.querySelector(".open__icon").classList.remove('open');
            });

            // Если текущая ссылка не активна, добавляем класс активности, показываем текст и меняем стиль плюса и иконки
            if (!isActive) {
                accLink.classList.add("product-description-link--active");
                accLink.querySelector(".product-description-text").style.display = "block";
                accLink.querySelector(".plus").classList.add("inverted");
                accLink.querySelector(".open__icon").classList.add('open');
            }
        });
    });

    // Обертка для добавления слушателей событий наведения мыши
    const HoverListenersWrapper = () => {
        const addHoverListeners = (triggerSelector, contentSelector) => {
            // Получаем элемент-триггер и элемент-контент по селекторам
            const trigger = document.querySelector(triggerSelector);
            const content = document.querySelector(contentSelector);

            // Функция для скрытия контента
            const hideContent = () => {
                content.style.display = "none";
            };
            // Функция для показа контента
            const showContent = () => {
                content.style.display = "block";
            };

            // Добавляем слушатели событий для показа и скрытия контента при наведении мыши
            trigger.addEventListener("mouseover", showContent);
            trigger.addEventListener("mouseout", hideContent);
        };

        // Вызываем функцию добавления слушателей событий для тултипов
        addHoverListeners(".tooltip", ".tooltip-text");
    };

    // Вызываем обертку для добавления слушателей событий наведения мыши
    HoverListenersWrapper();


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
