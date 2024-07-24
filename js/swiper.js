const dataMentor = [
    {
        imgMain: '../images/swiper/dayz.png',
        altImgMain: 'картинка игры DayZ',
        nameGame: 'DayZ',
        nameColor: '#419c76',
        linkSvgImg: 'https://collapse.fun/wp-content/uploads/2021/12/line_dayz.png',
        linkGame: '../products/dayz-choose'

    },
    {
        imgMain: '../images/swiper/tarkov.png',
        altImgMain: 'картинка игры Tarkov',
        nameGame: 'Tarkov',
        nameColor: '#d28946',
        linkSvgImg: 'https://collapse.fun/wp-content/uploads/2021/11/arrow_game_tarkov.svg',
        linkGame: '../products/escape-from-tarkov-choose'

    },
    {
        imgMain: '../images/swiper/rust.png',
        altImgMain: 'картинка игры Rust',
        nameGame: 'Rust',
        nameColor: '#c5412b',
        linkSvgImg: 'https://collapse.fun/wp-content/uploads/2021/11/arrow_game_rust-1.svg',
        linkGame: '../products/rust-choose'

    },
    {
        imgMain: '../images/swiper/ap-leng.png',
        altImgMain: 'картинка игры Apex Legends',
        nameGame: 'Apex Legends',
        nameColor: '#56f5f5',
        linkSvgImg: 'https://collapse.fun/wp-content/uploads/2021/11/arrow_game_dbd.svg',
        linkGame: '../products/apex-choose'
    },
    {
        imgMain: '../images/swiper/valarnt.png',
        altImgMain: 'картинка игры Valorant',
        nameGame: 'Valorant',
        nameColor: '#4799f4',
        linkSvgImg: 'https://collapse.fun/wp-content/uploads/2022/07/line_name_cycle.svg',
        linkGame: '../products/valorant-choose'
    }
];

const dataGameSelector = [
    {
        nameInput: 'mainGameSliderRadio',
        imgDisable: '../images/swiper/logo_DayZ.png',
        altImgDisable: "Иконка игры DayZ",
        imgActive: '../images/swiper/logo_DayZ_hover.png',
        altImgActive: 'Иконка игры DayZ подсвеченная'
    },
    {
        nameInput: 'mainGameSliderRadio',
        imgDisable: '../images/swiper/icon_tarkov.svg',
        altImgDisable: "Иконка игры Escape From Tarkov",
        imgActive: '../images/swiper/icon_tarkov_active.svg',
        altImgActive: 'Иконка игры Escape From Tarkov подсвеченная'
    },
    {
        nameInput: 'mainGameSliderRadio',
        imgDisable: '../images/swiper/icon_rust.svg',
        altImgDisable: "Иконка игры Rust (Full)",
        imgActive: '../images/swiper/icon_rust_active.svg',
        altImgActive: 'Иконка игры Rust (Full) подсвеченная'
    },
    {
        nameInput: 'mainGameSliderRadio',
        imgDisable: '../images/swiper/apex-lengen.svg',
        altImgDisable: "Иконка игры Apex-legend",
        imgActive: '../images/swiper/apex-lengen-active.svg',
        altImgActive: 'Иконка игры Apex-legend подсвеченная'
    },
    {
        nameInput: 'mainGameSliderRadio',
        imgDisable: '../images/swiper/valorant-logo.svg',
        altImgDisable: "Иконка игры PalWorld",
        imgActive: '../images/swiper/valorant-logo-active.svg',
        altImgActive: 'Иконка игры PalWorld подсвеченная'
    },
]


