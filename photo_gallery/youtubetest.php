<?php
require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
$user = new User('jinky32');
$youtube= new Youtube($user, $db);
//print $youtube->getUserName();
//print_r($youtube->getUser()->data()->id);
//var_dump($youtube->youtubeApiConnect());
//$youtube->youtubeApiConnect();
//$youtube->youtubeApiConnect()->getPlaylist();
//$youtube->getPlaylist();
//$youtube->youtubeApiConnect()->youtubeInsert();
$youtube->youtubeApiConnect();
//var_dump($youtube->youtubeDbVideoSelect()) ;
//var_dump($youtube->testName());
//$youtube->youtubeApiDbSync();
//$youtube->youtubeApiConnect()->youtubeApiDbSync();
//var_dump($youtube->youtubeVideoInsert());
//$youtube->youtubeVideoInsert();
//print_r($youtube->getUser()->data()->id);
//var_dump($youtube->findImage());
//$str = "https://www.youtube.com/watch?v=p5hgXck7KP0&feature=youtube_gdata";    
//if(preg_match_all('/\=(.*?)\&/',$str,$match)) {            
//        var_dump($match[1]);            
//}
print $youtube->findImage();
?>
