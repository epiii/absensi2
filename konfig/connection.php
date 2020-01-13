<?php

$dbhost = 'localhost'; 
$dbuser = 'root';
$password = '';
$dbname = 'db_uid';

$dbconnect = new mysqli($dbhost, $dbuser, $password, $dbname);
// pr($dbconnect);
// exit();

if ($dbconnect->connect_error) {
    die('Server Error');
}
