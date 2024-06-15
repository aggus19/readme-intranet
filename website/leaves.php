<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';
// Si el usuario abandona el club de lectura se elimina de la tabla clubes
if (isset($_GET['idClub'])) {
	$idClub = $_GET['idClub'];
	$correo = $_SESSION['correo'];
	Clubes::RemoveMember($correo, $idClub);
	AuditLogs::AddNewLog("Abandonó el club #$idClub", "6");
	header("Location: clubes?status=leftClub&clubId=$idClub");
}

exit;
