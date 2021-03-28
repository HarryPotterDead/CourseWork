<?php


class bd_class
{
    public $dbs;

    function __construct($user, $pass, $host, $db)
    {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        try {
            $this->dbs = new PDO ($dsn, $user, $pass, $opt);
        } catch (Exception $e) {
            $GLOBALS ['error'] = "Связь не установлена";
        }
    }
}