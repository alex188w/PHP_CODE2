<?php

require_once 'DigitalBook.php';
require_once 'PaperBook.php';
require_once 'Shelf.php';
require_once 'Room.php';

// Создаем Объект PaperBook и передаем его внутрь Объекта Shelf (агрегация)
$pBook1 = new PaperBook('Книга 1', 'Автор 1', 2001, 1, false, 'И.И. Иванов');
$pBook2 = new PaperBook('Книга 2', 'Автор 2', 2002, 1, true, '');
$pBook3 = new PaperBook('Книга 3', 'Автор 3', 2003, 1, true, '');
$pBook4 = new PaperBook('Книга 4', 'Автор 4', 2004, 1, true, '');
$pBook5 = new PaperBook('Книга 5', 'Автор 5', 2005, 1, true, '');
$dBook1 = new DigitalBook('Электронная книга 6', 'Автор 6', 2006,  'http://www.digital-book.com/book1.pdf', 5);
$dBook2 = new DigitalBook('Электронная книга 7', 'Автор 7', 2007, 'http://www.digital-book.com/book2.pdf', 7);

// Создаем Объект Shelf внутри Объекта Room в качестве параметра (композиция)
$room1 = new Room(1, 'улица 1 г. Екатеринбург', new Shelf(1, 1, [$pBook1, $pBook2, $pBook3, $pBook4, $pBook5])); 

echo $room1;

$pBook2->issueBook('П.П. Петров');
echo $room1;

$pBook1->returnBook();
echo $room1;

echo $dBook1;
$dBook1->dowlandBook();
echo $dBook1;
$dBook1->dowlandBook();
