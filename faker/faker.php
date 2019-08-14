<?php

use Bezhanov\Faker\ProviderCollectionHelper;

require_once "../vendor/autoload.php";

$faker = Faker\Factory::create("ru_RU");
ProviderCollectionHelper::addAllProvidersTo($faker);

function run_count($count, $callback, $faker)
{
    $result = [];

    for ($i = 0; $i < $count; $i++) {
        $result[] = $callback($faker);
    }

    return $result;
}

$create_users = function($faker) {
    $fields = [
        $faker->dateTimeBetween('-2 years', 'now')->format("Y-m-d H:i:s"),
        $faker->unique()->email,
        $faker->userName,
        password_hash($faker->password, PASSWORD_DEFAULT)
    ];

    return $fields;
};

$create_cats = function($faker) {
    $fields = [$faker->department];

    return $fields;
};

$create_gifs = function ($faker) {
    return [
        rand(1, 5),
        rand(1, 10),
        $faker->dateTimeBetween('-2 years', 'now')->format("Y-m-d H:i:s"),
        rand(1, 50000),
        rand(0, 1000),
        rand(0, 1000),
        addslashes($faker->realText(50, 1)),
        addslashes($faker->realText(200, 3)),
        $faker->md5 . ".gif"
    ];
};

$create_comments = function ($faker) {
    return [
        $faker->dateTimeBetween('-2 years', 'now')->format("Y-m-d H:i:s"),
        rand(1, 10),
        rand(1, 100),
        addslashes($faker->realText(200, 2)),
    ];
};

$create_connections = function ($faker) {
    static $pairs = [];

    while ($connection = [rand(1, 10), rand(1, 100)]) {
        $hash = md5(serialize($connection));

        if (!in_array($hash, $pairs)) {
            break;
        }
    }

    return $connection;
};

function convert_to_query($table, $columns, $values)
{
    $sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES ";
    $vals = "";

    foreach ($values as $value) {
        array_walk($value, function (&$item) {
            $item = "'$item'";
        });

        $vals .= "(" . implode(',', $value) . "), ";
    }

    $sql .= $vals;
    $sql = substr($sql, 0, -2) . ";";

    return $sql;

}


$collection = [
    ["users", ["dt_add", "email", "name", "password"], run_count(10, $create_users, $faker)],
    ["categories", ["name"], run_count(5, $create_cats, $faker)],
    ["gifs", ["category_id", "user_id", "dt_add", "show_count", "like_count", "fav_count", "title", "description", "path"], run_count(100, $create_gifs, $faker)],
    ["comments", ["dt_add", "user_id", "gif_id", "content"], run_count(30, $create_comments, $faker)],
    ["gifs_fav", ["user_id", "gif_id"], run_count(50, $create_connections, $faker)],
    ["gifs_like", ["user_id", "gif_id"], run_count(50, $create_connections, $faker)]
];

$sql_parts = [];

array_walk($collection, function ($item) use (&$sql_parts) {
    $sql_parts[] = convert_to_query(...$item);
});

$sql_str = implode("\r\n", $sql_parts);

file_put_contents("dump.sql", $sql_str);
