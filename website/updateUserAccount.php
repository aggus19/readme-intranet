<?php

include_once 'includes/adminPerms.php';
include_once 'includes/general.php';
/*
   __   _____  ___    __    ___  __    
  / /   \_   \/ __\  /__\  /___\/ _\   
 / /     / /\/__\// / \// //  //\ \    
/ /___/\/ /_/ \/  \/ _  \/ \_// _\ \   
\____/\____/\_____/\/ \_/\___/  \__/   
                                       
*/


$idUser = $_POST['uId'];
$username = $_POST['uUsername'];
$nombre = $_POST['uName'];
$apellido = $_POST['uApe'];
$password = md5($_POST['uPass']);
$correo = $_POST['uEmail'];
$celular = $_POST['uCel'];
$creditos = $_POST['uCredits'];

$usuario = new User($idUser);

if ($username == '') {
    $username = $usuario->username;
}
if ($nombre == '') {
    $nombre = $usuario->nombre;
}
if ($apellido == '') {
    $apellido = $usuario->apellido;
}
if ($password == '') {
    $password = $usuario->password;
}
if ($correo == '') {
    $correo = $usuario->correo;
}
if ($celular == '') {
    $celular = $usuario->celular;
}
if ($creditos == '') {
    $creditos = $usuario->creditos;
}

// Si ya existe el usuario, no se puede actualizar y redirigir a la página de error

if ($usuario->id == $idUser) {
    header("location: manage-users?successEdit=1");
    User::UpdateAccountDetails($idUser, $username, $nombre, $apellido, $password, $correo, $celular, $creditos);
    if ($username != $usuario->username) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->username** " . "\n\n `✏️ New value:` **$username** " . "\n\n `🌎` **URL:** $url");
    }
    if ($nombre != $usuario->nombre) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->nombre** " . "\n\n `✏️ New value:` **$nombre** " . "\n\n `🌎` **URL:** $url");
    }
    if ($apellido != $usuario->apellido) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->apellido** " . "\n\n `✏️ New value:` **$apellido** " . "\n\n `🌎` **URL:** $url");
    }
    if ($password != $usuario->password) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->password** " . "\n\n `✏️ New value:` **$password** " . "\n\n `🌎` **URL:** $url");
    }
    if ($correo != $usuario->correo) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->correo** " . "\n\n `✏️ New value:` **$correo** " . "\n\n `🌎` **URL:** $url");
    }
    if ($celular != $usuario->celular) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->celular** " . "\n\n `✏️ New value:` **$celular** " . "\n\n `🌎` **URL:** $url");
    }
    if ($creditos != $usuario->creditos) {
        Discord::SendWebhook("[ADMIN] | Edited profile details",  "**User edited:** " . "`" . $usuario->GetUserById($idUser)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n **Admin:** " . "`" . $_SESSION['username'] . "`" . "\n\n `✏️ Old value:` **$usuario->creditos** " . "\n\n `✏️ New value:` **$creditos** " . "\n\n `🌎` **URL:** $url");
    }
} else {
    header("location: manage-users?error");
}
