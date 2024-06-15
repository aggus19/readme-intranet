<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';
$random = substr(md5(mt_rand()), 0, 7);
$idUsuario = $_SESSION['id'];
$username = $_SESSION['username'];
$carpeta = "fotosPerfil/";
$archivoFinal = $carpeta  . $idUsuario . "-" . $random . "-" . basename($_FILES["fileToUpload"]["name"]);
$subidaOk = 1;
$tipoArchivo = strtolower(pathinfo($archivoFinal, PATHINFO_EXTENSION));
// Subir la foto al servidor de archivos ftp 

if (isset($_POST["subir"])) {
    $verifica = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($verifica !== false) {
        echo "Es una imagen - " . $verifica["mime"] . ".";
        $subidaOk = 1;
    } else {
        echo "No es una imagen.";
        $subidaOk = 0;
    }
}

if (file_exists($archivoFinal)) {
    echo "Ya existe el archivo.";
    $subidaOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Es muy pesado.";
    $subidaOk = 0;
}

if (
    $tipoArchivo != "jpg" && $tipoArchivo != "png" && $tipoArchivo != "jpeg"
    && $tipoArchivo != "gif"
) {
    echo "Solo archivos JPG, JPEG, PNG & GIF.";
    $subidaOk = 0;
}

if ($subidaOk == 0) {
    echo "No fue subido.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $archivoFinal)) {
        echo "El archivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " fue subido.";
        User::UpdateProfilePic($archivoFinal);
        AuditLogs::AddNewLog("El usuario " . $username . " cambió su foto de perfil.", 8);
        header('location: user?id=' . $idUsuario);
    } else {
        echo "Error al subir el archivo.";
    }
}
