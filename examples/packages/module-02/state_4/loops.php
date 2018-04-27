/* BEGIN STATE 01 */
<?php
$last_num = 1;

while ($last_num < 10) {
	print($last_num);
	$last_num = $last_num + 1;
}
/* END STATE 01 */
/* BEGIN STATE 02 */
$pages_count = 10;
$cur_page = 1;
?>
<ul>
	<?php while ($cur_page < $pages_count): ?>
	<li>
		<a href="?page=1<?= $cur_page; ?>"><?=$cur_page;?></a>
	</li>
	<?php $cur_page = $cur_page + 1; ?>
	<?php endwhile; ?>
</ul>
/* END STATE 02 */
/* BEGIN STATE 03 */
<?php
$categories = ["Животные", "Люди", "Наука", "Видеоигры", "Спорт", "Фейлы"];

$index = 0;
$num_count = count($categories);

while ($index < $num_count) {
	print($categories[$index]);
	print("<br>");

	$index = $index + 1;
}
?>
/* END STATE 03 */
/* BEGIN STATE 04 */
<?php
$categories = ["Животные", "Люди", "Наука", "Видеоигры", "Спорт", "Фейлы"];

$index = 0;
$num_count = count($categories);
?>
<nav>
	<?php while($index < $num_count): ?>
	<a href="/?cat=<?=$index;?>"><?=$categories[$index];?></a>
	<?php $index = $index + 1; ?>
	<?php endwhile; ?>
</nav>
/* END STATE 04 */
/* BEGIN STATE 05 */
<?php
$gif = [
	'gif' => '/uploads/preview_gif58d28ce80e3a9.gif',
	'title' => 'Енотик',
	'likes_count' => 0
];

foreach ($gif as $key => $value) {
	print("Ключ: " . $key);
	print("Значение: " . $value);

}
?>
/* END STATE 05 */
/* BEGIN STATE 06 */
<?php
$gif_list = [
	[
		'gif' => '/uploads/preview_gif58d28ce80e3a9.gif',
		'title' => 'Енотик',
		'likes_count' => 0
	],
	[
		'gif' => '/uploads/preview_gif58d29cfc805a2.gif',
		'title' => 'Кот-доминатор',
		'likes_count' => 0
	]
];
?>
<ul>
	<?php foreach ($gif_list as $key => $item): ?>
	<li class="gif">
		<div class="picture">
			<img src="<?=$item['gif']; ?>" alt="">
		</div>
		<div class="desc">
			<h3><?=$item['title'];?></h3>
		</div>
	</li>
	<?php endforeach; ?>
</ul>
/* END STATE 06 */