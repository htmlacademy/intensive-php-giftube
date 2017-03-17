<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Регистрация</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post">
        <div class="form__column">
            <div class="form__row">
                <label class="form__label" for="email">E-mail:</label>

                <input class="form__input" type="text" name="signup[email]" id="email"
                       value="<?=$this->e($form->email); ?>" placeholder="Укажите e-mail">
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль:</label>

                <input class="form__input" type="password" name="signup[password]" id="password"
                       value="<?=$this->e($form->password); ?>" placeholder="Задайте пароль">
            </div>

            <div class="form__row">
                <label class="form__label" for="nickname">Имя:</label>

                <input class="form__input" type="text" name="signup[name]" id="nickname"
                       value="<?=$this->e($form->name); ?>" placeholder="Ваш никнейм на сайте">
            </div>

            <div class="form__row">
                <label class="form__label" for="avatar">Фото:</label>

                <div class="form__input-file">
                    <input class="visually-hidden" type="file" name="signup[avatar]" id="avatar" value="Выбрать файл:">

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