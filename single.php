<?php
require_once("functions/functions.php");

if(isset($_POST['hash'])){
	$img = getSingleImage($_POST['hash']);
	if (is_object($img)) {
        echo '<div class="col-xs-12 col-md-12">';
		echo '<h1>'.$img->text.'</h1>';
		echo '<img src="'.$siteRoot.$img->url.'" class="img-responsive" alt="'.$img->text.'">';
		echo '</div>';
    } else {
		echo '<div class="col-xs-12 col-md-12">';
		echo '<h1>No results, but enjoy this one</h1>';
		echo '<img src="'.$siteRoot.'howtogreatcode.png" class="img-responsive" alt="How to write great code">';
		echo '</div>';
	}
	
}
?>



