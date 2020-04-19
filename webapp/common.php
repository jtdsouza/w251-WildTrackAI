<?php

$ips = array('XXX','XXX');

if(!in_array($_SERVER['REMOTE_ADDR'], $ips))
{
	// echo 'You can\'t access this page';
	// exit();
}

if (!isset($_SESSION))
	session_start();

ini_set('display_errors',1);
// error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "XXX", "XXX", "XXX");
if ($conn->connect_error)
	die("Database connection error: " . $conn->connect_error);

function dump($data){echo '<pre>';var_dump($data);echo '</pre>';}