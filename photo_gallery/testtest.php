<?php
require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
//$user = new User('jinky32');
//$youtube= new Youtube($user, $db);
$youtube= new Test($db);
//print_r($youtube->getUser());
//var_dump($youtube->getUserName());
//var_dump($youtube->youtubeDbVideoSelect());
//var_dump($youtube->getData());
//$youtube->getData();
//var_dump($youtube->youtubeApiConnect());
//print_r($youtube->getUser()->data()->id);
//$youtube->youtubeApiConnect()->getPlaylist();
//$youtube->getPlaylist();
//$youtube->youtubeApiConnect()->youtubeInsert();
//$youtube->youtubeApiConnect();
//var_dump($youtube->youtubeDbVideoSelect());
//$this->user()->_db()->_results()->name;
//var_dump($youtube->testName());
//$youtube->testName();
$youtube->create('User','jinky32');
//var_dump($youtube->create('User'));
//var_dump($youtube->getData()->name);
print $youtube->user->data()->joined;

?>
