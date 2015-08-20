<?php
function getDB() {
	$dbhost="localhost";
	$dbuser="slimapiuser";
	$dbpass="slimapi@123";
	$dbname="slimapi";
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>