<?php

Class Youtube{
	private $_youtubeApiArray;
	private $_youtubeDbArray;
	private $_user;
	private $_db;
	public $selected;
	public $ytUserId;
	public $playlists;
	public $test;
	
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

		public function User()
		{
		    return $this->_user->isLoggedIn();
		}	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////TASKS:
/////////// GIVEN AN ARRAY OF PLAYLIST URI:
///QUERY THE API FOR PLAYLISTS - youtubeApiPlaylistSelect()
///RETURN THE API PLAYLISTS - getYoutubeApiPlaylist()  -THIS IS GOING TO BE DELETED
///QUERY THE DB FOR PLAYLISTS - youtubeDbPlaylistSelect()
///COMPARE THE DB AND API PLAYLISTS - youtubePlaylistCompare()
///INSERT PLAYLISTS INTO THE DB - youtubeInsert()
///INSERT PLAYLIST IMAGES INTO THE DB - youtubeDbPlaylistImageInsert()
///RETURN PLAYLIST IMAGES FROM THE DB - youtubeDbPlaylistImageSelect()
///DELETE PLAYLISTS FROM THE DB - deletePlaylist()
///
///QUERY THE API FOR VIDEOS - youtubeAPIVideoSelect() 
///QUERY THE DB FOR VIDEOS -youtubeDbVideoSelect()
///COMPARE THE DB AND API FOR VIDEOS IN A PLAYLISTS youtubePlaylistVideosCompare()
///INSERT VIDEOS INTO THE DB - youtubeVideoInsert() 
///DELETE VIDEOS FROM THE DB - deleteFromPlaylist()
///
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////THIS IS THE START OF A SERIES OF METHODS THAT DEAL WITH PLAYLISTS////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function youtubev3($apiString){
		$ch = curl_init();
	   	curl_setopt($ch, CURLOPT_URL,$apiString);
	    curl_setopt($ch , CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		$json = curl_exec($ch);
		if(curl_errno($ch))
		   {
		       // echo 'Curl error: ' . curl_error($ch);
		   }
		 	curl_close($ch);
		   $obj = array();

	//decode json response
		 if($json){
		      $obj = json_decode($json); 
		          }
		 else {
		      print "<p>Currently, No Service Available.</p>";
		        } 
		 return $obj;   
		 //return $this;             
		}

			public function youtubev3UserId(){
		//$apicall="https://www.googleapis.com/youtube/v3/channels?part=id,snippet,contentDetails&forUsername=jinky32&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM";
		$apicall='https://www.googleapis.com/youtube/v3/channels?part=id,snippet,contentDetails&forUsername='.$this->getUser()->youtube.'&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM';
		$this->ytUserId = $this->youtubev3($apicall)->items[0]->id;
		//return $this->youtubev3($apicall)->items[0]->id;	
		}

/**
	 * GET A LIST OF USERS PLAYLISTS FROM THE API
	 */
public function youtubeApiPlaylistSelect() { //I THINK THAT USERNAME SHOULD BE PASSED AS A PARAMETER TO MAKE IT MORE OBVIOUS
				$this->youtubev3UserId();
$playlists_url="https://www.googleapis.com/youtube/v3/playlists?part=id,snippet&fields=items(id,snippet(channelId,title,thumbnails))&channelId=".$this->ytUserId."&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM&maxResults=50";
				$playlists = $this->youtubev3($playlists_url);
				//print_r($this->playlists);
				for ($i=0; $i < sizeof($playlists->items) ; $i++) { 
					//print $this->playlists->items[$i]->snippet->title . '<br />';
					$array[$playlists->items[$i]->snippet->title]=array('playlist_id'=>$playlists->items[$i]->id,'playlist_image'=>$playlists->items[$i]->snippet->thumbnails->medium->url);
				}
				return $array;
		}
	
	/**
	 * RETURN A LIST OF USERS PLAYLISTS FROM THE API
	 */
	public function getYoutubeApiPlaylist(){
			return $this->_youtubeApiArray;
		}


	/**
		 * [youtubeDbPlaylistSelect description] Selects the playlists associated with a user from the database.  Used with youtubeApiPlaylistSelect() and
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
					$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_id; //PLAYLISY_URL NEEDS TO CHANGE TO ID SO IT IS ADDED TO THE YOUTUBE.PHP
					//AND WILL ALLOW VIDEO INSERT METHOS TO WORK.  OTHER METHODS THAT USE $SELECT VALUES NNED TO ALTER TO NOT LOOK AT PID
					//BUT PLAYLISY_ID  (I THINK!)
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
			// print_r($this->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist());
			// print_r($this->youtubeApiPlaylistSelect());
			//print_r($this->youtubeApiPlaylistSelect()->getYoutubeApiPlaylist());
			$difference = array_diff_key($this->getYoutubeDbPlaylist(), $this->youtubeApiPlaylistSelect());
			if($difference) {
				$this->deletePlaylist($difference);	
			} else {
				$this->youtubeInsert();
			}		
		}

	/**
	 * [youtubeInsert description] Takes the array from youtubeApiPlaylistSelect method and inserts each one into the playlists table of the database.
	 * It manipulates the URI to make them usable in other API keys. Also adds in the playlist title and the user ID
	 */
	public function youtubeInsert(){  // I SHOULD PERHAPS CALL THE FUNCTION THAT INSERTS THE PLAYLIST IMAGE FROM WITHIN THIS FUNCTION
		foreach($this->youtubeApiPlaylistSelect() as $key => $value){
			$this->_db->insert('playlists', array(
							'playlist_title'=>$key,
							'playlist_id'=>$value["playlist_id"],
							'playlist_url'=>'https://www.youtube.com/playlist?list='.$value["playlist_id"],
							//'playlist_url'=>str_replace("users/jinky32/", "", $value),
							// 'playlist_url'=>'https://www.youtube.com/playlist?list='.$value["playlist_id"],
							'playlist_image'=>$value["playlist_image"],
							'user_id'=>$this->getUser()->id
							)
						);	
		}
	}



	/**
	 * DELETE VIDEOS FROM THE DB 
	 */
	public function deletePlaylist($difference){ 
	foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
			$delete = $this->_db->delete('playlists', array('playlist_id','=',$value)); // ...and user that the delete rows from the db
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
	 * QUERY THE API FOR VIDEOS  
	 */
	public function youtubeAPIVideoSelect($selection){ 		
		foreach ($selection as $title => $url) {

$videourl="https://www.googleapis.com/youtube/v3/playlistItems?part=id,snippet&fields=items(id,snippet(channelId,title,playlistId,resourceId))&playlistId=".$url."&key=AIzaSyCkLQdmPsuH_Ce3qXbMkX6z-p_t4EX4aoM&maxResults=50";		
			$specific_playlist=$this->youtubev3($videourl);
			 for ($i=0; $i<sizeof($specific_playlist->items); $i++) {
				//print (string)$specific_playlist->entry[$i]->title.'<br />';
			$videos[(string)$specific_playlist->items[$i]->snippet->title]=array(
											'rewritten-url'=>$specific_playlist->items[$i]->snippet->resourceId->videoId,
											'url'=>$url
											);
			}
		}
			 return $videos;
	}


	/** 
	 * [QUERY THE DB FOR VIDEOS
	 */
	public function youtubeDbVideoSelect($selection){  
		foreach ($selection as $key => $value) {
			$dbVideoArray=$this->_db->get('videos', array('pid', '=', $value))->results();
		//print_r($dbVideoArray);
			for ($i=0; $i < sizeof($dbVideoArray); $i++) { 
							$dbVideos[$dbVideoArray[$i]->video_label]=$dbVideoArray[$i]->pid;		 
			}
		}
		
		return $dbVideos;
	}



	public function youtubePlaylistVideosCompare($selection){ 
		$this->selected = $selection;
		foreach ($selection as $key => $value) {
			$value = (array)$value;
		if(count($this->youtubeDbVideoSelect($value))) {
			$difference = array_diff_key($this->youtubeDbVideoSelect($value), $this->youtubeAPIVideoSelect($value));
			if($difference) {
				$this->deleteFromPlaylist($difference);
				 } 
		}
		$this->youtubeVideoInsert($value);	
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
												'video_url'=>'https://www.youtube.com/watch?v='.$video_urls["rewritten-url"],
												'pid'=>$video_urls["url"],
												'vid'=>$video_urls["rewritten-url"],
												'video_embed'=>str_replace("watch?v=", "embed/", $video_urls["rewritten-url"]),
												'user_id'=>$this->getUser()->id
												)
											);
						// $sql ="UPDATE {$table} SET {$set} WHERE {$field}='{$id}'";
						 $this->_db->update('playlists', 'playlist_id', $video_urls["url"], array('selected'=> TRUE));
						
				}
			return $this;
			}


//<---------------------------THIS???
	/**
	 * DELETE VIDEOS FROM THE DB 
	 */
		public function deleteFromPlaylist($difference){ 
		foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
				//$title=$key;
				$delete = $this->_db->delete('videos', array(array('video_label','pid'), array('=','='), array($key, $value))); // ...and user that the delete rows from the db
			}
			}






}
	

?>