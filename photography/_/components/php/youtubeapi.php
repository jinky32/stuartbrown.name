<?php namespace Photo\DB;

// require "_/components/php/functions.php";
// $conn = connect($config);
// I need something else in here that will pull all of my playlists from https://gdata.youtube.com/feeds/api/users/jinky32/playlists
// in feed/entry/<yt:playlistId>.  URL var below can then use that value
$html ="";
$url="https://gdata.youtube.com/feeds/api/users/jinky32/playlists";
//$url="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nf5OYTqGws_vTKCQYwSj6e";
$xml=simplexml_load_file($url);

/*
$playlist_title=array();
  $playlist_id=array();
  for ($i=0; $i < sizeof($xml->entry); $i++) { 
  $array[(string)$xml->entry[$i]->title]=(string)$xml->entry[$i]->id;
  }
  print_r($array
 */

$playlist_title=array();
$playlist_id=array();
foreach ($xml->entry as $playlists) {
	$playlist_title[]=$playlists->title;
    $playlist_id[]=$playlists->id;
}
$playlist_combined=array_combine($playlist_id, $playlist_title); 

foreach($playlist_combined as $key => $value){
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

if ( $conn ) {
      $playlists_database=query2("SELECT playlist_title, playlist_url FROM playlists", 
      $conn);
  
      } else {
      print "could not connect to the database";
}
$playlists_database_title=array();
$playlists_database_url=array();
 for ($i=0; $i < sizeof($playlists_database); $i++) { //loop through the array  and fill $photoarray_database with the cat_id
    $playlists_database_title[]=$playlists_database[$i]['playlist_title'];
    $playlists_database_url[]=$playlists_database[$i]['playlist_url'];
    
  }

  $playlists_database_combined=array_combine($playlists_database_url, $playlists_database_title)
  // print "playlists_database".sizeof($playlists_database);
  // print_r($playlists_database);
  // print "playlists_database_title";
  // print_r($playlists_database_title);
  // print "playlists_database_url)";
  // print_r($playlists_database_url);

   

?>

 