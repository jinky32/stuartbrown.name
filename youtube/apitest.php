<?php
$html ="";
$url="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mDq0IEd8z1IqfvnKegSeT9";
$xml=simplexml_load_file($url);
// print_r($xml);

for($i=0; $i<10; $i++) {

	$author=$xml->entry[$i]->author->name;
	$id=$xml->entry[$i]->id;
	$title=$xml->entry[$i]->title;
	$content=$xml->entry[$i]->content;

	$html .= "<div><h3>$title</h3>$content<br />$author - $id</div><hr />";
}

echo $html;

?>