<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Вход для своих</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post">
        <div class="form__column">
            <?php if (!$form->isValid()): ?>
                <div class="form__errors">
                    <p>Пожалуйста, исправьте следующие ошибки:</p>
                    <ul>
                        <?php foreach ($form->getErrors() as $field => $error): ?>
                            <li><strong><?=$form->getLabelFor($field);?>:</strong> <?=$error;?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form__row">
                <label class="form__label" for="email">E-mail:</label>
                <input class="form__input" type="text" name="login[email]" id="email" value="<?=$form->email;?>" placeholder="Укажите e-mail">

                <div class="error-notice">
                    <span class="error-notice__icon">Произошла ошибка</span>
                    <span class="error-notice__tooltip">Укажите, пожалуйста, полное ФИО как в паспорте, а не то, что вам вздумается.</span>
                </div>
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль:</label>
                <input class="form__input" type="password" name="login[password]" id="password" value="" placeholder="Введите пароль">
            </div>
        </div>

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Войти">

<!--            <a href="#">Забыл пароль</a>-->
        </div>
    </form>
</div>