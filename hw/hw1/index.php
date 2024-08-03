<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>1. Основы PHP (Практическое задание 1)</title>
</head>
<body>
<?php
// phpinfo();
echo 'Задание 1' . PHP_EOL;
echo '<br>';
$a = 5;
$b = '05';
var_dump($a == $b);
echo '<br>';
echo 'Выполнено сравнение по значению, а не по типу, переменная  b была приведена к INT - 7.4: bool(true), 8.2: bool(true)';
echo '<br>';
var_dump((int)'012345');
echo '<br>';
echo 'Приведение к целочисленному типу - 7.4: int(12345), 8.2: int(12345)';
echo '<br>';
var_dump((float)123.0 === (int)123.0);
echo '<br>';
echo 'Строгое сравнение (с учетом типа) - 7.4: bool(false), 8.2: bool(false)';
echo '<br>';
var_dump(0 == 'hello, world');
echo '<br>';
echo 'Нестрогое сравнение (php8 использует более строгие правила) - 7.4: bool(true), 8.2: bool(false)';
echo '<br>';
echo '<hr>';
echo 'Задание 2';
echo '<br>';
$a = 10;
$b = 25;
echo 'Переменная a до замены: ' . $a . "</ br>";
echo '<br>';
echo 'Переменная b до замены: ' . $b . "</ br>";
$a = $a + $b;
$b = $a - $b;
$a = $a - $b;
echo '<hr>';
echo 'Переменная a после замены: ' . $a . "</ br>";
echo '<br>';
echo 'Переменная b после замены: ' . $b . "</ br>"
?>
</body>
</html>