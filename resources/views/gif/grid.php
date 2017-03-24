<?php $this->layout('layout'); ?>
<div class="content__main-col">

<header class="content__header">
    <h2 class="content__header-text"><?=$name;?></h2>
    <a class="button button--transparent content__header-button" href="/">Назад</a>
</header>

<?php $this->insert('partials/_gifs_grid', ['paginator' => $paginator]); ?>
<?php $this->insert('partials/_pagination', ['paginator' => $paginator]); ?>

</div>