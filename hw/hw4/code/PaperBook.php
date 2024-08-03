<?php

require_once "AbstractBook.php";
require_once 'Shelf.php';

// Наследование AbstractBook 
class PaperBook extends AbstractBook
{
    private int $shelfId;
    private bool $inRoom;
    private string $user;    

    public function __construct(string $name, string $author, int $year, int $shelfId, bool $inRoom, string $user)
    {
        parent::__construct($name, $author, $year, $inRoom, $user);
        $this->shelfId = $shelfId;
        $this->inRoom = $inRoom;
        $this->user = $user;
    }

    public function getShelfId()
    {
        return $this->shelfId;
    }

    public function setShelfId(int $shelfId)
    {
        $this->shelfId = $shelfId;
    }

    public function getInRoom(): bool
    {
        return $this->inRoom;
    }

    public function setInRoom($inRoom)
    {
        $this->inRoom = $inRoom;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function stringGetInRoom()
    {
        return ($this->getInRoom()) ? 'в наличии' : 'выдана абоненту: ';
    }

    public function __toString()
    {
        return 'Название книги: ' . $this->getName() . ', автор: ' . $this->getAuthor() .
            ', год издания: ' . $this->getYear() . ', наличие в библиотеке: ' . $this->stringGetInRoom() . $this->getUser();
    }

    // Метод выдачи книги на руки абоненту
    public function issueBook(string $name)
    {
        $this->setInRoom(false);
        $this->setUser($name);
    }

    // Метод возврата книги
    public function returnBook()
    {
        $this->setUser('');
        $this->setInRoom(true);        
    }
}
