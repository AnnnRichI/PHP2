<?php

function randomNumberGame(array $config): string {
    
    $suffixForLog = 'game';
    writeToLog("--------------------------------", $suffixForLog);
    writeToLog("Запущена игра \"Угадай число\"", $suffixForLog);

    $name = readline("Ваше имя: ");
    echo "Привет, {$name}" . PHP_EOL;

    $target = rand(0, 100);
    // echo $target;

    writeToLog("Искомое значение {$target}", $suffixForLog); 
    
    for ($i = 1; $i <= 10; $i++) {
        $answer = readline("Введите число: ");
        
        writeToLog("Попытка $i пользователя $name: $answer", $suffixForLog);

        if ($answer > $target) {
            echo "Ваш ответ БОЛЬШЕ" . PHP_EOL;

            writeToLog("Ответ пользователя БОЛЬШЕ", $suffixForLog);

        } elseif ($answer < $target) {
            echo "Ваш ответ МЕНЬШЕ" . PHP_EOL;

            writeToLog("Ответ пользователя МЕНЬШЕ", $suffixForLog);

        } else {
            
            writeToLog("Пользователь угадал.",$suffixForLog);

            echo "Поздравляю, {$name}" . PHP_EOL;
            return "Вы угадали число {$target} с  $i  попытки(ок)!";
    
        }
    }

    writeToLog("Игра окончена.", $suffixForLog);
    writeToLog("--------------------------------", $suffixForLog);

    return "Вы не угадали с 10 попыток, попробуйте еще раз!";

}

/**
 * Загадывается число от 0 до 100
 * игроку дается 10 попыток, чтобы угадать
 * если предложенное число больше - уведомить пользователя об этом и продолжить игру
 * если предложенное число меньше - уведомить пользователя об этом и продолжить игру
 */
