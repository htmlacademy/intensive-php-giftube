<div class="content__main-col">
	<header class="content__header content__header--left-pad">
		<h2 class="content__header-text">Восстановление пароля</h2>

		<a class="button button--transparent content__header-button" href="/">Назад</a>
	</header>

	<?php if (!$success): ?>
	<form class="form" action="" method="post">
		<div class="form__column">
			<div class="form__row">
				<label class="form__label" for="email">Ваш email:</label>
				<input class="form__input" type="text" name="email" id="email">
			</div>
		</div>

		<div class="form__controls">
			<input class="button form__control" type="submit" name="" value="Восстановить">
		</div>
	</form>
	<?php else: ?>
		<p style="color: black">Вам на почту отправлено письмо с инструкцией по восстановлению.</p>
	<?php endif; ?>
</div>