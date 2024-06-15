<?php
include "classes/Database.php";
include "classes/User.php";
include "classes/AuditLogs.php";
include "classes/Time.php";
include "classes/Discord.php";
include "classes/Messages.php";

$checkEmail = User::CheckEmail($_POST['email']);

if ($checkEmail == true) {
	header("Location: sign-up?errorEmailAlreadyExists=true&email=" . $_POST['email']);
} else {
	if (isset($_POST['btnRegister']) && $checkEmail == false && !empty($_POST['email']) && !empty($_POST['nomUsuario']) && !empty($_POST['celular']) && !empty($_POST['passwordUser']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['fechaNac'])) {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$usuario = $_POST['nomUsuario'];
		$celular = $_POST['celular'];
		$email = $_POST['email'];
		$password = $_POST['passwordUser'];
		$passHash = md5($password);
		$fechaRegistro = date("Y-m-d");
		$fechaNac = Time::ConvertDateToDB($_POST['fechaNac']);
		$ipUsuario = IP::GetIP();
		$queryRegistro = User::RegisterUser($email, $usuario, $passHash, $nombre, $apellido, $celular, $fechaRegistro, $ipUsuario, $fechaNac);
		if ($queryRegistro == true) {
			header("Location: sign-in?successCreated=true");
		} else {
			header("Location: sign-up?errorProcess=true");
		}
	} else {
		header("Location: sign-up?errorProcess=true");
	}
}
