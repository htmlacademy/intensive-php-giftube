<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <h2 class="visually-hidden">Смешные гифки</h2>

    <header class="content__header">
        <nav class="filter">
            <a class="filter__item filter__item--active" href="/">Топовые гифки</a>
            <a class="filter__item" href="/?tab=new">Свежачок</a>
        </nav>

        <a class="button button--transparent button--transparent-thick content__header-button" href="/gif/add">Загрузить свою</a>
    </header>

    <?php $this->insert('partials/_gifs_grid', ['gifs' => $gifs]); ?>

    <footer class="content__footer">
        <button class="content__load-button" type="button">
            <span>Мне нужно больше смешных гифок</span>
        </button>
    </footer>
</div>