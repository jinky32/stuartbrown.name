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

	public function getUserName()
		{
		    return $this->_user->data()->username;
		}
	
	public function youtubeApiConnect() {
		
		$html ="";
			$url='https://gdata.youtube.com/feeds/api/users/'.$this->getUserName().'/playlists';
			//$url="https://gdata.youtube.com/feeds/api/playlists/PLEtmlR7ubZ2nf5OYTqGws_vTKCQYwSj6e";
			$xml=simplexml_load_file($url);
			for ($i=0; $i < sizeof($xml->entry); $i++) { 
				$array[(string)$xml->entry[$i]->title]=(string)$xml->entry[$i]->id;
			}
			$this->_apiArray = $array;
	
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
		return print_r($playlistArray);
		}

//NOW I NEED TO KEEP THE API AND DB IN SYNC AS IN 500PX CLASS - BUT THIS NEEDS TO BE DONE LESS FREQUENTLY?  DO I ALSO NEED TO GO BACK ADN GET THE SYNCHRONISD DB ARRAY AND USE THAT RATHER THAN THE VALUES FROM youtubeDbVideoSelect WHICH IS JUST USED FOR SPOTTING THE DIFFERENCE BTW IT AND API ARRAY???




}
	

?>