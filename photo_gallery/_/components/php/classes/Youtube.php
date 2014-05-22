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
		foreach($this->_apiArray as $key => $value){
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
		$playlists=$this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results(); 					 for ($i=0; $i < sizeof($playlists); $i++) { 
						$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
		      } 	
		return $playlistArray;
		
		}
		
	public function youtubeDbPlaylistImageSelect(){ 
			$playlists=$this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results(); 					 for ($i=0; $i < sizeof($playlists); $i++) { 
							$playlistImageArray[$i]=$playlists[$i]->playlist_image;
			      } 	
			return $playlistImageArray;
			
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
	foreach ($playlists as $title => $url) {
		print $title .' ! ';
		
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
			$videos[(string)$specific_playlist->entry[$i]->title]=str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href);
		
		}
		}
		foreach ($videos as $video_label => $video_url) {
				$this->_db->insert('videos', array(
												'video_label'=>$video_label,
												'video_url'=>$video_url,
												'pid'=>$url,
												'video_embed'=>str_replace("watch?v=", "embed/", $video_url),
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