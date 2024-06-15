<?php
include '../../classes/Database.php';
include '../../classes/Time.php';
include '../../classes/Book.php';
$lastBook = Book::GetLastBook();
echo '' .  $lastBook . ' ';
