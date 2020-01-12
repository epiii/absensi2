<?php
// $dbhost = 'https://srv64.niagahoster.com/'; 
// $dbhost = 'https://srv64.niagahoster.com:2083'; 
// $dbhost = '193.168.194.1'; 
// $dbhost = 'http://elfrilancer.com'; 

// $dbhost = 'srv64.niagahoster.com';
// $dbuser = 'u6726487_db_uid';
// $dbname = 'u6726487_db_uid';
// $password = '9kali9=81db';

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
