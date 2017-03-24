<?php $this->layout('layout');
$f = $form;
?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Регистрация</h2>

        <a class="button button--transparent content__header-button" href="/">Назад</a>
    </header>

    <form class="form" action="" method="post" enctype="multipart/form-data">
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
                       type="text" name="signup[email]" id="email" value="<?=$this->e($f->email); ?>" placeholder="Ваш e-mail">

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
                       type="password" name="signup[password]" id="password" value="<?=$this->e($f->password); ?>"
                       placeholder="Задайте пароль">

                <?php if ($err = $f->getError('password')): ?>
                    <div class="error-notice">
                        <span class="error-notice__icon"></span>
                        <span class="error-notice__tooltip"><?=$err;?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form__row">
                <label class="form__label" for="nickname">Имя:</label>

                <input class="form__input <?php if ($f->getError('name')): ?>form__input--error<?php endif; ?>"
                       type="text" name="signup[name]" id="nickname"
                       value="<?=$this->e($f->name); ?>" placeholder="Ваш никнейм на сайте">

                <?php if ($err = $f->getError('name')): ?>
                    <div class="error-notice">
                        <span class="error-notice__icon"></span>
                        <span class="error-notice__tooltip"><?=$err;?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form__row">
                <label class="form__label" for="avatar">Фото:</label>

                <div class="form__input-file">
                    <input class="visually-hidden" type="file" name="signup[avatar]" id="preview" value="Выбрать файл:">

                    <label for="preview">
                        <span>Выбрать файл</span>
                    </label>

                    <?php if ($err = $f->getError('avatar')): ?>
                        <div class="error-notice">
                            <span class="error-notice__icon"></span>
                            <span class="error-notice__tooltip"><?=$err;?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Отправить">
        </div>
    </form>
</div>