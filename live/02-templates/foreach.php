<?php

require_once 'data.php';

foreach ($gif_list as  $gif) {
    print("Название: " . $gif['title'] . ", автор: " . $gif['author'] . "\n");
}
