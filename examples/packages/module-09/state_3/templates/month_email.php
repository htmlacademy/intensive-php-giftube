<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Новые гифки за этот месяц</h1>

<p>Предлагаем вашему вниманию три самых популярных гифки, добавленные за этот месяц:</p>

<table>
    <thead>
    <tr>
        <th>Номер</th>
        <th>Гифка</th>
        <th>Название</th>
        <th>Просмотров</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($gifs as $i => $gif): ?>
        <tr>
            <td><?=$i+1;?></td>
            <td><img src="http://giftube.academy/uploads/preview_<?=$gif['path'];?>"
                     style="max-width: 200px;"></td>
            <td><?=htmlspecialchars($gif['title']);?></td>
            <td><?=$gif['show_count'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>