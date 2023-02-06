<?php

const MYSQL_HOST = 'localhost';
const MYSQL_PORT = 9999;
const MYSQL_NAME = 'DATA_BASE';
const MYSQL_USER = 'USER';
const MYSQL_PASSWORD = 'Password';

try {
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}
