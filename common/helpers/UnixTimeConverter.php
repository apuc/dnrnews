<?php

namespace common\helpers;

class UnixTimeConverter
{
    public static function convertUnixToDate($unixDate)
    {
        return gmdate("Y-m-d H:i:s ", $unixDate);
    }
}