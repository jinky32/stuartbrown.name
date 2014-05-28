<?php

Class Youtube{
	private $_apiArray;
	private $_user;
	private $_db;
	
	public function __construct(DB $db){
		//$this->_user = $user;
		$this->_db = $db;
		//return print_r($user->data()->username);
		}
		
		public function create($var, $name){
					if($var=='User'){
						$this->_user = new User($name); 
					} else {
						print 'no';
					}
					return $this;
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
				$url="https://gdata.youtube.com/feeds/api/users/".$this->_user->data()->username."/playlists";
				$xml=simplexml_load_file($url);
				//print_r($xml);
				for ($i=0; $i < sizeof($xml->entry); $i++) { 
					 $array[(string)$xml->entry[$i]->title]=(string)$xml->entry[$i]->id;
				}
				$this->_apiArray = $array;
				//print_r($array);
				//return $array;
			//print_r($this->_apiArray);
			//return $this->_apiArray;
			return $this;
		}
	
	
	public function getPlaylist(){
			return $this->_apiArray;
		}


	public function youtubeInsert(){  
		foreach($this->youtubeApiConnect()->getPlaylist() as $key => $value){
//			print 'this is ' .$key . ' and this is value ' .$value. \n;
			$this->_db->insert('playlists', array(
												'playlist_title'=>$key,
												//'playlist_url'=>str_replace("users/jinky32/", "", $value),
												'playlist_url'=>preg_replace("/^http:/i", "https:", str_replace("users/".$this->_user->data()
												->username."/", "", $value)),
												'user_id'=>$this->_user->data()->id
												)
											);	
		}
	}
	
	
	public function youtubeDbPlaylistSelect(){ //I THINK I SHOULD NOT RETURN THE ARRAY COS IT MAKES IT HARDER TO GET OTHER THINGS FORM DB WITHOUT
	//WRITING A NEW METHOD
	
		if(!count($this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results()))
			{
			$this->youtubeInsert();

			} 
			
			$playlists=$this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results(); 					 
			for ($i=0; $i < sizeof($playlists); $i++) { 
						$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
		 
		}

		return $playlistArray;
		
		}
		
	public function youtubeDbPlaylistImageSelect(){ 
			$playlists=$this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results(); 					 
			for ($i=0; $i < sizeof($playlists); $i++) { 
							$playlistImageArray[$i]=$playlists[$i]->playlist_image;
			      } 	
			return $playlistImageArray;
			
			}

	public function youtubeGetUserSelectedPlaylist($selection){ // THIS METHOD SHOULD ONLY BE USED TO SELECT WHICH LISTS THE VIDEOS UNDERTHE IMAGES ARE TAKEN FROM
		foreach ($selection as $key => $value) {
			$pieces[] = explode(" - ", $key);	
			// $pieces = explode(" - ", $key);		
			}
			return $pieces;

		//      1) split assoc array key from form into key value. 2) get everything from playlists table in db and put into a array that matches 1
		//      3) use array_intersect_assoc() to find the user's selctions that match the db array
		//      4) the checkbox value array needs to be changed in youtube.php so that it contains [playlist]$title .'-'.$url.  Then need to split the bit after [playlist]
	}


//IN THE BELOW 2 methods I AM TRYING TO TAKE THE VALUE OF THE URI OF SELECTED PLAYLIST ON THE FORM AND USE THEM TO QUERY THE API AND DB
// I WANT TO DO THIS TO TRY AND KEEP THE TWO IN SYNC
// i have the problem on line 127 that the db-> method wont wrap strings in '' so the query only works if i hardcode it.

//THE BELOW TWO METHODS NEED A NEW ONE THAT DOES A DIFF ON THE ARRAYS OF EACH.  THEY ALSO CURRENTLY ONLY WORK FOR SINGLE ITEMS AND
//NEED TO BE EXTENDED TO WORK WITH AN ARRAY
//
		public function videoDiff($selection){
			//print_r($this->youtubePlaylistSync($selection));
			//$test = $this->youtubePlaylistSync($selection);
			print_r($this->youtubePlaylistSync($selection)) ;
    print '<br /> here <br />';
			print_r($this->youtubeDbVideoSelect($selection));
			$difference = array_diff($this->youtubeDbVideoSelect($selection), $this->youtubePlaylistSync($selection));
			print_r($difference);
		}

		public function youtubeDbVideoSelect($selection){  
			foreach ($selection as $key => $value) {
			$pieces[] = explode(" - ", $key);		
			}
			for ($i=0; $i < sizeof($pieces); $i++) { 
				$url = $pieces[$i][1];
			}
		$dbVideoArray=$this->_db->get('videos', array('pid', '=', $url))->results();
		for ($i=0; $i < sizeof($dbVideoArray); $i++) { 
						$dbVideos[]=$dbVideoArray[$i]->video_label;		 
		}
		return $dbVideos;

		}
		

		public function youtubePlaylistSync($selection){ //this is receiving an array
			foreach ($selection as $key => $value) {
			$pieces[] = explode(" - ", $key);		
			}
			for ($i=0; $i < sizeof($pieces); $i++) { 
				//$this->youtubeDbVideoSelect($pieces[$i][1]);
				//print $pieces[$i][1];
				$playlist=simplexml_load_file($pieces[$i][1]); //an uri such as https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nMk96rueTBP4np_EhzxD7c
				for ($i=0; $i < sizeof($playlist->entry); $i++) { 
					$video[] = (string)$playlist->entry[$i]->title;
				}

				//$difference = array_diff_assoc($this->youtubeDbPlaylistSelect(),  $this->youtubeApiConnect());
				// $this->youtubeDbVideoSelect($selection);
				// $this->youtubeDbVideoSelect($selection);
			}
			return $video;
		
		}



		public function youtubeApiDbSync(){
		if(!count($this->youtubeDbPlaylistSelect())){ // if nothing is returned from the query...
			$this->youtubeInsert(); // ...then go ahead and insert the API data (most likely first load of the page)
		} else {
		 	$difference = array_diff_assoc($this->youtubeDbPlaylistSelect(),  $this->youtubeApiConnect()); // if there is a result then 				compare the two arrays and store the difference in a variable
 		if($difference){ // if there is a difference ...
print_r($difference);
			foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
  				$delete = $this->_db->delete('playlists', array('playlist_url', '=', $value)); // ...and user that the delete rows from 							the db
			}
				} 
    		$this->youtubeInsert();
  		} 
	
		}
		
