<?php
    require_once 'PaperBook.php';

    class Shelf
    {
        private int $shelfId;
        private int $roomId;    
        private array $books;

        // Использование Агрегации - ассоциации, при которой используемый объект создается вне класса
        // Создаем Объект PaperBook и помещаем его внутри Объекта Shelf (агрегация)
        public function __construct(int $shelfId, int $roomId, array $books)
        {
            $this->shelfId = $shelfId;
            $this->roomId = $roomId;            
            $this->books = $books;
        }

        public function getShelfId(): int
        {
            return $this->shelfId;
        }

        public function getRoomId(): int
        {
            return $this->roomId;
        }        

        public function getBooksFromShelf(): array
        {
            return $this->books;
        }

        public function getCountBooks()
        {
            $countBooks = 0;
            foreach ($this->books as $book) {
                $book->getInRoom() ? $countBooks++ : $countBooks;
            }
           
            return $countBooks;
        }

        public function getPrintBooksInShelf()
        {
            return  implode (PHP_EOL, $this->books);            
        }

        public function __toString()
        {
            return 'Номер шкафа: ' . $this->getShelfId() . ', расположение: зал № ' . $this->getRoomId() .
            ', текущее количество книг в шкафу: ' . $this->getCountBooks() . PHP_EOL . ($this->getPrintBooksInShelf() . PHP_EOL);
        }




        // // Метод размещения книги в шкаф
        // public function placeBookInShelf(PaperBook $book)
        // {
        //     $shelfIdForBook = $book->getShelfId();
        //     if ($this->getShelfId() === $shelfIdForBook && count($this->books) < $this->getVolume()) {
        //         $this->books[] = $book;
        //         // echo 'Книги на данной полке: ' . $this->books;
        //         echo 'Книга: ' . $book->getName() . ' - положена на полку: ' . $this->getShelfId() . PHP_EOL;
        //     } else {
        //         echo 'Шкаф № ' . $this->getShelfId() . ' переполнен. Положите книгу "' . $book->getName() . '" в другой шкаф' . PHP_EOL;
        //     }
        // }
    }
