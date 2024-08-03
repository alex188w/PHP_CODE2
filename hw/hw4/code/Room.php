<?php

class Room
{
    private int $roomId;
    private string $address;
    private Shelf $bookShelf;

    // Использование Композиции - ассоциации, при которой используемый объект создается внутри класса
    // Объект Shelf тоже лучше сделать массивом Shelf -ов
    public function __construct($roomId, $address, Shelf $bookShelf)
    {
        $this->roomId = $roomId;
        $this->address = $address;
        $this->bookShelf = new Shelf($bookShelf->getShelfId(), $bookShelf->getRoomId(), $bookShelf->getBooksFromShelf());
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getBookShelf(): Shelf
    {
        return $this->bookShelf;
    }
    
    public function __toString()
    {
        return 'Зал № ' . $this->roomId . ' адрес: ' . $this->address . PHP_EOL . 'Каталог книг в зале: ' . PHP_EOL . $this->getBookShelf();
    }
}