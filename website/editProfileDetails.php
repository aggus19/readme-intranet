<?php

include_once 'includes/general.php';

/*
   __  _______ __  _____    ____  ________ 
  / / / / ___// / / /   |  / __ \/  _/ __ \
 / / / /\__ \/ / / / /| | / /_/ // // / / /
/ /_/ /___/ / /_/ / ___ |/ _, _// // /_/ / 
\____//____/\____/_/  |_/_/ |_/___/\____/  
                                           
*/

$nombre = $_POST['nombreUser'];
$idUusario = $_POST['idUsuario'];
$apellido = $_POST['apeUser'];
$correo = $_POST['correoEle'];
$celular = $_POST['celular'];
$correoSession = $_SESSION['correo'];
$contrasenia = $_POST['contrasenia'];
$encriptada = md5($contrasenia);

$user = new User($idUusario);

// Cambiar solo X campo, si no ingresa un valor en X campo, que se mantenga al valor actual de X campo
if ($nombre == '') {
  $nombre = $user->nombre;
}
if ($apellido == '') {
  $apellido = $user->apellido;
}
if ($correo == '') {
  $correo = $user->correo;
}
if ($celular == '') {
  $celular = $user->celular;
}

// Si recibe vacio el valor de CONTRASENIA, que no se cambie
if (empty($contrasenia)) {
  $contrasenia = $user->password;
} else {
  $contrasenia = $encriptada;
}

// Insertar un log si se cambia el valor de algun campo
if ($nombre != $user->nombre) {
  AuditLogs::AddNewLog("Cambio de nombre", "3");
}
if ($apellido != $user->apellido) {
  AuditLogs::AddNewLog("Cambio de apellido", "3");
}
if ($correo != $user->correo) {
  AuditLogs::AddNewLog("Cambio de correo", "3");
}
if ($celular != $user->celular) {
  AuditLogs::AddNewLog("Cambio de celular", "3");
}
if ($contrasenia != $user->password) {
  AuditLogs::AddNewLog("Cambio de contraseña", "3");
}

// Verificar primero si ya no existe un usuario con el correo que se quiere cambiar. Si existe, no cambiarlo. Si no existe, cambiarlo.
User::UpdateProfileDetails($nombre, $apellido, $correo, $celular, $idUusario, $contrasenia);
header("location: user?id=$idUusario&success");
