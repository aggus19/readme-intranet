<?php
class Resenias extends Database
{
    public $id_resenia;
    public $fecha;
    public $calificacion_dada;
    public $descripcion;


    public function __construct()
    {
        $this->id_resenia = ['id_resenia'];
        $this->fecha = ['fecha'];
        $this->calificacion_dada = ['calificacion_dada'];
        $this->descripcion = ['descripcion'];
    }

    public static function GetCountResenias($correo)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT COUNT(*) FROM hace_resenia WHERE correo = :correo");
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetch();
        if ($uInfo[0] == 0) {
            $uInfo[0] = 'No has hecho ninguna reseña aún';
        } else if ($uInfo[0] == 1) {
            $uInfo[0] = 'Has hecho ' . $uInfo[0] . ' reseña';
        } else if ($uInfo[0] > 1) {
            $uInfo[0] = 'Has hecho ' . $uInfo[0] . ' reseñas';
        }
        return $uInfo[0];
    }

    public static function CheckIfReseniaOwner($correo, $idMultimedia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM hace_resenia WHERE correo = :correo AND id_multimedia = :idMultimedia");
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->bindParam(':idMultimedia', $idMultimedia, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetAllDataResenia($idResenia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM resenia WHERE id_resenia = :idResenia");
        $ads->bindParam(':idResenia', $idResenia, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetReseniaInfoFromUser($correo)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT r.descripcion, multimedia.id_multimedia, nombre, genero, tipo_multimedia  FROM hace_resenia inner join multimedia on hace_resenia.id_multimedia = multimedia.id_multimedia inner join resenia r on hace_resenia.id_resenia = r.id_resenia WHERE correo = :correo");
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetReseniaDataById($id)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT r.descripcion, multimedia.id_multimedia, nombre, genero, tipo_multimedia FROM hace_resenia inner join multimedia on hace_resenia.id_multimedia = multimedia.id_multimedia inner join resenia r on hace_resenia.id_resenia = r.id_resenia WHERE id_resenia = :id_resenia");
        $ads->bindParam(':id_resenia', $id, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetReseniaInfo()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT r.id_resenia, r.calificacion_dada, r.descripcion, multimedia.id_multimedia, nombre, genero, tipo_multimedia  FROM hace_resenia inner join multimedia on hace_resenia.id_multimedia = multimedia.id_multimedia inner join resenia r on hace_resenia.id_resenia = r.id_resenia");
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function UpdateReview($descripcion, $calificacion, $idResenia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("UPDATE resenia SET descripcion = :descripcion, calificacion_dada = :calificacion_dada WHERE id_resenia = :idResenia");
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':idResenia', $idResenia, PDO::PARAM_STR);
        $ads->execute();
    }

    public static function DeleteReview($idResenia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("DELETE FROM resenia WHERE id_resenia = :idResenia");
        $ads->bindParam(':idResenia', $idResenia, PDO::PARAM_STR);
        $ads->execute();
        $ads = $mbd->prepare("DELETE FROM hace_resenia WHERE id_resenia = :idResenia");
        $ads->bindParam(':idResenia', $idResenia, PDO::PARAM_STR);
        $ads->execute();
    }

    public static function CreateMusicReview($calificacion, $descripcion)
    {
        // Se inserta la reseña en resenia.
        $mbd = new Database();
        $tipo = 'Musica';
        $descripcion = 'Reseña de ' . $tipo . ' ';
        $usuario = $_SESSION['username'];
        $idUsuario = $_SESSION['id'];
        $correo = $_SESSION['correo'];
        $directorio = 'NO';
        $photo = 'https://i.imgur.com/sMr6PY0.png';

        // Primero se inserta la reseña en la tabla resenia.
        $ads = $mbd->prepare("INSERT INTO resenia (fecha, calificacion_dada, descripcion) VALUES (NOW(), :calificacion_dada, :descripcion)");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        // Insertar datos en la tabla multimedia.
        $ads = $mbd->prepare("INSERT INTO multimedia (nombre, genero, descripcion, rating, tipo_multimedia, uploadBy, pubBy, directorio, photo) VALUES (:nombre, :genero, :descripcion, :rating, :tipo_multimedia, :uploadBy, :idUsuario, :directorio, :photo)");
        $ads->bindParam(':nombre', $_POST['txtNombreCancion'], PDO::PARAM_STR);
        $ads->bindParam(':genero', $_POST['generoMusica'], PDO::PARAM_STR);
        $ads->bindParam(':rating', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':tipo_multimedia', $tipo, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':uploadBy', $usuario, PDO::PARAM_STR);
        $ads->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $ads->bindParam(':directorio', $directorio, PDO::PARAM_STR);
        $ads->bindParam(':photo', $photo, PDO::PARAM_STR);
        $ads->execute();
        // Obtener el id multimedia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_multimedia FROM multimedia WHERE nombre = :nombre AND genero = :genero AND descripcion = :descripcion AND uploadBy = :uploadBy");
        $ads->bindParam(':nombre', $_POST['txtNombreCancion'], PDO::PARAM_STR);
        $ads->bindParam(':genero', $_POST['generoMusica'], PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':uploadBy', $usuario, PDO::PARAM_STR);
        $ads->execute();
        $idMultimedia = $ads->fetch();
        // Obtener el id resenia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_resenia FROM resenia WHERE fecha = NOW() AND calificacion_dada = :calificacion_dada AND descripcion = :descripcion");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        $idResenia = $ads->fetch();
        // Insertar datos en la tabla hace_resenia.
        $ads = $mbd->prepare("INSERT INTO hace_resenia (id_resenia, id_multimedia, correo) VALUES (:id_resenia, :id_multimedia, :correo)");
        $ads->bindParam(':id_resenia', $idResenia['id_resenia'], PDO::PARAM_STR);
        $ads->bindParam(':id_multimedia', $idMultimedia['id_multimedia'], PDO::PARAM_STR);
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->execute();
    }
    public static function CreateMovieReview($calificacion, $descripcion)
    {
        // Se inserta la reseña en resenia.
        $mbd = new Database();
        $tipo = 'Pelicula';
        $descripcion = 'Reseña de ' . $tipo . ' ';
        $usuario = $_SESSION['username'];
        $idUsuario = $_SESSION['id'];
        $correo = $_SESSION['correo'];
        $directorio = 'NO';
        $photo = 'https://i.imgur.com/3nM29bW.png';

        // Primero se inserta la reseña en la tabla resenia.
        $ads = $mbd->prepare("INSERT INTO resenia (fecha, calificacion_dada, descripcion) VALUES (NOW(), :calificacion_dada, :descripcion)");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        // Insertar datos en la tabla multimedia.
        $ads = $mbd->prepare("INSERT INTO multimedia (nombre, genero, descripcion, rating, tipo_multimedia, uploadBy, pubBy, directorio, photo) VALUES (:nombre, :genero, :descripcion, :rating, :tipo_multimedia, :uploadBy, :idUsuario, :directorio, :photo)");
        $ads->bindParam(':nombre', $_POST['txtNombrePeli'], PDO::PARAM_STR);
        $ads->bindParam(':genero', $_POST['generoPeli'], PDO::PARAM_STR);
        $ads->bindParam(':rating', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':tipo_multimedia', $tipo, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':uploadBy', $usuario, PDO::PARAM_STR);
        $ads->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $ads->bindParam(':directorio', $directorio, PDO::PARAM_STR);
        $ads->bindParam(':photo', $photo, PDO::PARAM_STR);
        $ads->execute();
        // Obtener el id multimedia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_multimedia FROM multimedia WHERE nombre = :nombre AND genero = :genero AND descripcion = :descripcion AND uploadBy = :uploadBy");
        $ads->bindParam(':nombre', $_POST['txtNombrePeli'], PDO::PARAM_STR);
        $ads->bindParam(':genero', $_POST['generoPeli'], PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':uploadBy', $usuario, PDO::PARAM_STR);
        $ads->execute();
        $idMultimedia = $ads->fetch();
        // Obtener el id resenia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_resenia FROM resenia WHERE fecha = NOW() AND calificacion_dada = :calificacion_dada AND descripcion = :descripcion");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        $idResenia = $ads->fetch();
        // Insertar datos en la tabla hace_resenia.
        $ads = $mbd->prepare("INSERT INTO hace_resenia (id_resenia, id_multimedia, correo) VALUES (:id_resenia, :id_multimedia, :correo)");
        $ads->bindParam(':id_resenia', $idResenia['id_resenia'], PDO::PARAM_STR);
        $ads->bindParam(':id_multimedia', $idMultimedia['id_multimedia'], PDO::PARAM_STR);
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->execute();
    }
    public static function CreateBookReview($idMultimedia, $descripcion, $calificacion)
    {
        // Se inserta la reseña en resenia.
        $mbd = new Database();
        $correo = $_SESSION['correo'];
        // Primero se inserta la reseña en la tabla resenia.
        $ads = $mbd->prepare("INSERT INTO resenia (fecha, calificacion_dada, descripcion) VALUES (NOW(), :calificacion_dada, :descripcion)");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        // Obtener el id multimedia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_multimedia FROM multimedia WHERE id_multimedia = :idM");
        $ads->bindParam(':idM', $_POST['selectLibros'], PDO::PARAM_STR);
        $ads->execute();
        $idMultimedia = $ads->fetch();
        // Obtener el id resenia recien insertado e insertarlo en hace_resenia.
        $ads = $mbd->prepare("SELECT id_resenia FROM resenia WHERE fecha = NOW() AND calificacion_dada = :calificacion_dada AND descripcion = :descripcion");
        $ads->bindParam(':calificacion_dada', $calificacion, PDO::PARAM_STR);
        $ads->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $ads->execute();
        $idResenia = $ads->fetch();
        // Insertar datos en la tabla hace_resenia.
        $ads = $mbd->prepare("INSERT INTO hace_resenia (id_resenia, id_multimedia, correo) VALUES (:id_resenia, :id_multimedia, :correo)");
        $ads->bindParam(':id_resenia', $idResenia['id_resenia'], PDO::PARAM_STR);
        $ads->bindParam(':id_multimedia', $idMultimedia['id_multimedia'], PDO::PARAM_STR);
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->execute();
    }
}
