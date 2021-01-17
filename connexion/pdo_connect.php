<?php


$host = 'localhost';
$dbname = 'cinema';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname";


$conn = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
