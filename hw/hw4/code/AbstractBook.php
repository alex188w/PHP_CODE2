<?php

abstract class  AbstractBook{
    private string $name;
    private string $author;
    private int $year;

    public function __construct(string $name, string $author, int $year)
    {
        $this->name = $name;
        $this->author = $author;    
        $this->year = $year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthor(): string
    {       
        return $this->author;
    }

    public function getYear(): int
    {
        return $this->year;
    }
    
    abstract function __toString(): string;
}