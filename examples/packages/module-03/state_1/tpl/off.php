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

			</div>
		</form>
	</header>

	<div class="main-content">
		<section class="navigation">
			<h2 class="visually-hidden">Навигация</h2>
		</section>

		<main class="content">
			<div class="content__main-col">
				<h3 style="color: red;"><?=$error_msg;?></h3>
			</div>
		</main>
	</div>
</div>
</body>
</html>