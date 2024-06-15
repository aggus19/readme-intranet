<?php
include '../../classes/Database.php';
include '../../classes/Time.php';
include '../../classes/Book.php';
$totalBooks = Book::GetNumberBooks();
echo '' .  $totalBooks . ' ';
