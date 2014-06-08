<?php 
// Affiche chaque erreur du tableau
if (isset($error) && !empty($error)) {
	foreach($error as $msg) {
		echo $msg;
	}
}
echo '<br>';
?>