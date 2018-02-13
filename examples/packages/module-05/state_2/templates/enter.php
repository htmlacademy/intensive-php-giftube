<div class="content__main-col">
  <header class="content__header content__header--left-pad">
    <h2 class="content__header-text">Вход для своих</h2>

    <a class="button button--transparent content__header-button" href="/">Назад</a>
  </header>

  <form class="form" action="" method="post">
    <div class="form__column">
      <div class="form__row">
				<?php $classname = isset($errors['email']) ? "form__input--error" : "";
				$value = isset($form['email']) ? $form['email'] : ""; ?>

        <label class="form__label" for="email">E-mail:</label>
        <input class="form__input <?=$classname;?>" type="text" name="email"
               id="email" value="<?=$value;?>">

				<?php if ($classname): ?>
          <div class="error-notice">
            <span class="error-notice__icon"></span>
            <span class="error-notice__tooltip"><?=$errors['email'];?></span>
          </div>
				<?php endif; ?>
      </div>

      <div class="form__row">
				<?php $classname = isset($errors['password']) ? "form__input--error" : "";
				$value = isset($form['password']) ? $form['password'] : ""; ?>

        <label class="form__label" for="password">Пароль:</label>
        <input class="form__input <?=$classname;?>" type="password"
               name="password" id="password">

				<?php if ($classname): ?>
          <div class="error-notice">
            <span class="error-notice__icon"></span>
            <span class="error-notice__tooltip"><?=$errors['password'];?></span>
          </div>
				<?php endif; ?>
      </div>
    </div>

    <div class="form__controls">
      <input class="button form__control" type="submit" name="" value="Войти">
    </div>
  </form>
</div>