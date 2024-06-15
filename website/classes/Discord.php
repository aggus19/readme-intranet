<?php

class Discord extends IP
{
    public static function SendWebhook($title, $content)
    {
        $webhook = "https://discord.com/api/webhooks/1025662197285781504/tEU8moD3ZLUbjvr7yFYSW6mG2aq1p0YUvxhgQButjCy438DaFOLsgvf8FAz6PiZUckvg";

        $timestamp = date("c", strtotime("now"));

        $json_data = json_encode([
            "username" => "Audit Logs",
            "embeds" => [
                [
                    "title" => "$title",
                    "type" => "rich",
                    "description" => "$content",
                    "url" => "https://panel.agrasystems.us/libros",
                    "timestamp" => $timestamp,
                    "color" => hexdec("2C2F33"),
                    "footer" => [
                        //"text" => "github.com/AgusUruguayo",
                        "icon_url" => "https://cdn-icons-png.flaticon.com/512/25/25231.png"
                    ],
                    "avatar_url" => "https://i.imgur.com/ayCu9FL.png",
                    "author" => [
                        "name" => "logs | panel",
                        "url" => "https://panel.agrasystems.us/libros",
                        "icon_url" => "https://i.imgur.com/ayCu9FL.png"
                    ],
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $ch = curl_init($webhook);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function WebhookAddNewUser($usuario)
    {
        $webhook = "https://discord.com/api/webhooks/1025662197285781504/tEU8moD3ZLUbjvr7yFYSW6mG2aq1p0YUvxhgQButjCy438DaFOLsgvf8FAz6PiZUckvg";
        $headers = ['Content-Type: application/json; charset=utf-8'];
        $ip = IP::GetIP();
        $date = new DateTime("now", new DateTimeZone('America/Montevideo'));
        $POST = ['username' => 'intranet logs | readme', 'content' =>  '`➕` Nuevo usuario creado: ' . "\n" . '`🖥️` **IP:** ' . IP::GetIP() . ' `(' . IP::GetLocationFromIP($ip) . ')`' . "\n" . "`🗒️` **Usuario creado:** `" . $usuario . "`"  . "\n" . "`🛡️` **Administrador:** `" . $_SESSION['username'] . "`"  . "\n" . "`📅` **Fecha:** `" . $date->format('d-m-Y H:i:s') . "`"];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
        return $response;
    }
}