//NOW I NEED TO KEEP THE API AND DB IN SYNC AS IN 500PX CLASS - BUT THIS NEEDS TO BE DONE LESS FREQUENTLY?  DO I ALSO NEED TO GO BACK ADN GET THE SYNCHRONISD DB ARRAY AND USE THAT RATHER THAN THE VALUES FROM youtubeDbPlaylistSelect WHICH IS JUST USED FOR SPOTTING THE DIFFERENCE BTW IT AND API ARRAY???

public function youtubeVideoInsert(){ 
	$playlists=$this->youtubeDbPlaylistSelect();
	//$playlists=$this->youtubeGetUserSelectedPlaylist($selection);
	foreach ($playlists as $title => $url) {
		$urls[]=$url;
		//print $title .' ! ';
		
		//$chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2kwggwNSmTfcAHx-0BRKNOw";
		//$specific_playlist=simplexml_load_file($chosen_playlist);
		$specific_playlist=simplexml_load_file($url);
		
		 if(preg_match_all('/\=(.*?)\&/',(string)$specific_playlist->entry[0]->link->attributes()->href,$match)) {            
		         $match = "https://i1.ytimg.com/vi/".$match[1][0]."/mqdefault.jpg";
				
		 		$this->_db->update('playlists','playlist_url',$url, (array(
		 							//'playlist_image' => $match
	 								'playlist_image'=>$match
		 							//'playlist_url' => $chosen_playlist
		 							))
		 		);
		 }


		for ($i=0; $i<sizeof($specific_playlist->entry); $i++) {
	print (string)$specific_playlist->entry[$i]->title.'<br />';
			// $videos[(string)$specific_playlist->entry[$i]->title]=str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href);
		$videos[(string)$specific_playlist->entry[$i]->title]=array('rewritten-url'=>str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href),
																	'url'=>$url	);
		//print $videos[(string)$specific_playlist->entry[$i]->title]["rewritten-url"];
		}
//print_r($videos);

		}
		
		foreach ($videos as $video_label => $video_urls) {
			// print $urls[$i];
				$this->_db->insert('videos', array(
												'video_label'=>$video_label,
												// 'video_url'=>$video_url,
												'video_url'=>$video_urls["rewritten-url"],
												'pid'=>$video_urls["url"],
												'video_embed'=>str_replace("watch?v=", "embed/", $video_urls["rewritten-url"]),
												'user_id'=>$this->getUser()->data()->id
												)
											);
			}
			



return $this;
}

//public function findImage(){ //USER ID NEEDS TO GO INTO THE DB TOO.
//$chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nMk96rueTBP4np_EhzxD7c";
//$specific_playlist=simplexml_load_file($chosen_playlist);
////return (string)$specific_playlist->entry[0]->link->attributes()->href;
//
//
////$str = "https://www.youtube.com/watch?v=p5hgXck7KP0&feature=youtube_gdata";    
//if(preg_match_all('/\=(.*?)\&/',(string)$specific_playlist->entry[0]->link->attributes()->href,$match)) {            
//        $match = "https://i1.ytimg.com/vi/".$match[1][0]."/mqdefault.jpg";
//		$var = 'http://www.open.ac.uk';
//		$id='To watch - Web';
//}
////print $match;
////return "https://i1.ytimg.com/vi/".$match."/mqdefault.jpg";
//					$this->_db->update('playlists','playlist_url',$chosen_playlist, (array(
//										//'playlist_image' => $match
//										'playlist_image'=>$match
//										//'playlist_url' => $chosen_playlist
//										))
//					);
//}



}
	

?>