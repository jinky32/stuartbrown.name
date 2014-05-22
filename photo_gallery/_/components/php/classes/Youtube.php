<?php

Class Youtube{
	private $_apiArray;
	private $_user;
	private $_db;
	
	public function __construct(User $user, DB $db){
		$this->_user = $user;
		$this->_db = $db;
		//return print_r($user->data()->username);
		}
		
		public function getUser()
			{
			    return $this->_user;
			}
			
			public function testName(){
						//return $this->_user()->_db()->_results()->name;
			//$name= $this->_user->_db()->_results()->name;
			$name= $this->_user->data()->name;
			
			return $this;
			}

	public function getUserName()
		{
		    return $this->_user->data()->username;
		}
	
	public function youtubeApiConnect() {
		
		$html ="";
			//$url='https://gdata.youtube.com/feeds/api/users/'.$this->getUserName().'/playlists';
			//$url="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nf5OYTqGws_vTKCQYwSj6e";
			$url="https://gdata.youtube.com/feeds/api/users/jinky32/playlists";
			$xml=simplexml_load_file($url);
			for ($i=0; $i < sizeof($xml->entry); $i++) { 
				$array[(string)$xml->entry[$i]->title]=(string)$xml->entry[$i]->id;
			}
			$this->_apiArray = $array;
	
		//return $this->_apiArray;
		return $this;
	}
	
	public function getPlaylist(){
		return print_r($this->_apiArray);
	}
	
	
	public function youtubeInsert(){
		foreach($this->_apiArray as $key => $value){
			$this->_db->insert('playlists', array(
												'playlist_title'=>$key,
												'playlist_url'=>$value,
												'user_id'=>28
												//'user_id'=>self::$userid  //NEED TO SORT OUT HOW TO GET USERID INTO THE DB.  THIS LINE IS TAKEN FROM 500PX WHICH HAS  METHOD TO GET THE DATA.  PERHAPS ULTIMATELY THIS METHOD WOULD GO INTO THE ABSTRACT API CLASS SO I CAN ACCESS IT HERE?
												)
											);
			
		}
	}
	
	
	public function youtubeDbVideoSelect(){
		$playlists=$this->_db->get('playlists', array('user_id', '=', 28))->results(); //USERID NEEDS TO BE MADE DYNAMIC. HARDCODED HERE FOR TESTING
		//return print_r($playlists);
					 for ($i=0; $i < sizeof($playlists); $i++) { 
						$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
		      } 
		//return print_r($playlistArray);
		
		return $playlistArray;
		
		}
		
		
		public function youtubeApiDbSync(){
		if(!count($this->youtubeDbVideoSelect())){ // if nothing is returned from the query...
			$this->youtubeInsert(); // ...then go ahead and insert the API data (most likely first load of the page)
		} else {
		 	$difference = array_diff_assoc($this->youtubeDbVideoSelect(),  $this->youtubeApiConnect()); // if there is a result then 				compare the two arrays and store the difference in a variable
 		if($difference){ // if there is a difference ...
print_r($difference);
			foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
  				$delete = $this->_db->delete('playlists', array('playlist_url', '=', $value)); // ...and user that the delete rows from 							the db
			}
				} 
    		$this->youtubeInsert();
  		} 
//	}
//$this->fhpxInsert($feature); // I THINK THIS SHOULD BE WITHIN THE ELSE STATEMENT ABOVE. OTHERWISE IT IS BEING RUN TWICE IF THE ORIGINAL IF STATEMENT IS TRUE
//$fhpxDbNavArray=array();
//	return $fhpxDbFullArray = $this->fhpxDbImageSelect($feature, $userid);	// go back to the database and get the (possibly) updated list of images
//		return $fhpxDbFullArray = $this->fhpxDbImageSelect($feature, $userid);	
		}
		


//NOW I NEED TO KEEP THE API AND DB IN SYNC AS IN 500PX CLASS - BUT THIS NEEDS TO BE DONE LESS FREQUENTLY?  DO I ALSO NEED TO GO BACK ADN GET THE SYNCHRONISD DB ARRAY AND USE THAT RATHER THAN THE VALUES FROM youtubeDbVideoSelect WHICH IS JUST USED FOR SPOTTING THE DIFFERENCE BTW IT AND API ARRAY???

public function youtubeVideoInsert(){ //USER ID NEEDS TO GO INTO THE DB TOO.
$chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mDq0IEd8z1IqfvnKegSeT9";
$specific_playlist=simplexml_load_file($chosen_playlist);
//return $specific_playlist;
//$specific_playlist->title;
//$specific_playlist->link[0]->attributes()->href;
//$test=array();
for ($i=0; $i<sizeof($specific_playlist->entry); $i++) {
	//print $specific_playlist->entry[$i]->title . ' and ' . $specific_playlist->entry[$i]->content . '<br />';
	$videos[(string)$specific_playlist->entry[$i]->title]=str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href);
}
//return $videos;
foreach ($videos as $video_label => $video_url) {
	$this->_db->insert('videos', array(
									'video_label'=>$video_label,
									'video_url'=>$video_url,
									'pid'=>$chosen_playlist,
									'video_embed'=>str_replace("watch?v=", "embed/", $video_url),
									'user_id'=>$this->getUser()->data()->id
									)
								);
}


return $this;
}

public function findImage(){ //USER ID NEEDS TO GO INTO THE DB TOO.
$chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2mDq0IEd8z1IqfvnKegSeT9";
$specific_playlist=simplexml_load_file($chosen_playlist);
//return (string)$specific_playlist->entry[0]->link->attributes()->href;


//$str = "https://www.youtube.com/watch?v=p5hgXck7KP0&feature=youtube_gdata";    
if(preg_match_all('/\=(.*?)\&/',(string)$specific_playlist->entry[0]->link->attributes()->href,$match)) {            
        return $match = "https://i1.ytimg.com/vi/".$match[1][0]."/mqdefault.jpg";
}
//return "https://i1.ytimg.com/vi/".$match."/mqdefault.jpg";
//					$this->_db->update('playlists', (array(
//										'playlist_image' => $match
//										))
//					);
}








}
	

?>