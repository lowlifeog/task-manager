<?php

namespace core;

use PDO;

class DB {

    

    public static function connect(){
        $cs = self::$connect_settings;

        $params = "mysql:host={$cs['host']};dbname={$cs['dbname']};charset=utf8";
        $db = new PDO($params, $cs['user'], $cs['pass']);

        return $db;
    }
}