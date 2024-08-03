<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Урок 2. Условия, Массивы, циклы, функции</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        pre {
            background-color: aliceblue;
        }

        input {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Практическое задание 2. Условия, Массивы, циклы, функции</h1>
        <ul>
            <li><a href="../../index.php">На главную</a></li>
        </ul>
        <h3>Задание 1</h3>
        <p>
            Реализовать основные 4 арифметические операции в виде функции с тремя параметрами – два параметра это числа,
            третий – операция.
            Обязательно использовать оператор return.
        </p>
        <h4>Решенеие:</h4>
        <?php
        function sum($arg1, $arg2)
        {
            return $arg1 + $arg2;
        }

        function sub($arg1, $arg2)
        {
            return $arg1 - $arg2;
        }

        function mult($arg1, $arg2)
        {
            return $arg1 * $arg2;
        }

        function div($arg1, $arg2)
        {
            // $error = 'На ноль делить нельзя!';
            // if ($arg2 == 0) {
            //     echo $error;
            // } else {
            //     return $arg1 / $arg2;
            // }
            return ($arg2 != 0) ? $arg1 / $arg2 : "Деление на 0";
        }
        ?>
        <details>
            <summary>Код программы</summary>
            <pre>
            function sum($arg1, $arg2)
            {
                return $arg1 + $arg2;
            }

            function sub($arg1, $arg2)
            {
                return $arg1 - $arg2;
            }

            function mult($arg1, $arg2)
            {
                return $arg1 * $arg2;
            }

            function div($arg1, $arg2)
            {
                return ($arg2 != 0) ? $arg1 / $arg2 : "Деление на 0";
            }
            </pre>
        </details>
        <p>
            Пример вычисления 1: echo mult(27, 5) = <?php echo mult(27, 5) ?><br />
            Пример вычисления 2: echo div(27, 5) = <?php echo div(27, 5) ?><br />
            Пример вычисления 3: echo div(27, 0) = <?php echo div(27, 0) ?><br />
        </p>
        <hr>
        <h3>Задание 2</h3>
        <p>
            Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 –
            значения аргументов, $operation – строка с названием операции.
            В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции
            из пункта 3) и вернуть полученное значение (использовать switch).
        </p>
        <h4>Решенеие:</h4>
        <?php
        function mathOperation($arg1, $arg2, $operation)
        {
            switch ($operation) {
                case '+':
                    $result = sum($arg1, $arg2);
                    break;
                case  '-':
                    $result = sub($arg1, $arg2);
                    break;
                case '*':
                    $result = mult($arg1, $arg2);
                    break;
                case '/':
                    $result = div($arg1, $arg2);
                    break;
                default:
                    $result = 'Операция не найдена';
            }
            return $result;
        }
        ?>
        <details>
            <summary>Код программы</summary>
            <pre>
            function mathOperation($arg1, $arg2, $operation)
            {
                switch ($operation) {
                    case '+':
                        $result = sum($arg1, $arg2);
                    break;
                    case  '-':
                        $result = sub($arg1, $arg2);
                    break;
                    case '*':
                        $result = mult($arg1, $arg2);
                    break;
                    case '/':
                        $result = div($arg1, $arg2);
                    break;
                    default:
                        $result = 'Операция не найдена';
                }
                return $result;
            }
            </pre>
        </details>
        <p>
            Пример вычисления 1: echo mathOperation(27, 5, '/') = <?php echo mathOperation(27, 5, '/') ?><br />
            Пример вычисления 2: echo mathOperation(27, 5, '/*') = <?php echo mathOperation(27, 5, '/*') ?><br />
        </p>
        <hr>
        <h3>Задание 3</h3>
        <p>
            Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений –
            массивы с названиями городов из соответствующей области.
            Вывести в цикле значения массива, чтобы результат был таким:
            Московская область: Москва, Зеленоград, Клин Ленинградская область: Санкт-Петербург, Всеволожск, Павловск,
            Кронштадт Рязанская область … (названия городов можно найти на maps.yandex.ru).
        </p>
        <h4>Решенеие:</h4>
        <?php
        $regions = [
            'Московская область' => [
                'Москва', 'Зеленоград', 'Клин'
            ],
            'Ленинградская область' => [
                'Всеволожск', 'Павловск',
                'Кронштадт', 'Санкт-Петербург'
            ],
            "Рязанская обдасть" => [
                'Рязань', 'Новомичуринск', 'Шилово', 'Рыбное'
            ]
        ];
        ?>
        <details>
            <summary>Массив с городами</summary>
            <?php echo "<pre>";
            print_r($regions) ?>
        </details>
        <h4>Решенеие:</h4>
        <details>
            <summary>Код программы</summary>
            <pre>
            foreach ($regions as $region => $sities) {
                echo $region;
                for ($i = 0; $i < count($sities); $i++) {
                    echo $sities[$i] . PHP_EOL;
                }
            }           
            </pre>
        </details>
        <pre>
            <?php
            echo "<hr>";
            foreach ($regions as $region => $sities) {
                echo "<strong>" . $region . "</strong>" . PHP_EOL;
                for ($i = 0; $i < count($sities); $i++) {
                    echo $sities[$i] . PHP_EOL;
                }
                echo "<br>";
            }
            echo "<hr>";
            ?>
        </pre>
        <h3>Задание 4</h3>
        <p>
            4. Объявить массив, индексами которого являются буквы русского языка,
            а значениями – соответствующие латинские буквосочетания
            (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). Написать функцию транслитерации строк.

            <?php
            $dict = [
                "а" => "a",
                "б" => "b",
                "в" => "v",
                "г" => "g",
                "д" => "d",
                "е" => "e",
                "ё" => "yo",
                "ж" => "zh",
                "з" => "z",
                "и" => "i",
                "й" => "y",
                "к" => "k",
                "л" => "l",
                "м" => "m",
                "н" => "n",
                "о" => "o",
                "п" => "p",
                "р" => "r",
                "с" => "s",
                "т" => "t",
                "у" => "u",
                "ф" => "f",
                "х" => "kh",
                "ц" => "c",
                "ч" => "ch",
                "ш" => "sh",
                "щ" => "shh",
                "ь" => "",
                "ы" => "y",
                "ъ" => "",
                "э" => "e",
                "ю" => "yu",
                "я" => "ya",
                "А" => "A",
                "Б" => "B",
                "В" => "V",
                "Г" => "G",
                "Д" => "D",
                "Е" => "E",
                "Ё" => "YO",
                "Ж" => "ZH",
                "З" => "Z",
                "И" => "I",
                "Й" => "Y",
                "К" => "K",
                "Л" => "L",
                "М" => "M",
                "Н" => "N",
                "О" => "O",
                "П" => "P",
                "Р" => "R",
                "С" => "S",
                "Т" => "T",
                "У" => "U",
                "Ф" => "F",
                "Х" => "KH",
                "Ц" => "C",
                "Ч" => "CH",
                "Ш" => "SH",
                "Щ" => "SHH",
                "Ь" => "",
                "Ы" => "Y",
                "Ъ" => "",
                "Э" => "E",
                "Ю" => "YU",
                "Я" => "YA",
                " " => "_"
            ];
            ?>
        <details>
            <summary>Словарь</summary>
            <?php echo "<pre>";
            print_r($dict) ?>
        </details>

        <?php
        $translate = '';
        if (isset($_POST["translate"])) {
            $translate = rtrim($_POST["translate"]);
        }

        function transliterate($value, $dict)
        {
            $result = strtr($value, $dict);
            return $result;
        }
        ?>

        <form action="index.php" method="post">
            <input type="text" placeholder="Введите строку..." name="translate">
            <button type="submit">Преобразовать</button>
            <br>
            <h4>Решение:</h4>
            <div class="result"><?php echo transliterate($translate, $dict) ?></div>
        </form>
        <hr>

        <h3>Задание 5</h3>
        <p>
            С помощью рекурсии организовать функцию возведения числа в степень.
            Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
        </p>
        <h4>Решение:</h4>
        <details>
            <summary>Код программы:</summary>
            <pre>
            function power($val, $pow) {
                switch ($pow) {
                    case 0:
                        return 1;
                    case 1:
                        return $val;
                    default:
                        return $val * power($val, --$pow);
                }
            }  
            </pre>
        </details>
        <?php
        function power($val, $pow) {
            switch ($pow) {
                case 0:
                    return 1;
                case 1:
                    return $val;
                default:
                    return $val * power($val, --$pow);
            }
        }       
        ?>
        <p>
            Пример: возведение 4 в степень 5: echo power(4, 5) = <?php echo power(4, 5) ?><br />
        </p>
        <hr>
        <h3>Задание 6</h3>
        <p>
            Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями,
            например: 22 часа 15 минут 21 час 43 минуты.
        </p>
        <h4>Решение:</h4>
        <details>
            <summary>Код программы:</summary>
            <pre>
            function dateStr($val, $arr)
        {
            $v10 = $val % 10;
            if ($val >= 10 && $val <= 20) {
                return $val . ' ' . $arr[2];
            } else switch ($v10) {
                case 1:
                    return $val . ' ' . $arr[0];
                case 2:
                case 3:
                case 4:
                    return $val . ' ' . $arr[1];
                default:
                    return $val . ' ' . $arr[2];
            }
        };
        
        date_default_timezone_set('Asia/Yekaterinburg');
        $h = date("H");
        $m = date("i");
        $s = date("s");

        $hours = dateStr($h, ['час', 'часа', 'часов']);
        $minutes = dateStr($m, ['минута', 'минуты', 'минут']);
        $secunds = dateStr($s, ['секунда', 'секунды', 'секунд']);
        $time = $hours . ' ' . $minutes . ' ' . $secunds;
            </pre>
        </details>        
        <?php
        function dateStr($val, $arr)
        {
            $v10 = $val % 10;
            if ($val >= 10 && $val <= 20) {
                return $val . ' ' . $arr[2];
            } else switch ($v10) {
                case 1:
                    return $val . ' ' . $arr[0];
                case 2:
                case 3:
                case 4:
                    return $val . ' ' . $arr[1];
                default:
                    return $val . ' ' . $arr[2];
            }
        };
        
        date_default_timezone_set('Asia/Yekaterinburg');
        $h = date("H");
        $m = date("i");
        $s = date("s");

        $hours = dateStr($h, ['час', 'часа', 'часов']);
        $minutes = dateStr($m, ['минута', 'минуты', 'минут']);
        $secunds = dateStr($s, ['секунда', 'секунды', 'секунд']);
        $time = $hours . ' ' . $minutes . ' ' . $secunds;        
        ?>
        <p>Результат:</p>
        <strong>Текущее время: <?php echo $time ?></strong>
    </div>
</body>

</html>