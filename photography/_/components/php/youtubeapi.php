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

?>