<?php

namespace ishop;

class Db{

    use TSingletone;

    protected function __construct(){

        require 'rb-mysql.php';
        $db = require_once CONF . '/config_db.php';
        //class_alias('\RedBeanPHP\R', '\R');
        \R::setup($db['dsn'], $db['user'], $db['pass']);
        if (!\R::testConnection()) {
            throw new \Exception("Lipsește legatura cu baza de date", 500);
        }
        \R::freeze(true);
        if(DEBUG){
            \R::debug(true, 1);
        }
    }
}
