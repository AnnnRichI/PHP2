<?php

function writeToLog(mixed $data, string $suffix) {
    if (is_array($data) || is_object($data)) {
        $data = print_r($data, true);
    } //возвращаем строку

    $fd = fopen(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $suffix . 'logs.txt', 'a');

    fputs($fd, date('jS \of F Y h:i:s A') . " " . $data . PHP_EOL);

    fclose($fd);
}