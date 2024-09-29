<?php

$db = @dbConnect();

$result = @pg_query($db, "select id, title, preview from posts;"); 

$bd_res = pg_fetch_all($result);

print_r($bd_res[0]);


function dbConnect(): PgSql\Connection|false 
{
    $db = @pg_connect("host = localhost port = 5432 dbname = blog user = postgres password = riChipug");
    
    if (!$db) {
        echo errorHandle("Ошибка соединения с БД.");
        exit();
    }

    return $db;
}