<?php
require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
$user= new User;
//$user = new User('jinky32');
$youtube= new Youtube($db, $user);
//$youtube->createUser('User',$user);
//$user_url="https://www.googleapis.com/youtube/v3/channels?part=id,snippet,contentDetails&forUsername=jinky32&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM";
//$youtube->youtubev3UserId($youtube->youtubev3($user_url));
//print $youtube->v3UserId;
//$youtube->youtubev3UserId('jinky32');
//print $youtube->ytUserId;
	//var_dump($youtube->youtubeApiPlaylistSelect());
	//$youtube->youtubeInsert();
	//$selection = array('title'=>'PLEtmlR7ubZ2mWeLTu_7PHvfhB4szenjC9');
//	print_r($youtube->getUser());
//	print $youtube->getUser()->youtube;
//	print_r($youtube->youtubeApiPlaylistSelect());
//print_r($selection);
//print_r($youtube->youtubeAPIVideoSelect($selection));
//print_r($youtube->youtubeAPIVideoSelect($selection));
//$youtube->youtubeVideoInsert($selection);
//var_dump($youtube->getYoutubeApiPlaylist());
//$playlists_url="https://www.googleapis.com/youtube/v3/playlists?part=id,snippet&fields=items(id,snippet(channelId,title,thumbnails))&channelId=".$youtube->v3UserId."&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM&maxResults=50";
//UCDxk6qQqTkFW0SK_rPXopkQ
//print $playlists_url;
//print_r($youtube->youtubev3ApiPlaylistSelect($playlists_url));
//print_r($youtube->youtubev3($playlists_url));
//print $youtube->youtubev3($url)->youtubev3UserId();
//print $youtube->youtubev3($url)->kind;
//print $youtube->getUserName();
//print_r($youtube->testName());
//$youtube->testName()->fivehundredpx;
//print $youtube->getUser()->joined;
//print_r($youtube->getUser()->data()->id);
//var_dump($youtube->youtubeApiConnect());
//var_dump($youtube->youtubeApiConnect());
//print_r($youtube->youtubeApiConnect());
//print_r($youtube->youtubeApiConnect()->getPlaylist());
//var_dump($youtube->getPlaylist());
		//$youtube->youtubeApiConnect()->youtubeInsert();
//$youtube->youtubeApiConnect();
print_r($youtube->youtubeDbPlaylistSelect()) ;
//var_dump($youtube->testName());
//$youtube->testName();
//print_r($youtube->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist());
//print_r($youtube->getYoutubeDbPlaylist());
//$youtube->youtubeApiDbSync();
//$youtube->youtubeApiConnect()->youtubeApiDbSync();
//var_dump($youtube->youtubeVideoInsert());
//$youtube->youtubeVideoInsert();
//print_r($youtube->youtubeDbPlaylistSelect());
			//print_r($youtube->youtubeVideoInsert());
			//$youtube->youtubeInsert();
			//print_r($youtube->youtubeApiConnect()->getYoutubeApiPlaylist());
			//print_r($youtube->youtubeDbPlaylistImageSelect());
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
//$youtube->youtubeDbVideoSelect(fQDOCBD6y8dLDNtd);
//$var = fQDOCBD6y8dLDNtd;
//print $youtube->addQuotes($var);
//$youtube->videoDiff('https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nvUC9qz_xMnzw6Qv-_Duzt');
//print_r($youtube->youtubeApiConnect()->getYoutubeApiPlaylist());
//print_r($youtube->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist());
//$youtube->youtubePlaylistCompare();
//$var = Array ( ['https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mKz0KrAzV836KOcS6I5zfx'] => 'https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mKz0KrAzV836KOcS6I5zfx' ) ;
//$youtube->youtubeDbVideoSelect($var);
?>


