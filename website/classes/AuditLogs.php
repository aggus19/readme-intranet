<?php
class AuditLogs extends Database
{
    public $Id;
    public $correo;
    public $userId;
    public $username;
    public $ip;
    public $type;
    public $info;
    public $date;
    public $localidad;

    public function __construct($auditLog)
    {
        $this->Id = $auditLog['Id'];
        $this->correo = $auditLog['correo'];
        $this->userId = $auditLog['userId'];
        $this->username = $auditLog['username'];
        $this->ip = $auditLog['ip'];
        $this->type = $auditLog['type'];
        $this->info = $auditLog['info'];
        $this->date = $auditLog['date'];
        $this->localidad = $auditLog['localidad'];
    }

    public static function GetAllLogs()
    {
        $mbd = new Database();
        $query = $mbd->prepare("SELECT DATE_FORMAT(date, '%d/%m/%Y %H:%i:%s') AS date, info, type, localidad, ip, userId, Id, username FROM users_logs ORDER BY Id DESC");
        $query->execute();
        $query = $query->fetchAll();
        foreach ($query as $key => $value) {
            if ($value['type'] == 1) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-success bi bi-shield-check"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 2) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-danger fas fa-trash"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 3) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-white bi bi-pencil-square"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 4) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-white bi bi-person-plus-fill"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 5) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-white fa-solid fa-plus"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 6) {
                $query[$key]['type'] = '<span class="text-hover-primary badge badge-light-primary me-1"><strong><i class="text-white fa-sharp fa-solid fa-arrow-right-from-bracket"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 7) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-sharp fa-solid fa-cart-shopping"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 8) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-solid fa-camera"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 9) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-danger fas fa-trash"> </i>  </strong> </span>';
            }
            // Si el pais es Uruugya se inserta un icono de Uruguay
            if ($value['localidad'] == 'Uruguay') {
                $query[$key]['localidad'] = '<img src="assets/media/flags/uy.svg" alt="Uruguay" width="22" height="22" class="rounded-circle">';
            } elseif ($value['localidad'] == 'Argentina') {
                $query[$key]['localidad'] = '<img src="assets/media/flags/ar.svg" alt="Argentina" width="22" height="22" class="rounded-circle">';
            }
        }
        return $query;
    }

    public static function ShowUserLogs($idUsuario)
    {
        $mbd = new Database();
        $query = $mbd->query("SELECT * FROM users_logs WHERE userId = $idUsuario");
        $query->execute();
        $logsData = $query->fetchAll();
        return true;
    }

    public static function AddNewLog($info, $typeLog)
    {
        $localidad = IP::GetLocationFromIP(IP::GetIP());
        if ($localidad == '::1') {
            $localidad = 'Sin especificar';
        }
        $ip = IP::GetIP();
        $fecha = Time::EpochToDate(Time::GetCurrentTime());
        $mbd = new Database();
        $query = $mbd->prepare("INSERT INTO users_logs (correo, userId, username, ip, type, info, date, localidad) VALUES (:correo, :userId, :user_name, :ip, :type, :info, NOW(), :localidad)");
        $query->bindParam(':correo', $_SESSION['correo']);
        $query->bindParam(':userId', $_SESSION['id']);
        $query->bindParam(':user_name', $_SESSION['username']);
        $query->bindParam(':type', $typeLog);
        $query->bindParam(':info', $info);
        $query->bindParam(':ip', $ip);
        $query->bindParam(':localidad', $localidad);
        $query->execute();
        return true;
    }

    public static function GetLastIp($idUsuario)
    {
        $mbd = new Database();
        $query = $mbd->prepare("SELECT ip FROM users_logs WHERE userId = :idUsuario ORDER BY Id DESC LIMIT 1");
        $query->bindParam(':idUsuario', $idUsuario);
        $query->execute();
        $query = $query->fetch();
        return $query['ip'];
    }

    public static function GetLogsFromUser($username)
    {
        $mbd = new Database();
        $query = $mbd->prepare("SELECT DATE_FORMAT(date, '%d/%m/%Y %H:%i:%s') AS date, info, type, localidad, ip, username, userId FROM users_logs WHERE userId = :u ORDER BY Id DESC LIMIT 20");
        $query->bindParam(':u', $username, PDO::PARAM_STR);
        $query->execute();
        $query = $query->fetchAll();

        foreach ($query as $key => $value) {
            if ($value['type'] == 1) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-success bi bi-shield-check"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 2) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-danger fas fa-trash"> </i>  </strong> </span>';
            } elseif ($value['type'] == 3) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white bi bi-pencil-square"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 4) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white bi bi-person-plus-fill"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 5) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-solid fa-plus"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 6) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-sharp fa-solid fa-arrow-right-from-bracket"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 7) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-sharp fa-solid fa-cart-shopping"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 8) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-white fa-solid fa-camera"> </i>  </strong> </span> ';
            } elseif ($value['type'] == 9) {
                $query[$key]['type'] = '<span class="me-sm-2 text-hover-primary badge badge-light-primary"><strong><i class="text-danger fas fa-trash"> </i>  </strong> </span>';
            }
        }
        return $query;
    }
}
