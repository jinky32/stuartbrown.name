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
	
		public function youtubeDbPlaylistSelect(){ //I THINK I SHOULD NOT RETURN THE ARRAY COS IT MAKES IT HARDER TO GET OTHER THINGS FORM DB WITHOUT
	//WRITING A NEW METHOD
	
		if(!count($this->_db->get('playlists', array('user_id', '=', $this->getUser()->id))->results()))
			{
			$this->youtubeInsert();

			} 
			
			$playlists=$this->_db->get('playlists', array('user_id', '=', $this->getUser()->id))->results(); 					 
			for ($i=0; $i < sizeof($playlists); $i++) { 
						$playlistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_url;
		 
		}

		$this->_youtubeDbArray=$playlistArray;
		return $this;
		
		}


		public function getYoutubeDbPlaylist(){
			return $this->_youtubeDbArray;
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
	}
// $this->_db->delete('user', array(array('username', 'name'),array('=','='),array('alex','james')));
// 	$where=                array(array('username',  'pid'),array('=','='),array('alex','james'));


		public function videoDiff($selection){

			//print_r($this->youtubePlaylistSync($selection));
			//$test = $this->youtubePlaylistSync($selection);
			print_r($this->youtubePlaylistSync($selection)) ;
    print '<br /> here <br />';
			print_r($this->youtubeDbVideoSelect($selection));
			$difference = array_diff($this->youtubeDbVideoSelect($selection), $this->youtubePlaylistSync($selection));
			if($difference){
				print_r($difference);
				$this->deleteFromPlaylist($selection, $difference);
			}
			
			$this->updatePlaylist($selection);
			

			
			//if something is in the api array and not the db i want to insert it
			//if something is in the db aray and not hte api i want to delete it
		}

		public function deleteFromPlaylist($selection, $difference){ //NEED TO SET THIS UP SO THAT IT CAN ALSO TAKE USERID AND PID SO
			//THAT THE VIDEO REMAINS FOR OTHER USERS AND DIFFERENT PLAYLISTS
			foreach ($selection as $key => $value) {
				$url = $value;
			}
			//$select ='https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nvUC9qz_xMnzw6Qv-_Duzt';
			foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
  				$title=$value;
  			}
  				$delete = $this->_db->delete('videos', array(array('video_label','pid'), array('=','='), array($value, $url))); // ...and user that the delete rows from 							the db
			//$delete = $this->_db->delete('videos', array('video_label', '<', $value)); 
			

		}

		public function updatePlaylist($selection){
			foreach ($selection as $key => $value) {
				$url = $value;
			}
		
				$specific_playlist=simplexml_load_file($url);
	
		for ($i=0; $i<sizeof($specific_playlist->entry); $i++) {
	//print (string)$specific_playlist->entry[$i]->title.'<br />';
			// $videos[(string)$specific_playlist->entry[$i]->title]=str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href);
		$videos[(string)$specific_playlist->entry[$i]->title]=array('rewritten-url'=>str_replace("&feature=youtube_gdata", "", (string)$specific_playlist->entry[$i]->link->attributes()->href),
																	'url'=>$url	);
		//print $videos[(string)$specific_playlist->entry[$i]->title]["rewritten-url"];
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
		}

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
		

		public function youtubePlaylistSync($selection){ //this is receiving an array
			foreach ($selection as $key => $value) {
				$url = $value;
			}
		
				$playlist=simplexml_load_file($url); //an uri such as https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nMk96rueTBP4np_EhzxD7c
				for ($i=0; $i < sizeof($playlist->entry); $i++) { 
					$video[] = (string)$playlist->entry[$i]->title;
				//}

				//$difference = array_diff_assoc($this->getYoutubeDbPlaylist(),  $this->youtubeApiConnect());
				// $this->youtubeDbVideoSelect($selection);
				// $this->youtubeDbVideoSelect($selection);
			}
			return $video;
		
		}



		public function youtubeApiDbSync(){
		if(!count($this->getYoutubeDbPlaylist())){ // if nothing is returned from the query...
			$this->youtubeInsert(); // ...then go ahead and insert the API data (most likely first load of the page)
		} else {
		 	$difference = array_diff_assoc($this->getYoutubeDbPlaylist(),  $this->youtubeApiConnect()); // if there is a result then 				compare the two arrays and store the difference in a variable
 		if($difference){ // if there is a difference ...
print_r($difference);
			foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
  				$delete = $this->_db->delete('playlists', array('playlist_url', '=', $value)); // ...and user that the delete rows from 							the db
			}
				} 
    		$this->youtubeInsert();
  		} 
	
		}
		
//NOW I NEED TO KEEP THE API AND DB IN SYNC AS IN 500PX CLASS - BUT THIS NEEDS TO BE DONE LESS FREQUENTLY?  DO I ALSO NEED TO GO BACK ADN GET THE SYNCHRONISD DB ARRAY AND USE THAT RATHER THAN THE VALUES FROM getYoutubeDbPlaylist WHICH IS JUST USED FOR SPOTTING THE DIFFERENCE BTW IT AND API ARRAY???

public function youtubeVideoInsert(){ 
	$playlists=$this->getYoutubeDbPlaylist();
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
												'user_id'=>$this->getUser()->id
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