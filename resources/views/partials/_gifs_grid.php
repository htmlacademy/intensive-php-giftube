<ul class="gif-list">
    <?php foreach ($gifs as $gif) : ?>
    <li class="gif gif-list__item">
        <div class="gif__picture">
            <button type="button">Проиграть</button>

            <img src="uploads/<?=$gif->path; ?>" alt="" width="260" height="260">
        </div>
        <div class="gif__desctiption">
            <h3 class="gif__desctiption-title">
                <a href="/gif/view?id=<?=$gif->id;?>"><?=$gif->title;?></a>
            </h3>

            <div class="gif__description-data">
                <span class="gif__username">@<?=$gif->authorName;?></span>

                <span class="gif__likes"><?=$gif->like_count; ?></span>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>