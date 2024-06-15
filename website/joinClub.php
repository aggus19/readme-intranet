<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';

if (isset($_GET['idClub'])) {
	$clubId = $_GET['idClub'];
	$correo = $_SESSION['correo'];
	$isOwner = '0';
	$verificar = Clubes::CheckIfIsInClub($correo, $clubId);
	if ($verificar == false) {
		Clubes::InsertNewMember($correo, $clubId, $isOwner);
		AuditLogs::AddNewLog("Se unió al club #$clubId", "5");
		header("Location: clubes?status=joined&clubId=$clubId");
	} else {
		header("Location: clubes?status=alreadyMember&clubId=$clubId");
	}
}
exit;
