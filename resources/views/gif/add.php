<?php $this->layout('layout');
$f = $form;
?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Добавить гифку</h2>

        <a class="button button--transparent content__header-button" href="#">Назад</a>
    </header>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form__columns">
            <div class="form__column form__column--short">
                <div class="form__row">
                    <label class="form__label" for="preview">GIF файл:</label>

                    <div class="upload">
                        <div class="preview">
                            <button class="preview__remove" type="button">Удалить</button>
                            <img class="preview__img" src="img/no-pic.png" alt="" width="192" height="192">
                        </div>

                        <div class="form__input-file">
                            <input class="visually-hidden" type="file" name="gif[path]" id="preview" value="">

                            <label for="preview" class="<?php if ($f->getError('path')): ?>form__input--error<?php endif; ?>">
                                <span>Выбрать файл</span>
                            </label>

                            <?php if ($err = $f->getError('path')): ?>
                                <div class="error-notice">
                                    <span class="error-notice__icon"></span>
                                    <span class="error-notice__tooltip"><?=$err;?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__column">
                <div class="form__row">
                    <label class="form__label" for="category">Категория:</label>

                    <select class="form__input form__input--select <?php if ($f->getError('category')): ?>form__input--error<?php endif; ?>"
                            name="gif[category]" id="category">
                        <option value="">Выберите категорию</option>
                        <?php foreach ($categoryModel->findAllBy() as $cat): ?>
                            <option value="<?=$cat->id;?>"
                            <?php if ($cat->id == $f->category): ?>selected<?php endif; ?> >
                                <?= $cat->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if ($err = $f->getError('category')): ?>
                        <div class="error-notice">
                            <span class="error-notice__icon"></span>
                            <span class="error-notice__tooltip"><?=$err;?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form__row">
                    <label class="form__label" for="name">Название:</label>
                    <input class="form__input <?php if ($f->getError('title')): ?>form__input--error<?php endif; ?>"
                           type="text" name="gif[title]" id="name" value="<?=$this->e($f->title);?>"
                           placeholder="Введите название">

                    <?php if ($err = $f->getError('title')): ?>
                        <div class="error-notice">
                            <span class="error-notice__icon"></span>
                            <span class="error-notice__tooltip"><?=$err;?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form__row">
                    <label class="form__label" for="description">Описание:</label>
                    <textarea class="form__input <?php if ($f->getError('description')): ?>form__input--error<?php endif; ?>"
                              name="gif[description]" id="description" rows="5" cols="80"
                              placeholder="Краткое описание"><?=$this->e($f->description);?></textarea>

                    <?php if ($err = $f->getError('description')): ?>
                        <div class="error-notice">
                            <span class="error-notice__icon"></span>
                            <span class="error-notice__tooltip"><?=$err;?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

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

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Добавить">
        </div>
    </form>
</div>