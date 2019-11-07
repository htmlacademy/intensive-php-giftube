<div class="content__main-col">
   <header class="content__header content__header--left-pad">
      <h2 class="content__header-text">Добавить гифку</h2>

      <a class="button button--transparent content__header-button" href="/">Назад</a>
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
                     <input class="visually-hidden" type="file" name="gif_img" id="preview" value="">
                     <label for="preview" class="">
                        <span>Выбрать файл</span>
                     </label>
                  </div>
               </div>
            </div>
         </div>
         <div class="form__column">
            <div class="form__row">
               <label class="form__label" for="category">Категория:</label>
                <?php $classname = isset($errors['category_id']) ? "form__input--error" : ""; ?>

               <select class="form__input form__input--select <?= $classname; ?>" name="category_id" id="category">
                  <option>Выбрать</option>
                 <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                      <?php if ($cat['id'] == getPostVal('category_id')): ?>selected<?php endif; ?>><?=$cat['name'];
                      ?></option>
                 <?php endforeach; ?>
               </select>
            </div>
            <div class="form__row">
              <?php $classname = isset($errors['title']) ? "form__input--error" : ""; ?>

               <label class="form__label" for="name">Название:</label>
               <input class="form__input <?= $classname; ?>" type="text" name="title"
                      id="name" value="<?= getPostVal('title'); ?>">
            </div>
            <div class="form__row">
              <?php $classname = isset($errors['description']) ? "form__input--error" : ""; ?>

               <label class="form__label " for="description">Описание:</label>
               <textarea class="form__input <?= $classname; ?>" name="description"
                         id="description"><?= getPostVal('description'); ?></textarea>
            </div>
         </div>
      </div>
     <?php if (isset($errors)): ?>
        <div class="form__errors">
           <p>Пожалуйста, исправьте следующие ошибки:</p>
           <ul>
             <?php foreach ($errors as $val): ?>
                <li><strong><?= $val; ?>:</strong></li>
             <?php endforeach; ?>
           </ul>
        </div>
     <?php endif; ?>
      <div class="form__controls">
         <input class="button form__control" type="submit" name="" value="Добавить">
      </div>
   </form>
</div>
