<?php
class Clubes extends Database
{
    public $codigo_club;
    public $rating;
    public $nombre;
    public $descripcion;
    public $fecha_creacion;
    public $genero;
    public $icon;
    public $createdBy;


    public function __construct()
    {
        $this->codigo_club = ['codigo_club'];
        $this->descripcion = ['descripcion'];
        $this->rating = ['rating'];
        $this->nombre = ['nombre'];
        $this->genero = ['genero'];
        $this->createdBy = ['createdBy'];
        $this->icon = ['icon'];
        $this->fecha_creacion = ['fecha_creacion'];
    }

    public static function GetAllClubes()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT codigo_club, descripcion, DATE_FORMAT(fecha_creacion,'%d/%m/%Y') AS fecha_creacion , rating, nombre, genero, createdBy, icon FROM clubes ");
        $ads->execute();
        $uInfo = $ads->fetchAll();
        // Foreach para los valores de rating. En cada caso asignarle una estrella hasta 5
        foreach ($uInfo as $key => $value) {
            if ($value['rating'] == 1) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 2) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 3) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 4) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 5) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            }
        }
        return $uInfo;
    }

    public static function CheckIfUserHasClub($correo)
    {
        // Obtener el codigo_club de pertenece por el correo del usuario, despues agarrar 'codigo_club' y obtener toda la informacion del club en la tabla clubes
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT codigo_club FROM pertenece WHERE correo = :correo");
        $ads->bindParam(':correo', $correo);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function CheckIfIsOwner($correo, $codigo_club)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM pertenece WHERE correo = :correo AND codigo_club = :codigo_club");
        $ads->bindParam(':correo', $correo);
        $ads->bindParam(':codigo_club', $codigo_club);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetRating($codigo_club)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT rating FROM clubes WHERE codigo_club = :codigo_club");
        $ads->bindParam(':codigo_club', $codigo_club, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetch();
        if ($uInfo['rating'] == 1) {
            $uInfo[0] = '<i class="text-warning fas fa-star text-warning"></i>';
        } elseif ($uInfo['rating'] == 2) {
            $uInfo[0] = '<i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i>';
        } elseif ($uInfo['rating'] == 3) {
            $uInfo[0] = '<i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i>';
        } elseif ($uInfo['rating'] == 4) {
            $uInfo[0] = '<i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i>';
        } elseif ($uInfo['rating'] == 5) {
            $uInfo[0] = '<i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i><i class="text-warning fas fa-star text-warning"></i>';
        }
        return $uInfo[0];
    }


    public static function GetClubById($id)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM clubes WHERE codigo_club = :u");
        $ads->bindParam(":u", $id);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        foreach ($uInfo as $key => $value) {
            if ($value['rating'] == 1) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 2) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 3) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 4) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 5) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            }
        }
        return $uInfo;
    }

    public static function GetInfoFromUserClub()
    {
        $pdo = new Database();
        $query = $pdo->prepare("SELECT * FROM clubes INNER JOIN pertenece ON clubes.codigo_club = pertenece.codigo_club WHERE correo = :correo");
        $query->bindParam(':correo', $_SESSION['correo'], PDO::PARAM_STR);
        $query->execute();
        $uInfo = $query->fetchAll();
        foreach ($uInfo as $key => $value) {
            if ($value['rating'] == 1) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 2) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 3) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 4) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            } elseif ($value['rating'] == 5) {
                $uInfo[$key]['rating'] = '<i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i><i class="text-warning fas fa-star"></i>';
            }
        }
        return $uInfo;
    }


    public static function RemoveMember($correo, $idClub)
    {
        $pdo = new Database();
        $query = $pdo->prepare("DELETE FROM pertenece WHERE correo = :correo AND codigo_club = :idClub");
        $query->bindParam(':correo', $correo, PDO::PARAM_STR);
        $query->bindParam(':idClub', $idClub, PDO::PARAM_STR);
        $query->execute();
        return true;
    }

    public static function InsertNewMember($correo, $clubId, $isOwner)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("INSERT INTO pertenece (correo, codigo_club, isOwner) VALUES (:correo, :clubId, :isOwner)");
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->bindParam(':clubId', $clubId, PDO::PARAM_STR);
        $ads->bindParam(':isOwner', $isOwner, PDO::PARAM_STR);
        $ads->execute();
    }

    // Verificar si el usuario pertenece al id de club que se le pasa
    public static function CheckIfIsInClub($correo, $clubId)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM pertenece WHERE correo = :correo AND codigo_club = :clubId");
        $ads->bindParam(':correo', $correo, PDO::PARAM_STR);
        $ads->bindParam(':clubId', $clubId, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }

    public static function GetUserClub($idClub)
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM pertenece INNER JOIN users_accounts ON pertenece.correo = users_accounts.correo WHERE codigo_club = :idClub");
        $ads->bindParam(':idClub', $idClub, PDO::PARAM_STR);
        $ads->execute();
        $uInfo = $ads->fetchAll();
        return $uInfo;
    }
}
