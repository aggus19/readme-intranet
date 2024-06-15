<?php

include_once 'includes/adminPerms.php';
/*
    ___   __  ____________  ____  ___________
   /   | / / / /_  __/ __ \/ __ \/ ____/ ___/
  / /| |/ / / / / / / / / / /_/ / __/  \__ \ 
 / ___ / /_/ / / / / /_/ / _, _/ /___ ___/ / 
/_/  |_\____/ /_/  \____/_/ |_/_____//____/  
                                             
                                           
*/

include_once 'includes/general.php';

$idAutor = $_POST['autorId'];
$nomAutor = $_POST['autorNombre'];
$apeAutor = $_POST['autorApellido'];
$nacionalidad = $_POST['autorNacionalidad'];
$fechaNacimiento = $_POST['autorNacimiento'];
$profilePic = $_POST['autorPic'];

$nuevoAutor = new Autores($idAutor);

if ($idAutor == '') {
    $idAutor = $nuevoAutor->id_autor;
}
if ($nomAutor == '') {
    $nomAutor = $nuevoAutor->nombre;
}
if ($apeAutor == '') {
    $apeAutor = $nuevoAutor->apellido;
}
if ($nacionalidad == '') {
    $nacionalidad = $nuevoAutor->nacionalidad;
}
if ($fechaNacimiento == '') {
    $fechaNacimiento = $nuevoAutor->fechaNacimiento;
}
if ($profilePic == '') {
    $profilePic = $nuevoAutor->profilePic;
}

Autores::UpdateAutorDetails($idAutor, $nomAutor, $apeAutor, $nacionalidad, $fechaNacimiento, $profilePic);

// Si todo sale bien redireccionamos a la pagina de inicio, sino, mostramos un mensaje de error
if ($nuevoAutor->id_autor == $idAutor) {
    header("location: manage-autores?successEdit=1");
} else {
    header("location: manage-autores?error=1");
}
