<?php

namespace core;

use PDO;

class DB {

    public static function connect(){
        $cs = self::$connect_settings;

        $dsn = "mysql:host={$cs['host']};dbname={$cs['dbname']};charset=utf8";
        $db = new PDO($dsn, $cs['user'], $cs['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        return $db;
    }
}