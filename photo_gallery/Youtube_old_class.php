<?php

Class Youtube{
	private $_youtubeApiArray;
	private $_youtubeDbArray;
	private $_user;
	private $_db;
	
	/**
	 * Construct takes a database connection (typehinted to DB class)
	 * @param DB $db [description] This is a database connection.  Better than doing DB::getInstance
	 * inside the constructor so it is more obvious what is going on (dependancy injection).
	 */
	public function __construct(DB $db){
		//$this->_user = $user;
		$this->_db = $db;
		//return print_r($user->data()->username);
		}
		
	/**
	 * [createUser description] Creates an instance of User class.  Again makes it more obvious that doing User::create
	 * inside the constructor
	 * @param  User class $class  [description] the type of class to be created
	 * @param  string $name [description] the name of the User that you want to instantiate. or the values for which user you want the 
	 * User class to return
	 * @return [object] this (Youtube object.)       [description]
	 */
		public function createUser($class, $name){
					if($class=='User'){
						$this->_user = new User($name); 
					} else {
						print 'no';
					}
					return $this;
				}
	/**
	 * [getUser description]Provides a way to get to a users data as provided by the User class
	 * @return array [description] An array of the users data from the database
	 */
		public function getUser()
			{
			    return $this->_user->data();
			}		

	/**
	 * [youtubeApiConnect description] Builds the YouTube API URI for the signed in user and gets the title and 
	 * URI of all the playlists created by that user - these are saved to the $_youtubeApiArray private class variable.  
	 * THe URI has to be modified (below) before inserted into database and used in subsequent API calls.
	 * @return YouTube object [description] Returns the whole object so more specific helper methods
	 * can be chained on.
	 */
	public function youtubeApiConnect() {
				$url="https://gdata.youtube.com/feeds/api/users/".$this->getUser()->username."/playlists";
				$xml=simplexml_load_file($url);
				//print_r($xml);
				for ($i=0; $i < sizeof($xml->entry); $i++) { 
					 $array[(string)$xml->entry[$i]->title]=(string)$xml->entry[$i]->id;
				}
				$this->_youtubeApiArray = $array;
			return $this;
		}
	
	/**
	 * [getYoutubeApiPlaylist description] Provides access to the $_youtubeApiArray private class variable
	 * @return array [description] An array of all of the users YouTube playlists
	 */
	public function getYoutubeApiPlaylist(){
			return $this->_youtubeApiArray;
		}

	/**
	 * [youtubeInsert description] Takes the array from youtubeApiConnect method and inserts each one into the playlists table of the database.
	 * It manipulates the URI to make them usable in other API keys. Also adds in the playlist title and the user ID
	 */
	public function youtubeInsert(){  
		foreach($this->youtubeApiConnect()->getYoutubeApiPlaylist() as $key => $value){
			$this->_db->insert('playlists', array(
							'playlist_title'=>$key,
							//'playlist_url'=>str_replace("users/jinky32/", "", $value),
							'playlist_url'=>preg_replace("/^http:/i", "https:", str_replace("users/".$this->getUser()
							->username."/", "", $value)),
							'user_id'=>$this->getUser()->id
							)
						);	
		}
	}

	
	/**
	 * [youtubeDbPlaylistSelect description] Selects the playlists associated with a user from the database.  Used with youtubeApiConnect() and
	 * getYoutubeApiPlaylist() to enable me to keep the DB record in sync with what the API returns.
	 * This method first checks if there is anything in the playlists table, if not it uses the youtubeInsert() method (above) to insert the value.
	 * It then queries the playlists table and creates an array title=>url (url can be used in subsequent API calls cos youtubeInsert sorts this)
	 * which is then assigned to the private class variable $_youtubeDbArray (seemed like a good idea at the time, not sure now!) 
	 * @return [Youtube object] [description] The whole object so that the helper method getYoutubeDbPlaylist() can be used to get the values.
	 */
		public function youtubeDbPlaylistSelect(){ 
			if(!count($this->_db->get('playlists', array('user_id', '=', $this->getUser()->id))->results())){
				$this->youtubeInsert();
				} 
				$playlists=$this->_db->get('playlists', array('user_id', '=', $this->getUser()->id))->results(); 					 
				for ($i=0; $i < sizeof($playlists); $i++) { 
					$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
				}
			$this->_youtubeDbArray=$playlistArray;
			return $this;	
		}

	/**
	 * [getYoutubeDbPlaylist description] Returns the $_youtubeDbArray private class method.
	 * @return array [description] an array of all the users playlists in the database as title=>url
	 */
		public function getYoutubeDbPlaylist(){
			return $this->_youtubeDbArray;
		}

	/**
	 * [youtubeDbPlaylistImageSelect description] Gets the images associated with playlists
	 * @return array [description] an array of the images.
	 */
	public function youtubeDbPlaylistImageSelect(){ 
			$playlists=$this->_db->get('playlists', array('user_id', '=', $this->getUser()->id))->results(); 					 
			for ($i=0; $i < sizeof($playlists); $i++) { 
							$playlistImageArray[$i]=$playlists[$i]->playlist_image;
			      } 	
			return $playlistImageArray;
			}

	// public function youtubeGetUserSelectedPlaylist($selection){ // THIS METHOD SHOULD ONLY BE USED TO SELECT WHICH LISTS THE VIDEOS UNDERTHE IMAGES ARE TAKEN FROM
	// 	foreach ($selection as $key => $value) {
	// 		$pieces[] = explode(" - ", $key);	
	// 		// $pieces = explode(" - ", $key);		
	// 		}
	// 		return $pieces;
	// }
// $this->_db->delete('user', array(array('username', 'name'),array('=','='),array('alex','james')));
// 	$where=                array(array('username',  'pid'),array('=','='),array('alex','james'));


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE START OF A SERIES OF METHODS THAT INTERACT WITH A USERS CHOSEN YOUTUBE PLAYLISTS ON youtube.php////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function videoDiff($selection){
		print_r($this->youtubePlaylistSync($selection)) ;
		print '<br /> here <br />';
		print_r($this->youtubeDbVideoSelect($selection));
		$difference = array_diff($this->youtubeDbVideoSelect($selection), $this->youtubePlaylistSync($selection));
		if($difference){
			print_r($difference);
			$this->deleteFromPlaylist($selection, $difference);
		}
		$this->updatePlaylist($selection);
	}

	/**
	 * [youtubePlaylistSync description] Takes an URI from the selected playlist (at the moment it can't handle an array of these) and gets a list of 
	 * videos in that playlist from the API
	 * @param  string URI $selection [description] THe URI associated with the playlist chosen by the user on yutube.php
	 * @return array            [description] An indexed array of the videos fro nteh API in a youtube playlist.
	 */
	public function youtubePlaylistSync($selection){ //this is receiving an array
	foreach ($selection as $key => $value) {
		$url = $value;
	}
		$playlist=simplexml_load_file($url); //an uri such as https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nMk96rueTBP4np_EhzxD7c
		for ($i=0; $i < sizeof($playlist->entry); $i++) { 
			$video[] = (string)$playlist->entry[$i]->title;
	}
	return $video;

}
	/**
	 * [youtubeDbVideoSelect description] Takes an URI from the selected playlist and queries the videos table for videos associated with that 
	 * playlist URI.
	 * @param  string URI $selection [description] an indexed array of videos from the database in a youtube playlist 
	 * @return [type]            [description]
	 */
	public function youtubeDbVideoSelect($selection){  
		foreach ($selection as $key => $value) {
			$url = $value;
		}
		$dbVideoArray=$this->_db->get('videos', array('pid', '=', $url))->results();
		for ($i=0; $i < sizeof($dbVideoArray); $i++) { 
						$dbVideos[]=$dbVideoArray[$i]->video_label;		 
		}
		return $dbVideos;
	}
	/**
	 * [deleteFromPlaylist description] Called from the videoDiff method above this method deletes videos that are no longer in the API for a playlist 
	 * but are in the database
	 * @param  string URI $selection  [description] The value passed (via videoDiff) from the users selection on youtube.php
	 * @param  [array] $difference [description] an array of the difference between whats in the database and whats in the api for a praticular playlist
	 */
	public function deleteFromPlaylist($selection, $difference){ 
		foreach ($selection as $key => $value) {
			$url = $value;
		}
		foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
				$title=$value;
			}
		$delete = $this->_db->delete('videos', array(array('video_label','pid'), array('=','='), array($value, $url))); // ...and user that the delete rows from the db
	}

	/**
	 * [updatePlaylist description] Called from videoDiff() method it takes an URI from a playlist a user has selected on youtube.php.  
	 * From this it constructs a multidimensional array called videos.  The values in this are then inserted into the videos table.
	 * @param  [string URI] $selection [description] the URi of the video selected by the use on youtube.php
	 */
	public function updatePlaylist($selection){
		foreach ($selection as $key => $value) {
			$url = $value;
		}
		$specific_playlist=simplexml_load_file($url);
		for ($i=0; $i<sizeof($specific_playlist->entry); $i++) {
			$videos[(string)$specific_playlist->entry[$i]->title]=array(
																'rewritten-url'=>str_replace("&feature=youtube_gdata", "", 
																(string)$specific_playlist->entry[$i]->link->attributes()->href),
																'url'=>$url	
																);
	}
		foreach ($videos as $video_label => $video_urls) {
			$this->_db->insert('videos', array(
								'video_label'=>$video_label,
								// 'video_url'=>$video_url,
								'video_url'=>$video_urls["rewritten-url"],
								'pid'=>$video_urls["url"],
								'video_embed'=>str_replace("watch?v=", "embed/", $video_urls["rewritten-url"]),
								'user_id'=>$this->getUser()->id
								)
							);
		}
	}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE END OF A SERIES OF METHODS THAT INTERACT WITH A USERS CHOSEN YOUTUBE PLAYLISTS ON youtube.php////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// 		public function youtubeApiDbSync(){
