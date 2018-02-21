<div class="content__main-col">
    <header class="content__header">
        <h2 class="content__header-text"><?=htmlspecialchars($gif['title']);?></h2>
        <label for="gifControl">click</label>
    </header>

    <div class="gif gif--large">
        <div class="gif__picture">
            <input type="checkbox" name="" id="gifControl" value="1" class="hide">
            <label for="gifControl">Проиграть</label>
            <img src="uploads/<?=$gif['path'];?>" alt="" class="gif_img main hide">
            <img src="uploads/preview_<?=$gif['path'];?>" alt="" class="gif_img preview">
        </div>

        <div class="gif__desctiption">
            <div class="gif__description-data">
                <span class="gif__username">@<?=htmlspecialchars($gif['name']);?></span>

                <span class="gif__views"><?=$gif['show_count'];?></span>
                <span class="gif__likes"><?=$gif['like_count'];?></span>
            </div>
            <div class="gif__description">
                <p><?=htmlspecialchars($gif['description']);?></p>
            </div>
        </div>
    </div>

    <div class="comment-list">
        <h3 class="comment-list__title">Комментарии:</h3>
    </div>
</div>

<aside class="content__additional-col">
    <h3 class="content__additional-title">Похожие гифки:</h3>

    <ul class="gif-list gif-list--vertical">
        <?php foreach ($sim_gifs as $rel_gif): ?>
            <li class="gif gif--small gif-list__item">
                <div class="gif__picture">
                    <a href="/gif.php?id=<?=$rel_gif['id'];?>" class="gif__preview">
                        <img src="uploads/preview_<?=$rel_gif['path'];?>" alt="" width="200" height="200">
                    </a>
                </div>
                <div class="gif__desctiption">
                    <h3 class="gif__desctiption-title">
                        <a href="gif.php?id=<?=$rel_gif['id'];?>"><?=htmlspecialchars($rel_gif['title']); ?></a>
                    </h3>

                    <div class="gif__description-data">
                        <span class="gif__username">@<?=htmlspecialchars($rel_gif['name']); ?></span>
                        <span class="gif__likes"><?=$rel_gif['like_count'];?></span>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>