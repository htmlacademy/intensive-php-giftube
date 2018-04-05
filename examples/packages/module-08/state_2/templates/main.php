<div class="content__main-col">
    <h2 class="visually-hidden">Смешные гифки</h2>

    <header class="content__header">
        <nav class="filter">
            <a class="filter__item" href="/">Топовые гифки</a>
            <a class="filter__item" href="/?tab=new">Свежачок</a>
        </nav>

        <a class="button button--transparent button--transparent-thick content__header-button" href="/add.php">Загрузить свою</a>
    </header>

    <?=include_template('_grid.php', ['gifs' => $gifs]); ?>
    <?=include_template('_pagination.php', [
            'pages' => $pages,
            'pages_count' => $pages_count,
            'cur_page' => $cur_page
    ]); ?>
</div>