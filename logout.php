<?php
session_start();

include_once('config/mysql.php');
include_once('config/user.php');
include_once('variables.php');

setcookie(
    'LOGGED_USER',
    "", 
    time() - 3600
);

session_destroy();

header('Location: '.$rootUrl.'index.php');
?>