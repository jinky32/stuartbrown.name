<?php

class Fivehundredpx {
	private $_db,
			$_userFavourites,
			$_userFavouritesEnd,
			$_results;
	public static $consumer_key;
	public static $fivehundredpx;
	public static $username;
	public static $userid;
	public static $dbUserId;
	public static $nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.
	public static $photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array
	public static $categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.
	//public static $combined ='foo';

/*
dsjskd
sdjsdfjs
 */

/**
 * Connects to the database and stores the connection in the private variable $_db (above)
 * @param string $user by default set to null but will take a username. 
 */
	public function __construct($user = null){//define if we want to pass in a user value or not.
			$this->_db = DB::getInstance();  //set db to getInstance e.g. connect to db
		}
/**
 * Will take a username but if one is not set it will look for username in the url.  
 * Using this it will create an instance of User and return an array of all the data related to that user in 
 * the user table of the db
 * 
 * @param  string $userid is the name of a user (the name they sign up with ratehr than their 500px handle)
 * MIGHT WANT TO CONSIDER WHETHER THE STATIC VARIABLES NEED TO BE SET STILL.  at least two do i think
 */
	public function fhpxUser($userid=null){
		if(!$userid){
			$username = Input::get('user');
		} else {
			$username=$userid;
		}
		$username = Input::get('user');
		$user = new User($username);
		$data=$user->data(); 
		//print_r($data);
		self::$consumer_key = $data->fivehundredpxconsumerkey;
		self::$username = $data->username;
		self::$userid = $data->id;
		self::$fivehundredpx=$data->fivehundredpx;	
	}


// see https://github.com/500px/api-documentation/blob/master/endpoints/photo/GET_photos.md for the list of phot-related endpints
// categories at https://github.com/500px/api-documentation/blob/master/basics/formats_and_terms.md#categories.
// might want to show other photos from users in the same category as theirs that you have favourited 
// eg https://api.500px.com/v1/photos?feature=user&username=***user**earlmcgraw**/user***category**&only=Black and White****/category***&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb
	

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


/**
 * [fhpxEndpoint description] Defines / creates the URL to use for the 500px API
 * @param  [type] string $endpoint [description] which aspect of a user's profile you want form the 500px API (user_favorites - 
 * the user's favourited images or user - their own images)
 * @return [type] URL           [description] the URL to use to request images from 500px API
 */
	public function fhpxEndpoint($endpoint){
		switch ($endpoint) {
			case 'user_favourites':
				return $apistring = 'https://api.500px.com/v1/photos?feature=user_favorites&username=' .self::$fivehundredpx . '&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
				break;
			case 'user':
				return $apistring = 'https://api.500px.com/v1/photos?feature=user&username=' .self::$fivehundredpx . '&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
				break;		
			default:
				return $apistring = 'https://api.500px.com/v1/photos?feature=user_favorites&username=' .self::$fivehundredpx . '&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
				break;
		}
	}

/**
 * [fhpxApiConnect description] Connect to the 500px API and return the data as a json object
 * @param  [string / URI] $apiString [description] the API URI returned by the fhpxEndpoint method above.
 * @return [array] $obj    [description] a json object from the 500px API.
 */
	public function fhpxApiConnect($apiString){
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
		}


/**
 * [fhpxApiArray description] For each of the photos in the 500px array construct a multidimensional associative array with the name of the image 
 * as the key and then an array collecting the username etc.  This is later to be inserted into the database.
 * @param  array $obj [description] the json object returned by the fhpxApiConnect method above
 * @return [array]   $photo   [description] a multidimensional associative array with the name of the image 
 * as the key and then an array collecting the username etc.  This will be compared with the output of fhpxDbImageSelect
 */	
	public function fhpxApiArray($obj){
		$photos = $obj->photos;
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
    	return $photo;
		
	}

/**
 * [fhpxInsert description] Insert the manipulated data (as per fhpxApiArray method above) into the database for the current user.
 * @param  [string] $feature [description] either user or user_favorites. This both gets the correct URI for the 500px API call
 * and sets the correct table for the data to be inserted into.	
 */
		public function fhpxInsert($feature){
		$combined=$this->fhpxApiArray($this->fhpxApiConnect($this->fhpxEndpoint($feature)));
		for ($i=0; $i < sizeof($combined); $i++) { 							
				foreach($combined as $key => $value){
			$this->_db->insert('images_'.$feature, array(
								'photo_title'=>$key,
								'username'=>$value[username],
								'fullname'=>$value[fullname],
								'userpic_url'=>$value[userpic_url],
								'description'=>$value[description],
								'cat_id'=>$value[category],
								'url'=>$value[url],	
								'image_url'=>$value[image_url],						
								'user_id'=>self::$userid
								)
							);
				}

			}
	
		}

/**
 * [displayImage description] test function to try and debug issues with getUserImage method
 * @param  [type] $userid [description]
 * @return [type]         [description]
 */
		// public function displayImage($userid){
		// 	$userQuery = $this->_db->get('images_user', array('user_id', '=', $userid))->results();
		// 	return $profilePicture = $userQuery[0]->userpic_url;
		// }


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
		public function fhpxDbImageSelect($feature, $userid){
		 $images=$this->_db->get('images_'.$feature, array('user_id', '=', $userid))->results(); 
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

/**
 * [fhpApiDbSync description] attempts to keep the API data (always the most up-to-date) and the db data in sync so that when a user adds/deletes a new favourite it is removed from the nav
 * @param  string $feature [description] user or user_favorites
 * @param  integer $userid  [description] numeric id for the user to make sure we are selecting from corect row
 * @param  string / URI $obj     [description] the string to use when connecting to the 500px API
 * @return array     fhpxDbFullArray     [description] The images from the database after being checked and synced against the values from the API
 */
		public function fhpApiDbSync($feature, $userid, $obj){
	//public function fhpxNav($feature, $userid, $obj){
		if(!count($this->fhpxDbImageSelect($feature, $userid))){ // if nothing is returned from the query...
			$this->fhpxInsert($feature); // ...then go ahead and insert the API data (most likely first load of the page)
		} else {
			 $difference = array_diff_assoc($this->fhpxDbImageSelect($feature, $userid), $this->fhpxApiArray($obj)); // if there is a result then compare the two arrays and store the difference in a variable
			 if($difference){ // if there is a difference ...
    		foreach ($difference as $key => $value) { // ...break apart array to get $key (image name) ...
      				$delete = $this->_db->delete('images_'.$feature, array('photo_title', '=', $key)); // ...and user that the delete rows from the db
     				} 
     		$this->fhpxInsert($feature);
    		} 
		}
		// $this->fhpxInsert($feature); // I THINK THIS SHOULD BE WITHIN THE ELSE STATEMENT ABOVE. OTHERWISE IT IS BEING RUN TWICE IF THE ORIGINAL IF STATEMENT IS TRUE
		//$fhpxDbNavArray=array();
		return $fhpxDbFullArray = $this->fhpxDbImageSelect($feature, $userid);	// go back to the database and get the (possibly) updated list of images
		//return $fhpxDbFullArray = $this->fhpxDbImageSelect($feature, $userid);	
			


		}


 /**
  * [fhpxDbUserSelect description] Get the numeric user ID from the string of the username
  * @param  [string] $fivehundredpx [description] a username string
  * @return [integer]    self::$dbUserId            [description] the userid available without instantiating a class
  */
public function fhpxDbUserSelect($fivehundredpx){
		self::$dbUserId=$this->_db->get('users', array('username', '=', $fivehundredpx))->first()->id;
		return self::$dbUserId;
	}

/**
 * [fhpxNav description] uses the fhpApiDbSync method to comare the API data to the DB data.  Once the fhpApiDbSync method has
 * syncronised the data the fhpxNav method returns an array of category label and ID to be used in the primay nav.
 * @param  [string] $feature [description] user or user_favorites
 * @return [array]    $fhpxDbNavArray      [description] an associative array of category label and ID to be used in the
 * site primary navigation.
 */
	public function fhpxNav($feature){
		$test = $this->fhpApiDbSync($feature, $this->fhpxDbUserSelect(Input::get(user)),$this->fhpxApiConnect($this->fhpxEndpoint($feature)));

		for ($i=0; $i < sizeof($test); $i++) { 
		foreach($test as $key => $value){
			$fhpxDbNavArray[$key] = $value[cat_id];
			}
		return $fhpxDbNavArray;
		}

		// return $intersect = array_intersect($this->fhpDbCategorySelect(), 
		// 							$fhpxDbNavArray); 
	}

}
?>
