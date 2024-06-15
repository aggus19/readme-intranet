<?php
include_once 'classes/Database.php';
include_once 'classes/User.php';

$idUsuario = $_SESSION['id'];
$persona = User::GetUserById($idUsuario);
$perms_level = $persona[0]['perms_level'];

if ($perms_level <= 1) {
	header("location: index");
}
