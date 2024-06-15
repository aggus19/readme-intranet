<?php

class VPS
{
    public static function GetDiskSpace()
    {
        $bytes = disk_free_space("/");
        $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
        $base = 1024;
        $class = min((int)log($bytes, $base), count($si_prefix) - 1);
        $space = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
        return $space;
    }
    public static function GetRamUsage()
    {
        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2] / $mem[1] * 100;
        $memory_usage = round($memory_usage, 2);
        return $memory_usage . '%' . ' / 100%';
    }

    public static function ImageToBase64($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public static function SystemUptime()
    {
        $uptime = shell_exec('uptime');
        $uptime = (string)trim($uptime);
        $uptime = explode(" ", $uptime);
        $uptime = array_filter($uptime);
        $uptime = array_merge($uptime);
        $uptime = $uptime[2] . ' día' . $uptime[3] . ' ' . $uptime[4] . ' horas';
        $uptime = str_replace("day", "", $uptime);
        $uptime = str_replace(",", "", $uptime);
        return $uptime;
    }

    public static function GetCpuUsage()
    {
        $load = sys_getloadavg();
        $cpu_usage = round($load[0] * 100 / 4, 2);
        return $cpu_usage . '%' . ' / 100%';
    }

    public static function GetOutgoingTraffic()
    {
        $bytes = shell_exec("vnstat -i ens160 --oneline | awk '{print $3}'");
        $bytes = (string)trim($bytes);
        $bytes = $bytes * 1024;
        $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
        $base = 1024;
        $class = min((int)log($bytes, $base), count($si_prefix) - 1);
        $space = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
        return $space;
    }
}
