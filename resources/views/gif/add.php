<?php $this->layout('layout'); ?>

<div class="content__main-col">
    <header class="content__header content__header--left-pad">
        <h2 class="content__header-text">Добавить гифку</h2>

        <a class="button button--transparent content__header-button" href="#">Назад</a>
    </header>

    <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form__columns">
            <div class="form__column form__column--short">
                <div class="form__row">
                    <label class="form__label" for="preview">Превью:</label>

                    <div class="upload">
                        <div class="preview">
                            <button class="preview__remove" type="button">Удалить</button>

                            <img class="preview__img" src="img/no-pic.png" alt="" width="192" height="192">
                        </div>

                        <div class="form__input-file">
                            <input class="visually-hidden" type="file" name="gif[path]" id="preview" value="">

                            <label for="preview">
                                <span>Выбрать файл</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__column">
                <div class="form__row">
                    <label class="form__label" for="category">Категория:</label>

                    <select class="form__input form__input--select" name="gif[category]" id="category">
                        <option value="">Выберите категорию</option>
                        <?php foreach ($categoryModel->getAll() as $cat): ?>
                            <option value="<?=$cat->id;?>"
                            <?php if ($cat->id == $form->category): ?>selected<?php endif; ?> >
                                <?= $cat->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form__row">
                    <label class="form__label" for="name">Название:</label>
                    <input class="form__input" type="text" name="gif[title]" id="name" value="<?=$form->title;?>"
                           placeholder="Введите название">
                </div>

                <div class="form__row">
                    <label class="form__label" for="description">Описание:</label>
                    <textarea class="form__input" name="gif[description]" id="description" rows="5" cols="80"
                              placeholder="Краткое описание"><?=$form->description;?></textarea>
                </div>
            </div>
        </div>

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

        <div class="form__controls">
            <input class="button form__control" type="submit" name="" value="Добавить">
        </div>
    </form>
</div>