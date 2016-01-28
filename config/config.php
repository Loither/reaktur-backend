<?php
//define('SITE_ROOT', 'http://www.');
ini_set('display_errors', 'On');
error_reporting(E_ALL);

try {
	// DB from PDO object, using SQLite file from folder
	$db = new PDO('sqlite:db/db.sqlite');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo("<h1>Database connection failed</h1>");
	file_put_contents('log/DBErrors.txt', "DB connection error: " . $e->getMessage() . "\n", FILE_APPEND);
}


?>