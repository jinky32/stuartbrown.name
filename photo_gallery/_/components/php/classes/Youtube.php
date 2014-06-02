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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////TASKS:
/////////// GIVEN AN ARRAY OF PLAYLIST URI:
///QUERY THE DB FOR VIDEOS -youtubeDbVideoSelect()
///QUERY THE DB FOR PLAYLISTS - youtubeDbPlaylistSelect()
///QUERY THE API FOR VIDEOS - youtubeAPIVideoSelect() 
///QUERY THE API FOR PLAYLISTS - youtubeApiConnect()
///RETURN THE API PLAYLISTS - getYoutubeApiPlaylist()
///INSERT VIDEOS INTO THE DB - youtubeVideoInsert() 
///INSERT PLAYLISTS INTO THE DB - youtubeInsert()
//////COMPARE THE DB AND API PLAYLISTS - youtubePlaylistCompare()
//////COMPARE THE DB AND API FOR VIDEOS IN APLAYLISTS
///DELETE VIDEOS INTO THE DB - deleteFromPlaylist()
///DELETE PLAYLISTS INTO THE DB
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE START OF A SERIES OF METHODS THAT DEAL WITH PLAYLISTS////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * GET A LIST OF USERS PLAYLISTS FROM THE API
	 */
	public function youtubeApiConnect() { //I THINK THAT USERNAME SHOULD BE PASSED AS A PARAMETER TO MAKE IT MORE OBVIOUS
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
	 * RETURN A LIST OF USERS PLAYLISTS FROM THE API
	 */
	public function getYoutubeApiPlaylist(){
			return $this->_youtubeApiArray;
			// Array ( [To watch - data] => http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2mWeLTu_7PHvfhB4szenjC9 
			// [To watch - 3d] => http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2nk-186lNJRFJ8pfrmMnVNz 
			// [Symfony] => http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2nMk96rueTBP4np_EhzxD7c
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
		public function youtubeDbPlaylistSelect(){ //I THINK THAT USERNAME SHOULD BE PASSED AS A PARAMETER TO MAKE IT MORE OBVIOUS
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

		public function youtubePlaylistCompare(){
			print_r($this->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist());
			print_r($this->youtubeApiConnect()->getYoutubeApiPlaylist());
			$difference = array_diff_key($this->getYoutubeApiPlaylist(), $this->getYoutubeDbPlaylist());
			if($difference) {
				print 'nope they are different';
				print_r($difference);
				
			} else {
				print 'they are the same';
			}

				

					
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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE END OF A SERIES OF METHODS THAT DEAL WITH PLAYLISTS////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE START OF A SERIES OF METHODS THAT DEAL WITH VIDEOS////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/**
	 * [QUERY THE DB FOR VIDEOS
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
	 * QUERY THE API FOR VIDEOS  
	 */
	public function youtubeAPIVideoSelect($selection){ 
		//$selection=$this->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist();
		//$playlists=$this->youtubeGetUserSelectedPlaylist($selection);
		foreach ($selection as $title => $url) {
			print 'this is title '.$title . 'and this is url '.$url;
			//$urls[]=$url;
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
											'rewritten-url'=>str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href),
											'url'=>$url
											);
			//print $videos[(string)$specific_playlist->entry[$i]->title]["rewritten-url"];
			}
			//print_r($videos);
			 return $videos;
			 //return $this;
		}
	}

/**
	 * INSERT VIDEOS INTO THE DB
	 */


public function youtubeVideoInsert($selection){ 
	$videos = $this->youtubeAPIVideoSelect($selection);
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
	 * DELETE VIDEOS INTO THE DB 
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
		//$this->updatePlaylist($selection);
		$this->youtubeVideoInsert($selection);
	}





	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE END OF A SERIES OF METHODS THAT INTERACT WITH A USERS CHOSEN YOUTUBE PLAYLISTS ON youtube.php////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
	 *QUERY THE API FOR VIDEOS  - - INSERT VIDEOS INTO THE DB
	 */
	// public function updatePlaylist($selection){
	// 	foreach ($selection as $key => $value) {
	// 		$url = $value;
	// 	}
	// 	$specific_playlist=simplexml_load_file($url);
	// 	for ($i=0; $i<sizeof($specific_playlist->entry); $i++) {
	// 		$videos[(string)$specific_playlist->entry[$i]->title]=array(
	// 															'rewritten-url'=>str_replace("&feature=youtube_gdata", "", 
	// 															(string)$specific_playlist->entry[$i]->link->attributes()->href),
	// 															'url'=>$url	
	// 															);
	// }
	// 	foreach ($videos as $video_label => $video_urls) {
	// 		$this->_db->insert('videos', array(
	// 							'video_label'=>$video_label,
	// 							// 'video_url'=>$video_url,
	// 							'video_url'=>$video_urls["rewritten-url"],
	// 							'pid'=>$video_urls["url"],
	// 							'video_embed'=>str_replace("watch?v=", "embed/", $video_urls["rewritten-url"]),
	// 							'user_id'=>$this->getUser()->id
	// 							)
	// 						);
	// 	}
	// }




}
	

?>