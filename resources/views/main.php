<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <h2 class="visually-hidden">Смешные гифки</h2>

    <header class="content__header">
        <nav class="filter">
            <a class="filter__item filter__item--active" href="#">Топовые гифки</a>

            <a class="filter__item" href="#">Свежачок</a>

            <a class="filter__item" href="#">Выбор редакции</a>
        </nav>

        <a class="button button--transparent button--transparent-thick content__header-button" href="#">Загрузить свою</a>
    </header>

    <ul class="gif-list">
        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-1.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">Когда выиграл гивэвэй</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@Luckyman13</span>

                    <span class="gif__likes">14k</span>
                </div>
            </div>
        </li>

        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-2.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">Моя жена бьютиблогер</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@Сеня-Ровный</span>

                    <span class="gif__likes">350</span>
                </div>
            </div>
        </li>

        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-3.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">Купил Бентли в ипотеку</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@Егор-Автомэн</span>

                    <span class="gif__likes">666</span>
                </div>
            </div>
        </li>

        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-4.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">Вейп: анбоксинг, первые и последние впечатления</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@Гиктест-инфо</span>

                    <span class="gif__likes">13</span>
                </div>
            </div>
        </li>

        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-5.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">Стала сетевиком и зарабатываю миллионы</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@WOWVICTORIA</span>

                    <span class="gif__likes">80k</span>
                </div>
            </div>
        </li>

        <li class="gif gif-list__item">
            <div class="gif__picture">
                <button type="button">Проиграть</button>

                <img src="img/GIF-6.jpg" alt="" width="260" height="260">
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="#">#Лэгздэй — качаем квадрицепсы правильно</a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@Crossfit-Semenovich</span>

                    <span class="gif__likes">808k</span>
                </div>
            </div>
        </li>
    </ul>

    <footer class="content__footer">
        <button class="content__load-button" type="button">
            <span>Мне нужно больше смешных гифок</span>
        </button>
    </footer>
</div>