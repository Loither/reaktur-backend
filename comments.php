<?php
require_once("functions/functions.php");
//print_r(getComments('761ebc82'));
if(isset($_POST['hash'])){
	if(isset($_POST['message'])){
		//print_r($_POST);
		saveComment($_POST['hash'], $_POST['message']);
	}
	$comments = getComments($_POST['hash']);
	//print_r($comments);
	echo '<h2>Comments</h2>';
	foreach ($comments as $comment) {	
		echo '<p class="com"><span class="small">'.$comment->date.' &nbsp;</span>'.$comment->text.'</p>';
	}
}
?>



