<?php

class Date
{
    private int $day;
    private int $month;
    private int $year;

    public function __construct(int $day, int $month, int $year)
    {
        if (checkdate($month, $day, $year)) {
            $this->day = $day;
            $this->month = $month;
            $this->year = $year;
        } else {
            throw new Exception("Дата введена некоректно!");
        }
    }

    public function differenceInDay(Date $secondDate): string
    {
        $firstDate = date_create("{$this->year}-{$this->month}-{$this->day}");
        $secondDate = date_create("{$secondDate->getYear()}-{$secondDate->getMonth()}-{$secondDate->getDay()}");
        $difference = date_diff($firstDate, $secondDate)->format('%a');

        return $difference;
    }

    public function minusDay(int $daysToSubtract): string
    {
        $date = new DateTime("{$this->year}-{$this->month}-{$this->day}");
        $intervalToSubtract = new DateInterval("P{$daysToSubtract}D");

        return $date->sub($intervalToSubtract)->format('d-m-Y');
    }

    public function getDateOfWeek(): string
    {
        $date = new DateTime("{$this->year}-{$this->month}-{$this->day}");
        $week = ['Sunday', 'Monday ', 'Tuesday ', 'Wednesday ', 'Thursday ', 'Friday ', 'Saturday '];
        return $week[intval($date->format('w'))];
    }

    public function format(string $format): string
    {
        if ($format === 'ru') {
            return "{$this->day}-{$this->month}-{$this->year}";
        } elseif ($format === 'en') {
            return "{$this->year}-{$this->month}-{$this->day}";
        } else {
            throw new Exception("Такого формата нет!");
        }
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}

$date = new Date(1, 2, 2001);
$date2 = new Date(1, 4, 2001);

print("{$date->differenceInDay($date2)} \n");
print("{$date->minusDay(4)} \n");
print("{$date->getDateOfWeek()} \n");
print("{$date->format('ru')} \n");
print("{$date->format('en')} \n");
