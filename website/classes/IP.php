<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

class IP
{
    public static function GetLocationFromIP($ip)
    {
        $info = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));
        return $info->geoplugin_countryName;
    }

    public static function GetIP()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function UpdateIP()
    {
        $mbd = new Database();
        $last_login = Time::EpochToDate(Time::GetCurrentTime());
        $ip = IP::GetIP();
        $localidad = IP::GetLocationFromIP(IP::GetIP());
        $usuario = $_SESSION["username"];
        $queryLastLogin = $mbd->prepare("UPDATE users_accounts SET lastLogin = :ll, localidad = :localidad, ip = :ra WHERE username = :u");
        $queryLastLogin->bindParam(":ll", $last_login);
        $queryLastLogin->bindParam(":ra", $ip);
        $queryLastLogin->bindParam(":u", $usuario);
        $queryLastLogin->bindParam(":localidad", $localidad);
        $queryLastLogin->execute();
        return true;
    }
}
