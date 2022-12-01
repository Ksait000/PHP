<?php

function calculator(string $example): string
{
    $tempNumber = '';
    $numbers = [];
    $result = 0;

    if (is_null($example)) {
        return "incprrect input   18 \n";
    }

    // проверка на корректность примера
    $exampleCounter = 0;
    foreach (str_split($example) as $symbol) {
        if (is_numeric($symbol)) {
            $tempNumber .= $symbol;
        } elseif (ord($symbol) === 42 || ord($symbol) === 43 || ord($symbol) === 45 || ord($symbol) === 47) {
            $numbers[] = intval($tempNumber);
            $numbers[] = $symbol;
            $tempNumber = '';
        } else {
            return "incprrect input   39 \n";
        }

        if ($exampleCounter + 1 === strlen($example)) {
            $numbers[] = intval($tempNumber);
        }

        $exampleCounter++;
    }

    //проверка на лимит слагаемых и арифм. операторов, который = 5
    if (count($numbers) > 9) {
        return "incprrect input 60 \n";
    }

    // сперва производится умножение и деление
    for ($counter = 0; $counter < count($numbers); $counter++) {
        if ($numbers[$counter] === '*') {
            $numbers[$counter - 1] = $numbers[$counter - 1] * $numbers[$counter + 1];
            array_splice($numbers, $counter, 2);
            $counter--; /* т.к. массив меняется, то счётчик должен остаться на месте, 
            чтобы со следующей итерации он проходился по уже изменённому массиву правильно*/
        }
        if ($numbers[$counter] === '/') {
            $numbers[$counter - 1] = $numbers[$counter - 1] / $numbers[$counter + 1];
            array_splice($numbers, $counter, 2);
            $counter--;
        }
    }

    // затем сложение и вычитание
    $counter = 0;
    foreach ($numbers as $operator) {
        if ($counter === 0) {
            $result = $numbers[0];
        }
        if ($operator === '+') {
            $result += $numbers[$counter + 1];
        } elseif ($operator === '-') {
            $result -= $numbers[$counter + 1];
        }
        $counter++;
    }

    return strval($result);
}

print("Input: {$argv[1]}" . "\n\n");

print(calculator($argv[1]));
