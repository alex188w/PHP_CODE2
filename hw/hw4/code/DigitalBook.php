<?php

require_once "AbstractBook.php";

// Наследование AbstractBook 
class DigitalBook extends AbstractBook
{
    private string $url;
    private int $countDownload; 

    public function __construct(string $name, string $author, int $year, string $url, int $countDownload)
    {
        parent::__construct($name, $author, $year);
        $this->url = $url;
        $this->countDownload = $countDownload;
    }

    public function geturl(): string
    {
        return $this->url;
    }

    public function getcountDownload(): int
    {
        return $this->countDownload;
    }

    public function setCountDownload($countDownload)
    {
        $this->countDownload = $countDownload;
    }

    public function __toString()
    {
        return PHP_EOL .'Название книги: ' . $this->getName() . ', автор: ' . $this->getAuthor() .
            ', год издания: ' . $this->getYear() . ', количество скачиваний: ' . $this->getcountDownload();
    }
    
    public function dowlandBook()
    {
        $this->setCountDownload($this->countDownload + 1);
    }
}