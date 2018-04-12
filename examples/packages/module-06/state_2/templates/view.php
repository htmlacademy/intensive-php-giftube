<div class="content__main-col">
    <?php if (isset($gif)): ?>
    <header class="content__header">
        <h2 class="content__header-text"><?=htmlspecialchars($gif['title']);?></h2>
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
                <span class="gif__username">@<?=htmlspecialchars($gif['username']);?></span>
            </div>
            <div class="gif__description">
                <p><?=htmlspecialchars($gif['description']);?></p>
            </div>
        </div>
    </div>
    <?php else: ?>
        <h1 style="color: black">Гифка с этим ID не найдена</h1>
    <?php endif; ?>
</div>