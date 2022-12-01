<?php

function sumTime(string $firstTime, string $secondTime): string
{
    if (!checkStringTime($firstTime) || !checkStringTime($secondTime)) {
        return "incorrect input \n";
    }

    $arrFirstTime = explode(':', $firstTime);
    $arrSecondTime = explode(':', $secondTime);
    if (count($arrFirstTime)  != 3 || count($arrSecondTime)  != 3) {
        return "incorrect input \n";
    }

    $seconds = intval($arrFirstTime[2]) + intval($arrSecondTime[2]);
    $minutes = intval($arrFirstTime[1]) + intval($arrSecondTime[1]);
    $hours = intval($arrFirstTime[0]) + intval($arrSecondTime[0]);
    $arrResultSumTime = ["{$hours}", "{$minutes}", "{$seconds}"];

    if ($seconds >= 60) {
        $minutes += intval($seconds / 60);
        $seconds = $seconds % 60;
        $arrResultSumTime[2] = strval($seconds);
    }
    if ($minutes >= 60) {
        $hours += intval($minutes / 60);
        $minutes = $minutes % 60;
        $arrResultSumTime[1] = strval($minutes);
    }
    if ($hours >= 24) {
        $hours = $hours % 24;
        $arrResultSumTime[0] = strval($hours);
    }

    // чтобы вместо 9:30:2 было 09:30:02
    if ($seconds < 10) {
        $arrResultSumTime[2] = "0{$seconds}";
    }
    if ($minutes < 10) {
        $arrResultSumTime[1] = "0{$minutes}";
    }
    if ($hours < 10) {
        $arrResultSumTime[0] = "0{$hours}";
    }

    return "{$arrResultSumTime[0]}:{$arrResultSumTime[1]}:{$arrResultSumTime[2]}";
}

function checkStringTime(string $time): bool
{
    if (is_null($time)) {
        return "incorrect input \n";
    }

    if (!(strlen($time) === 8)) // длина строки "время"("00:00:00") должна быть фиксированной длинны = 8
    {
        return false;
    }

    foreach (str_split($time) as $symbol) {
        if (!(is_numeric($symbol) || ord($symbol) === 58)) {
            return false;
        }
    }

    return true; // если проверки не показали ошибок, то сработает этот return

}

print(sumTime($argv[1], $argv[2]));
