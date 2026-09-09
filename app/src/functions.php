<?php
declare(strict_types=1);

function handle_task1(array &$params): void
{
    $number = $_POST['number'] ?? null;
    if ($number !== null) {
        try {
            $params["factorial"] = factorial((int)$number);
        } catch (TypeError $e) {
            $params["error"] = "Please enter a valid integer";
        } catch (Throwable $e) {
            $params["error"] = $e->getMessage();
        }
    }
}

function handle_task2(array &$params): void
{
    $length = $_POST['length'] ?? null;
    if ($length !== null) {
        try {
            $params["randomString"] = random_string((int)$length);
        } catch (OutOfRangeException $e) {
            $params["error"] = $e->getMessage();
        } catch (Throwable $e) {
            $params["error"] = $e->getMessage();
        }
    }
}

function handle_task3(array &$params): void
{
    $arrayInput = $_POST['array'] ?? '';


    $array = array_map('trim', explode(',', $arrayInput));
    $array = array_filter($array, 'strlen');

    if (empty($array)) {
        $params["error"] = "Please enter at least one value";
        return;
    }

    $sortOrder = $_POST['sort_order'] ?? 'asc';

    $ogarray = $array;
    if ($sortOrder === 'asc') {
        sort($array);
        $params["sortType"] = "ascending";
    } else {
        rsort($array);
        $params["sortType"] = "descending";
    }

    $params["sortedArray"] = $array;
    $params["originalArray"] = $ogarray;
}

function e(string $message): string
{
    return htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
}

function factorial(int $n): int
{
    if ($n < 0) {
        throw new InvalidArgumentException("Factorial is not defined for negative numbers");
    }

    if ($n === 0) {
        return 1;
    }

    return $n * factorial($n - 1);
}

function random_string(int $length): string
{
    if ($length <= 0) {
        throw new OutOfRangeException("Length must be greater than 0");
    }

    $randomString = [];

    for ($i = 0; $i < $length; $i++) {
        $randomString[] = random_utf8_char();
    }

    return implode("", $randomString);
}

function random_utf8_char(): string {
    while (true) {
        $codePoint = random_int(0x0020, 0x0080);

        $char = IntlChar::chr($codePoint);

        if ($char !== null && IntlChar::isprint($char)) {
            return $char;
        }
    }
}