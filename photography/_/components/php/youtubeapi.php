<?php namespace Photo\DB;

// require "_/components/php/functions.php";
// $conn = connect($config);
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
$playlist_combined2=array_combine($playlist_id, $playlist_title); 

foreach($playlist_combined2 as $key => $value){
//print "this is key $key and this is value $value <br />";
	if ( $conn ) { //break the array apart and pass value for insert to the query() function in functions.php
      $youtube_playlist_insert=query("INSERT INTO playlists(playlist_url, playlist_title) 
        VALUES (:playlist_url, :playlist_title)
        ON DUPLICATE KEY UPDATE playlist_url = VALUES(playlist_url)",
      array('playlist_url'=>$key, 'playlist_title'=>$value), //bind the values
      $conn);
    } 
    else {
      print "could not connect to the database";
    }


}



   

?>