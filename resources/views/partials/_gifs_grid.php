<ul class="gif-list">
    <?php foreach ($paginator->getItems() as $gif) : ?>
    <li class="gif gif-list__item">
        <div class="gif__picture">
            <a href="/gif/view?id=<?=$gif->id;?>" class="gif__preview">
                <img src="uploads/preview_<?=$gif->path; ?>" alt="" width="260" height="260">
            </a>
        </div>
        <div class="gif__desctiption">
            <h3 class="gif__desctiption-title">
                <a href="/gif/view?id=<?=$gif->id;?>"><?=$this->e($gif->title);?></a>
            </h3>

            <div class="gif__description-data">
                <span class="gif__username">@<?=$this->e($gif->authorName);?></span>
                <span class="gif__likes"><?=$gif->like_count; ?></span>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>