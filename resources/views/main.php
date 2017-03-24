<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <h2 class="visually-hidden">Смешные гифки</h2>

    <header class="content__header">
        <nav class="filter">
            <a class="filter__item <?php if ($ctrl->getParam('tab', 'top') == 'top'): ?>filter__item--active<?php endif;?>"
               href="/">Топовые гифки</a>
            <a class="filter__item <?php if ($ctrl->getParam('tab') == 'new'): ?>filter__item--active<?php endif;?>"
               href="/?tab=new">Свежачок</a>
        </nav>

        <a class="button button--transparent button--transparent-thick content__header-button" href="/gif/add">Загрузить свою</a>
    </header>

    <?php $this->insert('partials/_gifs_grid', ['paginator' => $paginator]); ?>
    <?php $this->insert('partials/_pagination', ['paginator' => $paginator]); ?>
</div>