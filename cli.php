<?php

const DS = DIRECTORY_SEPARATOR;

// подключение автозагрузчика
require_once __DIR__ . DS . "vendor" . DS . "autoload.php";

// вызов корневой функции
$result = main(__DIR__ . DS . 'config.ini');

// вывод результат
echo $result;













