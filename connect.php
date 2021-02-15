<?php

session_start();
header('Content-type: text/html; charset=utf-8');
$ini_fields = parse_ini_file('config.ini', true);
define("DB_HOST",$ini_fields['database']['db_host'], true);
define("DB_NAME",$ini_fields['database']['db_name'], true);
define("DB_USER",$ini_fields['database']['db_user'], true);
define("DB_PASW",$ini_fields['database']['db_password'], true);
require_once "Classes/bd_class.php";
$db = new bd_class(DB_USER, DB_PASW, DB_HOST, DB_NAME);