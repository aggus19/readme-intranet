<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

class Time extends Database
{
    public static function EpochToDate($epoch)
    {
        $date = new DateTime();
        $date->setTimestamp($epoch);
        return $date->format('Y-m-d H:i:s');
    }

    public static function EpochoToDateBook($epoch)
    {
        $date = new DateTime();
        $date->setTimestamp($epoch);
        return $date->format('d-m-Y');
    }

    public static function ConvertDateToDB($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d H:i:s', strtotime($date));
        return $date;
    }

    public static function GetTimeYMD()
    {
        $date = new DateTime();
        return $date->format('Y-m-d');
    }

    public static function DateToEpoch()
    {

        $date = new DateTime();
        return $date->getTimestamp();
    }

    public static function GetCurrentTime()
    {
        $time = time();
        return $time;
    }
}
