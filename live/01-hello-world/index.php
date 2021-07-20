<?php
$title = "Giftube";
$topclass_name = "filter__item--active";
$admin_email = "info@giftube.com";
$show_gif = true;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<base href="/">
	<title>Главная страница | <?=$title;?></title>
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/custom.css">
</head>
<body>
<div class="container">
    <header class="main-header">
        <h1 class="visually-hidden"><?=$title;?></h1>

        <a class="logo" href="/">
            <img class="logo__img" src="../img/logotype.svg" alt="Giftube" width="160" height="38"></a>

        <form class="search" action="/search.php" method="get">
            <div class="search__control">
                <input class="search__text" type="text" name="q" value="" placeholder="Поиск гифки…">

                <div class="search__submit">
                    <input class="button" type="submit" name="" value="Найти">
                </div>
            </div>
        </form>
    </header>

    <div class="main-content">
        <section class="navigation">
            <h2 class="visually-hidden">Навигация</h2>

            <div class="navigation__item">
                <h3 class="navigation__title navigation__title--list">Категории</h3>
                <nav class="navigation__links">
                    <a href="/category?id=4">Видеоигры</a>
                    <a href="/category?id=2">Животные</a>
                    <a href="/category?id=8">Люди</a>
                    <a href="/category?id=6">Наука</a>
                    <a href="/category?id=5">Приколы</a>
                    <a href="/category?id=3">Спорт</a>
                    <a href="/category?id=7">Фейлы</a>
                    <a href="/category?id=1">Фильмы и анимация</a>
                </nav>
            </div>
        </section>
        <main class="content">
            <div class="content__main-col">
                <h2 class="visually-hidden">Смешные гифки</h2>
                <header class="content__header">
                    <nav class="filter">
                        <a class="filter__item <?=$topclass_name;?>" href="">Топовые гифки</a>
                        <a class="filter__item" href="">Свежачок</a>
                    </nav>
                    <a class="button button--transparent button--transparent-thick
					content__header-button" href="">Загрузить свою</a>
                </header>
                <ul class="gif-list">
                    <?php if ($show_gif): ?>
                    <li class="gif gif-list__item">
                        <div class="gif__picture">
                            <a href="" class="gif__preview">
                                <img src="uploads/preview_gif58dbdf3251fcf.gif" width="260" height="260">
                            </a>
                        </div>
                        <div class="gif__desctiption">
                            <h3 class="gif__desctiption-title">
                                <a href="">Премии на моей работе</a>
                            </h3>
                            <div class="gif__description-data">
                                <span class="gif__username">@frexin</span>
                                <span class="gif__likes">100500</span>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </main>
    </div>
    <footer class="main-footer">
        <div class="main-footer__col">
            Если у вас вдруг возникли вопросы, свяжитесь с нами по почте:
            <a href="mailto:<?=$admin_email;?>"><?=$admin_email;?></a>.
        </div>
        <div class="main-footer__col">
            Сохранение смешных гифок разрешено только для личного использования.
        </div>
        <div class="main-footer__col main-footer__col--short">
            <a class="copyright-logo" href="/">
                <img src="../img/htmlacademy.svg" alt="" width="27" height="34"></a>
        </div>
    </footer>
</div>
</body>
</html>