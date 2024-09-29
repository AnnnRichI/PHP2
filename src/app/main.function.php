<?php

function errorHandle($errorText):string {

    return error($errorText);

}

function main(string $configAddress): string {

    // подключаем файл настроек config.ini
    $config = getConfig($configAddress);

    $functionName = parseCommand();

    writeToLog("Вызвана функция $functionName", 'func');
    
    if (function_exists($functionName)) {
        $result = $functionName($config); // динамический вызов функции
    } else {
        $result = errorHandle("Вызываемая функция не существует.");
    }

    return $result;
}

function  parseCommand() {
    $functionName = "helpFunction";
 
    // print_r($_SERVER['argv']);

    if (isset($_SERVER['argv'][1])) { //задали ли вторую переменную
        $functionName = match ($_SERVER['argv'][1]) {
            "rand" => 'randomNumberGame',
            "help" => 'helpFunction',
            "posts" => 'getPosts',
            "post" => 'getPost',
            "addrandompost" => 'addRandomPost',
            default => $_SERVER['argv'][1]
        };

        return $functionName;
    } else {

        return $functionName;

    }
}

function readConfig(string $configAddress):array|false {

    return parse_ini_file($configAddress, true);

}

// подключаем файл настроек config.ini
function getConfig($configAddress) 
{
    $config = readConfig(configAddress: $configAddress);

    if (!$config) {
        return errorHandle("Невозможно подключить файл настроек.");
    }

    return $config;
}