// 		if(!count($this->getYoutubeDbPlaylist())){ // if nothing is returned from the query...
// 			$this->youtubeInsert(); // ...then go ahead and insert the API data (most likely first load of the page)
// 		} else {
// 		 	$difference = array_diff_assoc($this->getYoutubeDbPlaylist(),  $this->youtubeApiConnect()); // if there is a result then 				compare the two arrays and store the difference in a variable
//  		if($difference){ // if there is a difference ...
// print_r($difference);
// 			foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
//   				$delete = $this->_db->delete('playlists', array('playlist_url', '=', $value)); // ...and user that the delete rows from 							the db
// 			}
// 				} 
//     		$this->youtubeInsert();
//   		} 
	
// 		}
	/**
	 * [youtubeVideoInsert description] I think this method may rely on playlists already being in the database (via youtubeInsert).
	 * This method takes an array of all a users playlists (via $this->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist())
	 * from these it 1) constructs the path to the playlists image and inserts into playlists table. 2) goes through each playlist URI and 
	 * queries the API for the videos in each playlist.  It then inserts these into the video table. 
	 * @return [Youtube Object] [description] returns the YouTube object
	 */
	public function youtubeVideoInsert(){ 
		$playlists=$this->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist();
		//$playlists=$this->youtubeGetUserSelectedPlaylist($selection);
		foreach ($playlists as $title => $url) {
			$urls[]=$url;
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
				//print (string)$specific_playlist->entry[$i]->title.'<br />';
			$videos[(string)$specific_playlist->entry[$i]->title]=array(
											'rewritten-url'=>str_replace("&feature=youtube_gdata", "", 
											(string)$specific_playlist->entry[$i]->link->attributes()->href),
											'url'=>$url	
											);
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
													'user_id'=>$this->getUser()->id
													)
												);
			}
		return $this;
		}


	
	
	// public function youtubeDbPlaylistSelect(){ //I THINK I SHOULD NOT RETURN THE ARRAY COS IT MAKES IT HARDER TO GET OTHER THINGS FORM DB WITHOUT
	// //WRITING A NEW METHOD
	
	// 	if(!count($this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results()))
	// 		{
	// 		$this->youtubeInsert();

	// 		} 
			
	// 		$playlists=$this->_db->get('playlists', array('user_id', '=', $this->_user->data()->id))->results(); 					 
	// 		for ($i=0; $i < sizeof($playlists); $i++) { 
	// 					$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
		 
	// 	}

	// 	return $playlistArray;
		
	// 	}
	// 	

}
	

?>