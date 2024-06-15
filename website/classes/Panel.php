<?php
class Panel extends Database
{
    public $logo;
    public $tabName;
    public $logoReadme;
    public $url;

    public function __construct()
    {
    }

    public static function GetTabName()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT tabName FROM panel_info");
        $ads->execute();
        $tabName = $ads->fetch();
        return $tabName['tabName'];
    }

    public static function GetLogo()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT logo FROM panel_info");
        $ads->execute();
        $logo = $ads->fetch();
        return $logo['logo'];
    }
    public static function GetLogoReadme()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT logoReadme FROM panel_info");
        $ads->execute();
        $logo = $ads->fetch();
        return $logo['logoReadme'];
    }
    public static function GetURL()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT url FROM panel_info");
        $ads->execute();
        $url = $ads->fetch();
        return $url['url'];
    }
    public static function GetOwner()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT owner FROM panel_info");
        $ads->execute();
        $owner = $ads->fetch();
        return $owner['owner'];
    }
    // Funcion para generar string con caracteres aleatorios y simbolos para el cambio de contraseña
    public static function GenerateString()
    {
        $string = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'), array('!', '@', '#', '$', '%'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 15; $i++) {
            $rand = mt_rand(0, $max);
            $string .= $characters[$rand];
        }
        return $string;
    }
    public static function GetDevelopersInfo()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM panel_developers");
        $ads->execute();
        $developers = $ads->fetchAll();
        foreach ($developers as $key => $value) {
            if ($value['colorBadge'] == '1') {
                $developers[$key]['colorBadge'] = "badge badge-light-danger";
            } else if ($value['colorBadge'] == '2') {
                $developers[$key]['colorBadge'] = "badge badge-light-primary";
            } else if ($value['colorBadge'] == '3') {
                $developers[$key]['colorBadge'] = "badge badge-light-success";
            } else if ($value['colorBadge'] == '4') {
                $developers[$key]['colorBadge'] = "badge badge-light-info";
            } else if ($value['colorBadge'] == '5') {
                $developers[$key]['colorBadge'] = "badge badge-light-warning";
            } else if ($value['colorBadge'] == '') {
                $developers[$key]['colorBadge'] = "badge badge-light-dark";
            }
        }
        return $developers;
    }
    public static function GetLatrelaInfo()
    {
        $mbd = new Database();
        $ads = $mbd->prepare("SELECT * FROM panel_lateral");
        $ads->execute();
        $lateralInfo = $ads->fetchAll();
        return $lateralInfo;
    }
}
