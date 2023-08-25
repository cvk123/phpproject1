<?php

// logika
class Book
{
    function __construct($title, $author, $year, $price)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->price = $price;
    }

    function bookDescription()
    {
        return "Název knihy: " + $this->title + "<br>" + "Autor: " + $this->author + "<br>" + "Rok vydání: " + $this->year;
    }

    function bookPrice($amount)
    {
     $this->price = $this->price + $amount;
    }
}

// použití

$book1 = new Book("Harry Potter a kámen mudrců", "J. K. Rowling", 1997, 500);
$book2 = new Book("Harry Potter a tajemná komnata", "J. K. Rowling", 1998, 600);
$book3 = new Book("Harry Potter a vězeň z Azkabanu", "J. K. Rowling", 1999, 700);

echo $book1->bookDescription(); echo "<br>";
echo $book2->bookDescription(); echo "<br>";
echo $book3->bookDescription(); echo "<br>";

echo $book1->bookPrice(100); echo "<br>";