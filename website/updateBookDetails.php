
<?php
include_once 'includes/adminPerms.php';

/*
   __   _____  ___    __    ___  __    
  / /   \_   \/ __\  /__\  /___\/ _\   
 / /     / /\/__\// / \// //  //\ \    
/ /___/\/ /_/ \/  \/ _  \/ \_// _\ \   
\____/\____/\_____/\/ \_/\___/  \__/   
                                       
                                           
*/

include_once 'includes/general.php';
// si recibe sumit del formulario
$idLibro = $_POST['idLibro'];
$nameBook = $_POST['lname'];
$descripcion = $_POST['ldesc'];
$genero = $_POST['lgen'];
$costo = $_POST['lcosto'];

// Recibir el submit del formulario, y actualizar los datos del libro. Si se actualiza bien, redireccionar a la pagina de manage-books
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['username'])) {
        header("Location: sign-in");
    }
    if (!empty($nameBook) || !empty($descripcion) || !empty($genero) || !empty($costo)) {
        $query = Book::UpdateBookInfo($nameBook, $descripcion, $genero, $costo, $idLibro);
        header("Location: manage-books?successEdit=1");
    } else {
        header("Location: manage-books?error");
    }
}





?>