<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<base href="/">
	<title><?=$config['sitename'];?></title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/custom.css">
</head>

<body>
<div class="container">
	<header class="main-header">
		<h1 class="visually-hidden">Giftube</h1>

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
					<?php foreach ($categories as $cat): ?>
						<a href=""><?=$cat; ?></a>
					<?php endforeach; ?>
				</nav>
			</div>
		</section>

		<main class="content">
			<div class="content__main-col">
				<h2 class="visually-hidden">Смешные гифки</h2>

				<header class="content__header">
					<nav class="filter">
						<a class="filter__item" href="">Топовые гифки</a>
						<a class="filter__item" href="">Свежачок</a>
					</nav>

					<a class="button button--transparent button--transparent-thick
					content__header-button" href="">Загрузить свою</a>
				</header>

				<ul class="gif-list">
					<?php foreach($gifs as $gif): ?>
						<li class="gif gif-list__item">
							<div class="gif__picture">
								<a href="" class="gif__preview">
									<img src="uploads/preview_<?=$gif['gif']; ?>" width="260" height="260">
								</a>
							</div>
							<div class="gif__desctiption">
								<h3 class="gif__desctiption-title">
									<a href=""><?=cut_text($gif['title'], 50); ?></a>
								</h3>

								<div class="gif__description-data">
									<span class="gif__username">@<?=$gif['author'];?></span>
									<span class="gif__likes">0</span>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</main>
	</div>

	<footer class="main-footer">
		<div class="main-footer__col">
			Если у вас вдруг возникли вопросы, свяжитесь с нами по почте:
			<a href="mailto:info@giftube.com">info@giftube.com</a>.
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
<script>
    document.domain = "phpdemo.ru";
</script>
</html>