<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';

if (isset($_GET['idLibro'])) {
	$id = $_GET['idLibro'];
	$bookData = Book::GetInfoFromBookId($id);
	$nombre = $bookData[0]['nombre'];
	if ($nombre == null) {
		$nombre = "No tenía nombre asociado";
	}
	if ($bookData == null) {
		header("location: manage-books?invalidBook");
	} else {
		Book::DeleteBook($id);
		AuditLogs::AddNewLog("Eliminó el libro #$id", "2");
		header("location: manage-books?deletedBook&id=$id&nombre=$nombre");
	}
}

if (isset($_GET['idUsuario'])) {
	$id = $_GET['idUsuario'];
	$userData = new User($id);
	// Si no recibe un nombre de usuario, se define como "Usuario eliminado"
	if ($userData->nombre == null) {
		$userData->nombre = "No tenía nombre asociado";
	}
	if ($userData == null) {
		header("location: manage-users?invalidusername");
	} else {
		User::DeleteUser($id);
		AuditLogs::AddNewLog("Eliminó el usuario #$id", "2");
		header("location: manage-users?deletedUser&id=$id&username=$userData->nombre");
	}
}

if (isset($_GET['idResenia'])) {
	$id = $_GET['idResenia'];
	$reviewDelete = Resenias::DeleteReview($id);
	AuditLogs::AddNewLog("Eliminó la reseña #$id", "9");
	header("location: resenias?deletedReview&idResenia=$id");
}

if (isset($_GET['idAutor'])) {
	$id = $_GET['idAutor'];
	$autorData =  new Autores($id);
	if ($autorData->nombre == null) {
		$autorData->nombre = "No tenía nombre asociado";
	}
	if ($autorData == null) {
		header("location: manage-autores?invalidAutor");
	} else {
		Autores::DeleteAutor($id);
		AuditLogs::AddNewLog("Eliminó al autor #$id", "2");
		header("location: manage-autores?deletedAutor&id=$id&nombre=$autorData->nombre");
	}
}

exit;
