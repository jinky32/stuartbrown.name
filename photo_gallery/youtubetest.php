<?php
require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
$user = new User('jinky32');
$youtube= new Youtube($user, $db);
print $youtube->getUserName();
$youtube->youtubeApiConnect()->getPlaylist();
//$youtube->getPlaylist();
//$youtube->youtubeApiConnect()->youtubeInsert();
//$youtube->youtubeApiConnect();
$youtube->youtubeDbVideoSelect();

?>
