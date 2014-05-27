<?php
require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
//$user = new User('jinky32');
$youtube= new Youtube($db);
$youtube->create('User','jinky32');
//print $youtube->getUserName();
//print_r($youtube->getUser()->data()->id);
//var_dump($youtube->youtubeApiConnect());
//var_dump($youtube->youtubeApiConnect());
//print_r($youtube->youtubeApiConnect());
//print_r($youtube->youtubeApiConnect()->getPlaylist());
//var_dump($youtube->getPlaylist());
		//$youtube->youtubeApiConnect()->youtubeInsert();
//$youtube->youtubeApiConnect();
//print_r($youtube->youtubeDbPlaylistSelect()) ;
//var_dump($youtube->testName());
//$youtube->testName();
//print_r($youtube->youtubeApiConnect());
//$youtube->youtubeApiDbSync();
//$youtube->youtubeApiConnect()->youtubeApiDbSync();
//var_dump($youtube->youtubeVideoInsert());
//$youtube->youtubeVideoInsert();
//print_r($youtube->youtubeDbPlaylistSelect());
			print_r($youtube->youtubeVideoInsert());
//print_r($youtube->getUser()->data()->id);
//var_dump($youtube->findImage());
//$str = "https://www.youtube.com/watch?v=p5hgXck7KP0&feature=youtube_gdata";    
//if(preg_match_all('/\=(.*?)\&/',$str,$match)) {            
//        var_dump($match[1]);            
//}
//$youtube->findImage();
//http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2mDq0IEd8z1IqfvnKegSeT9
//https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mDq0IEd8z1IqfvnKegSeT9
//print_r($youtube->youtubeDbPlaylistImageSelect());
?>


