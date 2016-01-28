<?php
require_once("functions/functions.php");
$imgs = listNew();
foreach ($imgs as $img) {	
	echo '<div class="col-xs-4 col-md-4">';
    echo '<a href="single.html?'.$img->hash.'" class="thumbnail" style="background:url('.$siteRoot.$img->url.');background-size:cover;height:150px;"></a>';
    echo '<a href="single.html?'.$img->hash.'"><p class="desc">'.$img->text.'</p></a></div>';
}
?>



