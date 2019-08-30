<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Регистрация</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form__column">
            <?php if (isset($errors)): ?>
                <div class="form__errors">
                    <p>Пожалуйста, исправьте следующие ошибки:</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?=$error;?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="form__row">
                <label class="form__label" for="email">E-mail:</label>

                <input class="form__input"
                       type="text" name="email" id="email"  placeholder="Ваш e-mail"
                       value="<?=$values['email'] ?? ''; ?>">
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль:</label>

                <input class="form__input"
                       type="password" name="password" id="password"
                       placeholder="Задайте пароль">
            </div>

            <div class="form__row">
                <label class="form__label" for="nickname">Имя:</label>

                <input class="form__input"
                       type="text" name="name" id="nickname"
                       placeholder="Ваш никнейм на сайте" value="<?=$values['name'] ?? ''; ?>">
            </div>
        </div>

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Отправить">
        </div>
    </form>
</div>
