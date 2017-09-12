<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Регистрация</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form__column">
            <?php if (count($errors)): ?>
                <div class="form__errors">
                    <p>Пожалуйста, исправьте следующие ошибки:</p>
                    <ul>
                        <?php foreach ($errors as $field => $error): ?>
                            <li><strong><?=$field;?></strong>: <?=$error;?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form__row">
                <label class="form__label" for="email">E-mail:</label>

                <input class="form__input <?php if (isset($errors['email'])): ?>form__input--error<?php endif; ?>"
                        type="text" name="signup[email]" id="email"  placeholder="Ваш e-mail"
                        value="<?=htmlspecialchars($f['email']); ?>">
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль:</label>

                <input class="form__input <?php if (isset($errors['password'])): ?>form__input--error<?php endif; ?>"
                       type="password" name="signup[password]" id="password"
                       placeholder="Задайте пароль">
            </div>

            <div class="form__row">
                <label class="form__label" for="nickname">Имя:</label>

                <input class="form__input <?php if (isset($errors['name'])): ?>form__input--error<?php endif; ?>"
                       type="text" name="signup[name]" id="nickname"
                      placeholder="Ваш никнейм на сайте" value="<?=htmlspecialchars($f['name']); ?>">
            </div>

            <div class="form__row">
                <label class="form__label" for="avatar">Фото:</label>

                <div class="form__input-file">
                    <input class="visually-hidden" type="file" name="signup[avatar]" id="preview" value="Выбрать файл:">

                    <label for="preview">
                        <span>Выбрать файл</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Отправить">
        </div>
    </form>
</div>