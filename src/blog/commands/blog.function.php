<?php
// функция с библиотекой faker, создание рандомного поста
function addRandomPost(array $config) 
{
    $faker = Faker\Factory::create();

    $title =  $faker->realText(10);
    $text = $faker->realText(100);
    $preview = $faker->realText(50);

    $db = @dbConnect($config);

    @pg_prepare($db, "insert", "INSERT INTO public.\"posts\" OVERRIDING SYSTEM VALUE VALUES (1, 2, $1, $2, $3, 1);");
    $result = @pg_execute($db, "insert", [$title, $text, $preview,]);

    if (!$result) {
        return errorHandle("Ошибка запроса: " . pg_last_error($db));
    }

    return print_r(pg_fetch_assoc($result), true);
    
}

function getPost(array $config): string 
{
    $db = @dbConnect($config);

    $id = @(int)$_SERVER['argv'][2];

    //вывод ошибки если id null или это не число
    if (!$id || !is_numeric($id)) {
        return errorHandle("Номер поста некорректный!");
    }

    // $result = @pg_query($db, "select id, title, preview from posts where id = {$id};"); // public.\"posts\"

    @pg_prepare($db, "select", "select id, title, preview from posts where id = $1");
    $result = @pg_execute($db, "select", [$id]);

    if (!$result) {
        return errorHandle("Ошибка запроса: " . pg_last_error($db));
    }

    //вывод ошибки если id не существует
    if (pg_fetch_all($result) == []) {
        return errorHandle("Такого поста не существует!");
    }

    return print_r(pg_fetch_assoc($result), true);
}
function getPosts(array $config)
{

    $db = @dbConnect($config);

    $result = @pg_query($db, "select id, title, preview from posts;"); // public.\"posts\"

    if (!$result) {
        return errorHandle("Ошибка запроса: " . pg_last_error($db));
    }

    // вывод по строкам из таблицы posts 
    // print_r(pg_fetch_assoc($result));
    // print_r(pg_fetch_assoc($result));

    // вывод сразу всех строк из таблицы posts - pg_fetch_all

    // вывод строки 2 в таблице posts в виде id | title | preview
    //print_r(implode(" | ", pg_fetch_all($result)[1]));
    //print_r(PHP_EOL);

    // вывод отформатированных строк в виде id | title | preview 
    $lines = getBDString(pg_fetch_all($result));

    // return print_r(pg_fetch_all($result), true);
    
    return $lines;

}

// форматированный вывод всех строк posts в одну строку 
function getBDString(array $dbQuery): string 
{
    $allLines = "";

    for ($i = 0; $i <= count($dbQuery) - 1; $i++) {
        $line = sprintf('%s | %s | %s', 
str_pad($dbQuery[$i]['id'], 5),
        str_pad($dbQuery[$i]['title'], 20 , ' ', STR_PAD_RIGHT),
        $dbQuery[$i]['preview']);

        $allLines .= $line . PHP_EOL;
    }

    return $allLines;

    // $i = 0;
    // $allLines = "";
    // while ($row = pg_fetch_assoc($result)) {
    //     $posts[] = $row;
    //     $allLines .= implode(" | ", $posts[$i]) . PHP_EOL;
    //     $i ++;
    // }
    // print_r($allLines);
    // return $allLines;
}