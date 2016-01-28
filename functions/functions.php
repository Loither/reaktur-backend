<?php

$siteRoot = 'http://localhost/reaktor-backend/uploads/';

function listNew(){
	require_once("config/config.php");
	$stmt = $db->prepare("SELECT * FROM imgs ORDER BY id DESC LIMIT 6");
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
	
  	return $result;
}
function getSingleImage($hash){
	require_once("config/config.php");
	$stmt = $db->prepare("SELECT * FROM imgs WHERE hash=:hash");
	$stmt->bindParam(':hash', $hash);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_OBJ);
	
	return $result;
}
function getSingleImageHash($db, $url){
	$stmt = $db->prepare("SELECT * FROM imgs WHERE url=:url");
	$stmt->bindParam(':url', $url);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_OBJ);
	
	return $result->hash;
}
function createHash($db, $string){
	// Creates sha1 hash from given string that is then cut to length
	$hash = sha1($string);
	while(existsInDB($db, $hash)){
		$string .= 'reaktor';
		$hash = sha1($string);
	}
	return substr($hash, 0, 8);
}
function existsInDB($db, $hash){
	$stmt = $db->prepare("SELECT * FROM imgs WHERE hash=:hash");
	$stmt->bindParam(':hash', $hash);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_OBJ);
	
	if(is_object($result)){
		return true;
	} else {
		return false;
	}
}
function saveImage($url, $text){
	require_once("config/config.php");
	// Inserting data into database
	$stmt = $db->prepare("INSERT INTO imgs VALUES (?, ?, ?, ?)");
	$data = array(null, $url, $text, createHash($db, $url));
	$stmt->execute($data);
	
	$hash = getSingleImageHash($db, $url);
	
	return $hash;
}
function getComments($hash){
	require("config/config.php");
	$id = getIDwithHash($db, $hash);
	
	$stmt = $db->prepare("SELECT * FROM comments WHERE id=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
	
  	return $result;
}
function saveComment($hash, $text){
	require_once("config/config.php");
	date_default_timezone_set('Europe/Helsinki');
	$date = date("d.m.y H:i");
	$id = getIDwithHash($db, $hash);

	$stmt = $db->prepare("INSERT INTO comments VALUES (?, ?, ?)");
	$data = array($id, $text, $date);
	
	$stmt->execute($data);
}
function getIDwithHash($db, $hash){
	$stmt = $db->prepare("SELECT * FROM imgs WHERE hash=:hash");
	$stmt->bindParam(':hash', $hash);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_OBJ);
	
	if (is_object($result)) {
		return $result->id;
	} else {
	
	}
}
?>