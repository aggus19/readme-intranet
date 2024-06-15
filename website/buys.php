<?php
include_once 'includes/general.php';

$id = $_GET['idLibro'];
$libroComprado = Book::GetInfoFromBookId($id);

$fechaCompra = Time::GetTimeYMD();
$costo = $libroComprado['costo'];
$codigoLibro = $libroComprado['id_multimedia'];
$correoUsuario = $_SESSION['correo'];
$idUsuario = $_SESSION['id'];
$checkAlreadyHave = Book::VerifyOwnedBook($correoUsuario, $codigoLibro);
$checkBalance = Book::VerifyBalance($idUsuario, $costo);

if ($checkAlreadyHave == false && $checkBalance == true) {
	Book::SetOwnedBook2($codigoLibro, $correoUsuario, $fechaCompra);
	Book::SetBalance($idUsuario, $costo);
	AuditLogs::AddNewLog('Compró un nuevo libro', '7');
	header("location: listado?successBuy");
} else if ($checkAlreadyHave == true) {
	header("location: listado?alreadyHave");
} else if ($checkBalance == false) {
	header("location: listado?noBalance");
}
