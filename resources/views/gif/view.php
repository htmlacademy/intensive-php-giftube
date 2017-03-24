<?php $this->layout('layout'); ?>
<?php
$author = $gif->getRelation('author');
$comments = $commentModel->findAllByField('gif_id', $gif->id);
$userModel = $user->getUserModel();
?>

<div class="content__main-col">
    <header class="content__header">
        <h2 class="content__header-text"><?=$this->e($gif->title);?></h2>
        <label for="gifControl">click</label>

    </header>

    <div class="gif gif--large">
        <div class="gif__picture">
            <input type="checkbox" name="" id="gifControl" value="1" class="hide">
            <label for="gifControl">Проиграть</label>
            <img src="uploads/<?=$gif->path;?>" alt="" class="gif_img main hide">
            <img src="uploads/preview_<?=$gif->path;?>" alt="" class="gif_img preview">
        </div>

        <div class="gif__desctiption">
            <div class="gif__description-data">
                <span class="gif__username">@<?=$this->e($author->name);?></span>

                <span class="gif__views"><?=$gif->show_count;?></span>
                <span class="gif__likes"><?=$gif->like_count;?></span>
            </div>
            <div class="gif__description">
                <p><?=$this->e($gif->description);?></p>
            </div>
        </div>

        <?php if (!$user->isGuest()): ?>
        <div class="gif__controls">
            <?php
            $isFavorite = $userModel->hasRelatedGif($gif, 'fav');
            $isLiked    = $userModel->hasRelatedGif($gif, 'like');

            $favClass = $isFavorite ? 'gif__control--active' : '';
            $favUrl   = $isFavorite ? '&rem=1' : '';

            $likeClass = $isLiked ? 'gif__control--active' : '';
            $likeUrl   = $isLiked ? '&rem=1' : ''; ?>

            <a class="button gif__control <?=$likeClass;?>" href="/gif/like?id=<?=$gif->id;?><?=$likeUrl;?>">Мне нравится</a>
            <a class="button gif__control <?=$favClass;?>" href="/gif/fav?id=<?=$gif->id;?><?=$favUrl;?>">В избранное</a>
        </div>
        <?php endif; ?>
    </div>

    <div class="comment-list">
        <h3 class="comment-list__title">Комментарии:</h3>

        <?php foreach ($comments as $comment) : ?>
        <article class="comment">
            <img class="comment__picture" src="uploads/<?=$comment['avatar_path'];?>" alt="" width="100" height="100">

            <div class="comment__data">
                <div class="comment__author">@<?=$this->e($comment['name']); ?></div>
                <p class="comment__text"><?=$this->e($comment['content']); ?></p>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <?php if (!$user->isGuest()): ?>
    <form class="comment-form" action="" method="post">
        <label class="comment-form__label" for="comment">Добавить комментарий:</label>
        <textarea class="comment-form__text <?php if ($form->getError('content')): ?>form__input--error<?php endif; ?>"
                  name="comment[content]" id="comment" rows="8" cols="80"
                  placeholder="Помните о правилах и этикете. "><?=$this->e($form->content); ?></textarea>
        <?php if ($err = $form->getError('content')): ?>
            <div class="error-notice">
                <span class="error-notice__icon"></span>
                <span class="error-notice__tooltip"><?=$err;?></span>
            </div>
        <?php endif; ?>

        <input type="hidden" name="comment[gif_id]" value="<?=$id;?>">
        <input class="button comment-form__button" type="submit" name="" value="Отправить">
    </form>
    <?php endif; ?>
</div>

<aside class="content__additional-col">
    <h3 class="content__additional-title">Похожие гифки:</h3>

    <ul class="gif-list gif-list--vertical">
        <?php foreach ($gif->findAllBy(['category_id' => $gif->category_id]) as $item): ?>
        <li class="gif gif--small gif-list__item">
            <div class="gif__picture">
                <a href="/gif/view?id=<?=$gif->id;?>" class="gif__preview">
                    <img src="uploads/preview_<?=$item->path;?>" alt="" width="200" height="200">
                </a>
            </div>
            <div class="gif__desctiption">
                <h3 class="gif__desctiption-title">
                    <a href="/gif/view?id=<?=$item->id;?>"><?=$this->e($item->title); ?></a>
                </h3>

                <div class="gif__description-data">
                    <span class="gif__username">@<?=$this->e($item->getRelation('author')->name); ?></span>
                    <span class="gif__likes"><?=$item->like_count; ?></span>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</aside>