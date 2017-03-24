<?php
$cur_page = $paginator->getCurrentPage();
$total_pages = $paginator->getTotalPages();
$pages = $paginator->getPagesNumbers(5);

$prevUrl = $cur_page == 1 ? '#' : $paginator->getUrl($_SERVER['QUERY_STRING'], $cur_page - 1);
$nextUrl = $paginator->isLastPage() ? '#' : $paginator->getUrl($_SERVER['QUERY_STRING'], $cur_page + 1);
?>

<?php if ($total_pages > 1): ?>
<div class="pagination">
    <ul class="pagination__control">
        <?php foreach ($pages as $page): ?>
        <li class="pagination__item <?php if ($page == $paginator->getCurrentPage()): ?>pagination__item--active<?php endif; ?>">
            <a href="<?=$paginator->getUrl($_SERVER['QUERY_STRING'], $page);?>"><?=$page;?></a>
        </li>
        <?php endforeach; ?>
    </ul>

    <ul class="pagination__control">
        <li class="pagination__item">
            <a href="<?=$prevUrl;?>">◀</a>
        </li>

        <li class="pagination__item">
            <a href="<?=$nextUrl;?>">▶</a>
        </li>
    </ul>
</div>
<?php endif; ?>