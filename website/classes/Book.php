<?php
class Book extends Database
{
    public $id_multimedia;
    public $rating;
    public $tipo_multimedia;
    public $nombre;
    public $descripcion;
    public $genero;
    public $fecha_publicacion;
    public $costo;
    public $uploadBy;
    public $photo;
    public $pubBy;
    public $directorio;

    public function __construct($id_multimedia)
    {
        $data = Book::GetInfoFromBookId($id_multimedia);
        foreach ($data as $info) {
            $this->id_multimedia = $id_multimedia;
            $this->rating = $info['rating'];
            $this->nombre = $info['nombre'];
            $this->tipo_multimedia = $info['tipo_multimedia'];
            $this->descripcion = $info['descripcion'];
            $this->genero = $info['genero'];
            $this->fecha_publicacion = $info['fecha_publicacion'];
            $this->costo = $info['costo'];
            $this->uploadBy = $info['uploadBy'];
            $this->photo = $info['photo'];
            $this->pubBy = $info['pubBy'];
            $this->directorio = $info['directorio'];
        }
    }

    public static function GetAllBooks()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia WHERE tipo_multimedia = 'Libro'");
        $ads->execute();
        $uInfo = $ads->fetchAll();
        foreach ($uInfo as $key => $value) {

            if ($value['rating'] == '') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-regular fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i>';
            }
            if ($value['rating'] == '1') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i>';
            }
            if ($value['rating'] == '2') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i></i>';
            }
            if ($value['rating'] == '3') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i></i></i>';
            }
            if ($value['rating'] == '4') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i></i></i></i></i>';
            }
            if ($value['rating'] == '5') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"></i></i></i></i></i>';
            }
            if ($value['nombre'] == '') {
                $uInfo[$key]['nombre'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['genero'] == '') {
                $uInfo[$key]['genero'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['costo'] == '') {
                $uInfo[$key]['costo'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['fecha_publicacion'] == '') {
                $uInfo[$key]['fecha_publicacion'] = '<span class="text-danger"> Sin fecha de publicación</span>';
            }
        }
        return $uInfo;
    }

    public static function GetLatest5Books()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia WHERE tipo_multimedia = 'Libro' ORDER BY fecha_publicacion DESC LIMIT 5");
        $ads->execute();
        $uInfo = $ads->fetchAll();
        foreach ($uInfo as $key => $value) {
            if ($value['rating'] == '') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-regular fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i>';
            }
            if ($value['rating'] == '1') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i>';
            }
            if ($value['rating'] == '2') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i></i>';
            }
            if ($value['rating'] == '3') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i><i class="text-warning fa-regular fa-star"></i></i></i></i>';
            }
            if ($value['rating'] == '4') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-regular fa-star"></i></i></i></i></i>';
            }
            if ($value['rating'] == '5') {
                $uInfo[$key]['rating'] = '<i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"><i class="text-warning fa-solid fa-star"></i></i></i></i></i>';
            }
            if ($value['nombre'] == '') {
                $uInfo[$key]['nombre'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['genero'] == '') {
                $uInfo[$key]['genero'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['costo'] == '') {
                $uInfo[$key]['costo'] = '<span class="text-danger"> N/A</span>';
            }
            if ($value['fecha_publicacion'] == '') {
                $uInfo[$key]['fecha_publicacion'] = '<span class="text-danger"> Sin fecha de publicación</span>';
            }
        }
        return $uInfo;
    }

    public static function UpdateBookInfo($nombre, $descripcion, $genero, $costo, $codigoLibro)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("UPDATE multimedia	SET nombre = :n, descripcion = :d, genero = :g, costo = :costo, id_multimedia = :c WHERE id_multimedia = :c");
        $ads->bindParam(':c', $codigoLibro, PDO::PARAM_STR);
        $ads->bindParam(':n', $nombre, PDO::PARAM_STR);
        $ads->bindParam(':d', $descripcion, PDO::PARAM_STR);
        $ads->bindParam(':g', $genero, PDO::PARAM_STR);
        $ads->bindParam(':costo', $costo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    // INNER JOIN Funcion para obtener el idLibro que el usuario tiene en la tabla de libros_adquiridos, Despues con ese valor buscarlo en la tabla de libros y obtener el nombre del libro
    public static function GetOwnedBook($correo)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia INNER JOIN users_alquila ON multimedia.id_multimedia = users_alquila.id_multimedia WHERE correo = :o");
        $ads->bindParam(':o', $correo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        foreach ($uInfo as $key => $value) {
            if ($value['rating'] == '') {
                $uInfo[$key]['rating'] = 'Sin rating';
            }
            if ($value['nombre'] == '') {
                $uInfo[$key]['nombre'] = 'Sin nombre';
            }
            if ($value['genero'] == '') {
                $uInfo[$key]['genero'] = 'Sin genero';
            }
            if ($value['costo'] == '') {
                $uInfo[$key]['costo'] = 'Sin costo';
            }
            if ($value['fecha_publicacion'] == '') {
                $uInfo[$key]['fecha_publicacion'] = 'Sin fecha';
            }
            if ($value['pubBy'] == '') {
                $uInfo[$key]['pubBy'] = '0';
            }
        }
        return $uInfo;
    }

    public static function SetOwnedBook2($id_multimedia, $correo, $fecha_expiracion)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("INSERT INTO users_alquila (id_multimedia, correo, fecha_compra, fecha_expiracion) VALUES (:id_multimedia, :correo, NOW(), :fecha_expiracion)");
        $ads->bindParam(':id_multimedia', $id_multimedia, PDO::PARAM_STR);
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->bindParam(':fecha_expiracion', $fecha_expiracion, PDO::PARAM_STR);
        $ads->execute();
        $ads->debugDumpParams();
        return $ads;
    }

    public static function VerifyOwnedBook($correo, $idLibro)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM users_alquila WHERE correo = :o AND id_multimedia = :i");
        $ads->bindParam(':o', $correo, PDO::PARAM_STR);
        $ads->bindParam(':i', $idLibro, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    // Verificar si un usuario tiene libros alquilados
    public static function TakeDirectoryBook($correo, $id_multimedia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT directorio FROM multimedia INNER JOIN users_alquila ON multimedia.id_multimedia = users_alquila.id_multimedia WHERE correo = :o AND multimedia.id_multimedia = :idM");
        $ads->bindParam(':idM', $id_multimedia, PDO::PARAM_STR);
        $ads->bindParam(':o', $correo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        if ($uInfo[0]['directorio'] == 'NO') {
            header('Location: 404');
        } else {
            return $uInfo[0]['directorio'];
        }
    }

    public static function CheckBookOwner($correo, $id_multimedia)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT id_multimedia FROM users_alquila WHERE correo = :o AND id_multimedia = :idM");
        $ads->bindParam(':idM', $id_multimedia, PDO::PARAM_STR);
        $ads->bindParam(':o', $correo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo[0]['id_multimedia'];
    }

    // Funcion para verificar si el usuario tiene saldo suficiente para comprar el libro
    public static function VerifyBalance($idUsuario, $costo)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM users_accounts WHERE id = :o AND creditos >= :c");
        $ads->bindParam(':o', $idUsuario, PDO::PARAM_STR);
        $ads->bindParam(':c', $costo, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    // Funcion para restar el saldo del usuario
    public static function SetBalance($idUsuario, $costo)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("UPDATE users_accounts SET creditos = creditos - :c WHERE id = :o");
        $ads->bindParam(':o', $idUsuario, PDO::PARAM_STR);
        $ads->bindParam(':c', $costo, PDO::PARAM_STR);
        $ads->execute();
        return $ads;
    }

    public static function GetInfoFromBookId($id)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia WHERE id_multimedia = :u");
        $ads->bindParam(":u", $id);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        if ($uInfo['descripcion'] == null || $uInfo['genero'] == null || $uInfo['rating'] == null || $uInfo['costo'] == null || $uInfo['photo'] == null) {
            $uInfo['descripcion'] = ' No tiene descripcion';
            $uInfo['genero'] = ' No tiene genero';
            $uInfo['rating'] = 'No tiene rating';
            $uInfo['costo'] = 'No tiene costo';
            $uInfo['photo'] = '../assets/media/Libro.png';
        }
        return $uInfo[0];
    }

    public static function GetBooksFromAutor($id)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT nombre, id_multimedia FROM multimedia WHERE pubBy = :u");
        $ads->bindParam(":u", $id);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }


    public static function AddNewBook($nomLibro, $descLibro, $genLibro, $fechaPublicado, $ratingLibro, $costoLibro, $pubBy)
    {
        $mbd = new Database();
        $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $mbd->prepare("INSERT INTO multimedia (nombre, tipo_multimedia, descripcion, genero, fecha_publicacion, rating, costo, photo, pubBy) VALUES (:nL, 'Libro', :dL,:gL,:fpL,:rL,:cL, 'http://dummyimage.com/132x100.png/cc0000/ffffff', :pb)");
        $query->bindParam(":nL", $nomLibro);
        $query->bindParam(":dL", $descLibro);
        $query->bindParam(":gL", $genLibro);
        $query->bindParam(":fpL", $fechaPublicado);
        $query->bindParam(":rL", $ratingLibro);
        $query->bindParam(":cL", $costoLibro);
        $query->bindParam(":pb", $pubBy);
        $query->execute();
        return true;
    }

    public static function DeleteBook($bookId)
    {
        $pdo = new Database();
        $query = $pdo->prepare("DELETE FROM multimedia WHERE id_multimedia = :bId");
        $query->bindParam(':bId', $bookId, PDO::PARAM_STR);
        $query->execute();
        return true;
    }

    public static function GetNumberBooks()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia WHERE tipo_multimedia = 'Libro'");
        $ads->execute();
        return $ads->rowCount();
    }
    public static function GetLastBook()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM multimedia WHERE tipo_multimedia = 'Libro' ORDER BY id_multimedia DESC LIMIT 1");
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo[0]['nombre'];
    }
}
