<?php $this->layout('layout');
$f = $form;
?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Вход для своих</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post">
        <div class="form__column">
            <?php if (!$f->isValid()): ?>
                <div class="form__errors">
                    <p>Пожалуйста, исправьте следующие ошибки:</p>
                    <ul>
                        <?php foreach ($f->getAllErrors() as $field => $error): ?>
                            <li><strong><?=$f->getLabelFor($field);?>:</strong> <?=$error;?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form__row">
                <label class="form__label" for="email">E-mail:</label>
                <input class="form__input <?php if ($f->getError('email')): ?>form__input--error<?php endif; ?>"
                       type="text" name="login[email]" id="email"
                       value="<?=$f->email;?>" placeholder="Укажите e-mail">

                <?php if ($err = $f->getError('email')): ?>
                <div class="error-notice">
                    <span class="error-notice__icon"></span>
                    <span class="error-notice__tooltip"><?=$err;?></span>
                </div>
                <?php endif; ?>
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль:</label>
                <input class="form__input <?php if ($f->getError('password')): ?>form__input--error<?php endif; ?>"
                       type="password" name="login[password]" id="password" placeholder="Введите пароль">

                <?php if ($err = $f->getError('password')): ?>
                    <div class="error-notice">
                        <span class="error-notice__icon"></span>
                        <span class="error-notice__tooltip"><?=$err;?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Войти">
        </div>
    </form>
</div>