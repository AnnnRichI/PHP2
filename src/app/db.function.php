<?php

function dbConnect(array $config): PgSql\Connection|false 
{

    static $db = null; 

    if (is_null($db)) {
        $db = @pg_connect(getConnectionString($config));
        
        if (!$db) {
            echo errorHandle("Ошибка соединения с БД.");
            exit();
        }
    }
    
    return $db;
}

//форматированный вывод информации из файла config.ini
function getConnectionString(array $config): string 
{
    return sprintf('host=%s port=%s dbname=%s user=%s password=%s', 
    $config['db']['host'],
    $config['db']['port'],
    $config['db']['dbname'],
    $config['db']['user'],
    $config['db']['password']);
}
