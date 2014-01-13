<?php
// I need something else in here that will pull all of my playlists from https://gdata.youtube.com/feeds/api/users/jinky32/playlists
// in feed/entry/<yt:playlistId>.  URL var below can then use that value
$html ="";
$url="https://gdata.youtube.com/feeds/api/users/jinky32/playlists";
//$url="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nf5OYTqGws_vTKCQYwSj6e";
$xml=simplexml_load_file($url);

$playlist_title=array();
$playlist_id=array();
foreach ($xml->entry as $playlists) {
	$playlist_title[]=$playlists->title;
    $playlist_id[]=$playlists->id;
}


// print_r($xml);
// $playlist=$xml->title;

// for($i=0; $i<10; $i++) {

// 	$author=$xml->entry[$i]->author->name;
// 	$id=$xml->entry[$i]->id;
// 	$title=$xml->entry[$i]->title;
// 	$content=$xml->entry[$i]->content;

// 	$html .= "<div><h3>$title</h3>$content<br />$author - $id</div><hr />";
//}
// echo "<h1>$playlist</h1>";
// echo $html;

// write a function here that will take $playlist_id (e.g. http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2m6J32yq3W2wDb4kxXw40gU)
// and will return the videos in that playlist and the url of the playlist for embedding.

// function YouTubePlaylist ($url){
// 	$specific_playlist=simplexml_load_file($url);
// 	return $specific_playlist;
// }

?>