document.addEventListener("DOMContentLoaded", function () {
    const timerBar = document.querySelector(".main__timerBar");

    const swiper = new Swiper("#mainSwiper", {
        speed: 400,
        autoplay: {
            delay: 2000,
            disableOnInteraction: true,
        },
        navigation: {
            nextEl: ".controls__btn-next",
            prevEl: ".controls__btn-prev",
        },
        pagination: {
            el: ".controls__swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            },
        },
        on: {
            autoplayTimeLeft(s, time, progress) {
                if (!isNaN(progress)) {
                    const heightPercentage = (1 - progress) * 100;
                    timerBar.style.height = `${heightPercentage}%`;
                    timerBar.style.bottom = "0";
                }
            },
            transitionEnd() { // Обработчик события окончания анимации
                timerBar.style.height = "0%";
                timerBar.classList.add("closing"); // Добавить класс для анимации
            }
        },
        onlyExternal: true
    });


    swiper.on('init', function () {
        console.log('Swiper инициализирован');
        generationGameSelector();
    });

    swiper.on('slideChange', function () {
        console.log('Изменение слайда. Новый индекс:', swiper.activeIndex);
        activateGameSelectorItem(swiper.activeIndex); // Активируем соответствующий элемент селектора игр
    });

    const activateGameSelectorItem = (index) => {
        console.log('Активация элемента с индексом', index);
        const gameSelectorItems = document.querySelectorAll('.gameSelector__item');
        gameSelectorItems.forEach((item, idx) => {
            const imgActive = item.querySelector('.gameSelector__img--active');
            if (idx === index) {
                imgActive.style.opacity = 1; // Делаем активное изображение видимым
            } else {
                imgActive.style.opacity = 0; // Скрываем активное изображение для остальных элементов
            }
        });
    };


    const mentorDirectorySwiper = () => {
        const results = document.getElementById("mentor-swiper-results");

        const cardsMentor = dataMentor.map(
            (review) => `
            <div class="swiper-slide">
                <div class="main__content">
                    
                    <div class="main__content-img">
                        <div class="main__content-info">
                            <div class="main__content-info--picture">
                                <img class="main__content--info--img"
                                    src="${review.linkSvgImg}"
                                    alt="Полоса до игры DayZ">
                            </div>
                            <div class="main__content--info-content">
                                <h5 class="main__content--info-title" style="Color:${review.nameColor};">${review.nameGame}</h5>
                            </div>
                        </div>
                        <img src="${review.imgMain}" alt="${review.altImgMain}">
                    </div>
                    <div class="main__content-body">
                        <div class="main__content-texts">
                            <h2 class="main__content-welcome">Добро пожаловать в</h2>
                            <h1 class="main__content-title"> s5cheats </h1>
                            <p class="main__content-text">
                                Лучшие частные читы для популярных игр от опытных разработчиков!
                            </p>
                        </div>
                        <div class="main__content-buttons">
                            <a href="${review.linkGame}" class="main__content-buttons--inner">
                                перейти к продукту
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `
        );

        results.innerHTML = cardsMentor.join("");
    };

    mentorDirectorySwiper();

    const generationGameSelector = () => {
        const results = document.getElementById("generation-Game-Selector");
        const cardsGameSelector = dataGameSelector.map((review, index) => {
            return (
                `<div class="gameSelector__item" >      
                <label class="gameSelector__container">
                    <input class="gameSelector__radio visually-hidden" type="radio" name="${review.nameInput}" data-index="${index}" ${index === 0 ? 'checked' : ''}>
                    <img class="gameSelector__img gameSelector__img--disable" src="${review.imgDisable}" alt="${review.altImgDisable}">
                    <img class="gameSelector__img gameSelector__img--active" src="${review.imgActive}" alt="${review.altImgActive}">
                </label>
                </div>`
            );
        });
        results.innerHTML = cardsGameSelector.join("");
        activateGameSelectorItem(0); // Устанавливаем активный класс для первого элемента при генерации

        // Добавляем обработчики событий для каждой радио-кнопки внутри gameSelector__item
        const radioButtons = document.querySelectorAll('.gameSelector__radio');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                const index = parseInt(this.getAttribute('data-index'));
                swiper.slideTo(index); // Переходим к слайду с индексом, соответствующим выбранному элементу
            });
        });
    };

    generationGameSelector()
})
