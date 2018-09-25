<div class="content__main-col">

    <header class="content__header">
        <h2 class="content__header-text">Результаты поиска</h2>
        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <?php if (count($gifs)): ?>
    <?=include_template('_grid.php', ['gifs' => $gifs]); ?>
    <?php else: ?>
    <p>По вашему запросу ничего не найдено</p>
    <?php endif; ?>
</div>