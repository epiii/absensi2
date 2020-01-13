<?php
$dbhost = 'localhost';
$dbuser = 'root';
$password = '';
$dbname = 'db_uid';

$dbconnect = new mysqli($dbhost, $dbuser, $password, $dbname);

if ($dbconnect->connect_error) {
    die('Server Error');
}
