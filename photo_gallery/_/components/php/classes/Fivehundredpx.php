<?php

class Fivehundredpx {
	private $_db,
	$_obj,
	$_feature,
	$_fhpxApiArray,
	$_user;
	public $apistring;


/**
 * Connects to the database and stores the connection in the private variable $_db (above)
 * @param string $user by default set to null but will take a username. 
 */
	public function __construct(User $user, DB $db){//define if we want to pass in a user value or not.
			$this->_db = $db;  //set db to getInstance e.g. connect to db
			$this->_user = $user;
			// $this->userid = $user->data()->id;
			// $this->fivehundredpx = $user->data()->fivehundredpx;
			// self::$fivehundredpx=$user->data()->fivehundredpx;
			// $this->username = $user->data()->username;
			return $this;
		}


//

// see https://github.com/500px/api-documentation/blob/master/endpoints/photo/GET_photos.md for the list of phot-related endpints
// categories at https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#categories.
// might want to show other photos from users in the same category as theirs that you have favourited 
// eg https://api.500px.com/v1/photos?feature=user&username=***user**earlmcgraw**/user***category**&only=Black and White****/category***&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb
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




/**
 * [fhpxEndpoint description] Defines / creates the URL to use for the 500px API
 * @param  [type] string $endpoint [description] which aspect of a user's profile you want form the 500px API (user_favorites - 
 * the user's favourited images or user - their own images)
 * @return [type] URL           [description] the URL to use to request images from 500px API
 */
	public function fhpxEndpoint($endpoint){
		//$fivehundred = $this->fivehundredpx;
		switch ($endpoint) {
			case 'user_favourites':
				 $this->apistring = "https://api.500px.com/v1/photos?feature=user_favorites&username=". $this->getUser()->fivehundredpx."&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb";

				break;
			case 'user':
				 $this->apistring = "https://api.500px.com/v1/photos?feature=user&username=". $this->getUser()->fivehundredpx."&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb";
				
				break;		
			default:
				 $this->apistring = "https://api.500px.com/v1/photos?feature=user_favorites&username=". $this->getUser()->fivehundredpx."&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb";

				break;
		}
		$this->_feature = $endpoint;
		return $this;
	}

/**
 * [fhpxApiConnect description] Connect to the 500px API and return the data as a json object
 * @param  [string / URI] $apiString [description] the API URI returned by the fhpxEndpoint method above.
 * @return [array] $obj    [description] a json object from the 500px API.
 */
	public function fhpxApiConnect(){
		//print $apiString;
		//die();
		$ch = curl_init();
	   	curl_setopt($ch, CURLOPT_URL,$this->apistring);
	    curl_setopt($ch , CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		$json = curl_exec($ch);
		if(curl_errno($ch))
		   {
		       // echo 'Curl error: ' . curl_error($ch);
		   }
		 	curl_close($ch);
		   $obj = array();
//print_r($_obj);
	//decode json response
		 if($json){
		      $obj = json_decode($json); 
		          }
		 else {
		      print "<p>Currently, No Service Available.</p>";
		        } 
		  $this->_obj = $obj;   
		  return $this;
		 //print_r($_obj);     
		}


/**
 * [fhpDbCategorySelect description] Gets the categories from the database
 * @return array $nav which contains the category label and numeric ID of each term
 */
	public function fhpDbCategorySelect(){
	$navRaw = $this->_db->get('categories',array('cat_id','>=',0))->results();
		for ($i=0; $i < sizeof($navRaw); $i++) { 
  		$nav[$navRaw[$i]->label]=$navRaw[$i]->cat_id;
	}
	return $nav;
	}

	public function getUser()
			{
			    return $this->_user->data();
			}	


/**
 * [fhpxApiArray description] For each of the photos in the 500px array construct a multidimensional associative array with the name of the image 
 * as the key and then an array collecting the username etc.  This is later to be inserted into the database.
 * @param  array $obj [description] the json object returned by the fhpxApiConnect method above
 * @return [array]   $photo   [description] a multidimensional associative array with the name of the image 
 * as the key and then an array collecting the username etc.  This will be compared with the output of fhpxDbImageSelect
 */	
	public function fhpxApiPhotoSelect(){
		$photos = $this->_obj->photos;
		//print_r($photos);
		for ($i=0; $i < sizeof($photos); $i++) { 
			$photo[$photos[$i]->name] = array(
				'username'=>$photos[$i]->user->username,
				'fullname'=>$photos[$i]->user->fullname,
				'userpic_url'=>$photos[$i]->user->userpic_url,
				'description'=>$photos[$i]->description,
				'category'=>$photos[$i]->category,
				'image_url'=>$photos[$i]->image_url,
				'url'=>$photos[$i]->url
				);
      		//print 'this is photo name'. $photos[$i]->name . 'and this is photo ID' . $photos[$i]->id . '<br />';
    	}
    	return $this->_fhpxApiArray = $photo;
		
	}

/**
 * [fhpxInsert description] Insert the manipulated data (as per fhpxApiArray method above) into the database for the current user.
 * @param  [string] $feature [description] either user or user_favorites. This both gets the correct URI for the 500px API call
 * and sets the correct table for the data to be inserted into.	
 */
		public function fhpxInsert(){						
				foreach($this->_fhpxApiArray as $key => $value){
			$this->_db->insert('images_'.$this->_feature, array(
								'photo_title'=>$key,
								'username'=>$value['username'],
								'fullname'=>$value['fullname'],
								'userpic_url'=>$value['userpic_url'],
								'description'=>$value['description'],
								'cat_id'=>$value['category'],
								'url'=>$value['url'],	
								'image_url'=>$value['image_url'],						
								'user_id'=>$this->getUser()->id
								)
							);
				}
		}


/**
 * [getUserImage description] Queries the images_user table reutrning items related to the current user and then returns their profile picture
 * @param  [integer] $userid [description] called via $fivehundredpx->fhpxDbUserSelect(Input::get(user)) which gets the user id from the username
 * @return [string / url]     $profilePicture    [description] a link to the profile picture which can be rendered in img src
 */
		public function getUserImage($userid){ 
		 if($userQuery=$this->_db->get('images_user', array('user_id', '=', $userid))->results()){ 
		 	return $profilePicture = $userQuery[0]->userpic_url; 
				} 
		 else {
			return false;
				}
		}


/**
 * [fhpxDbImageSelect description] gets the images for a user from the database and constructs an array that is identical in form to the 
 * array constructed out of the returned API object. This is so that they arrays can be easily checked to see if they are different in order
 * to keey the API and database in sync
 * @param  string $feature [description] either user or user_favorites to determine which database table to select from 
 * @param  [integer] $userid  [description] the userid so that we are selecting from the correct row
 * @return array $image         [description] a multidimensional associative array with the name of the image 
 * as the key and then an array collecting the username etc.  This will be compared with the output of fhpxApiArray
 */
	public function fhpxDbImageSelect(){
	 $images=$this->_db->get('images_'.$this->_feature, array('user_id', '=', $this->getUser()->id))->results(); 
	 for ($i=0; $i < sizeof($images); $i++) { 
	  //$dbImageArray[$images[$i]->photo_title]=$images[$i]->cat_id;
	 	foreach($images as $key => $value){
	 		//$image[$images[$i]->photo_title];
	 		$image[$images[$i]->photo_title]=array(
	 			'username'=>$images[$i]->username,
				'fullname'=>$images[$i]->fullname,
				'userpic_url'=>$images[$i]->userpic_url,
				'description'=>$images[$i]->description,
				'cat_id'=>$images[$i]->cat_id,
				'image_url'=>$images[$i]->image_url,
				'url'=>$images[$i]->url
	 			);
	 	};
	}
  	return $image;
	} 



	public function fhpxPhotoCompare(){
	if($this->fhpxDbImageSelect()){
		$difference = array_diff_key($this->fhpxDbImageSelect(), $this->fhpxApiPhotoSelect());
		if($difference) {
			//print_r($difference);
			$this->deletePhoto($difference);	
		} 
	}
	$this->fhpxInsert();
	return $this;
	}


	public function deletePhoto($difference){ 
		foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
				//$title=$key;
				$this->_db->delete('images_'.$this->_feature, array('url','=',$value['url'])); // ...and user that the delete rows from the db
				}
		}


/**
 * [fhpxNav description] uses the fhpApiDbSync method to comare the API data to the DB data.  Once the fhpApiDbSync method has
 * syncronised the data the fhpxNav method returns an array of category label and ID to be used in the primay nav.
 * @param  [string] $feature [description] user or user_favorites
 * @return [array]    $fhpxDbNavArray      [description] an associative array of category label and ID to be used in the
 * site primary navigation.
 */
	public function fhpxNav(){
		$photos = $this->fhpxDbImageSelect();
		foreach($photos as $key => $value){
			$fhpxDbNavArray[$key] = $value['cat_id'];
			}
		return $fhpxDbNavArray;
	}
	}
?>
