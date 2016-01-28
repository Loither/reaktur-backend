<?php
require_once("functions/functions.php");

if(isset($_POST['url']) && isset($_POST['message'])){
	echo saveImage($_POST['url'], $_POST['message']);
}
?>



