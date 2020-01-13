<?php
$dbhost = 'localhost';
$dbuser = 'root';
$password = '';
$dbname = 'db_uid';

// $dbhost = 'srv64.niagahoster.com';
// $dbuser = 'u6726487_db_uid';
// $dbname = 'u6726487_db_uid';
// $password = '9kali9=81db';

$dbconnect = new mysqli($dbhost, $dbuser, $password, $dbname);
if ($dbconnect->connect_error) {
    die('Server Error');
}
