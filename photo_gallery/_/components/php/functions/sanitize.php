<?php
//this escape() function sanitizes data on the way into the db and escpare chars on the way out
//this file is included in init.php
function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

?>