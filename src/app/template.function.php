<?php

function error(string $errorText): string {

    return "\033[31m" . $errorText . " \r\n \033[31m";

}

function helpFunction(): string {
    $help = "Порядок вызова\r\n";
    $help .= "php app.php [COMMAND]\r\n";
    $help .= "Доступные команды\r\n";
    $help .= "rand - игра, \"Угадай число\" \r\n";
    $help .= "help - помощь \r\n";
    $help .= "addrandompost - добавление рандомного поста \r\n";
    $help .= "posts - посмотреть все посты \r\n";
    $help .= "post <id поста> - посмотреть конкретный пост \r\n";

    return $help;

}