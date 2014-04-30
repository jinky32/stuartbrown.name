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


	public function __construct($user = null){//define if we want to pass in a user value or not.
			$this->_db = DB::getInstance();  //set db to getInstance e.g. connect to db
		}

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


	public function fhpxApiArray($obj){
		foreach ($obj->photos as $photos_500px){ //loop through photos and set values of arrays
			$combined[$photos_500px->name]=$photos_500px->category;
	    }
	    return $combined;
	   	print_r($combined); 
	}


	public function fhpxDbUserSelect($fivehundredpx){
		self::$dbUserId=$this->_db->get('users', array('username', '=', $fivehundredpx))->first()->id;
		return self::$dbUserId;
	}


	public function fhpxDbImageSelect($feature, $userid){
		 $images=$this->_db->get('images_'.$feature, array('user_id', '=', $userid))->results(); 
		 for ($i=0; $i < sizeof($images); $i++) { 
		  $dbImageArray[$images[$i]->photo_title]=$images[$i]->cat_id;
  		}
  		return $dbImageArray;
	} 


	public function fhpxNav($feature, $userid, $obj){
		if(!count($this->fhpxDbImageSelect($feature, $userid))){
			$this->fhpxInsert($feature);
		} else {
			 $difference = array_diff_assoc($this->fhpxDbImageSelect($feature, $userid), $this->fhpxApiArray($obj)); 
			 if($difference){ // if there is a difference use that cat_id in a delete statement
    			foreach ($difference as $key => $value) { //break apart array to get cat_id value
      				$delete = $this->_db->delete('images_'.$feature, array('photo_title', '=', $key));
    				} 
    		} 
		}
		return $navItems = $this->fhpxDbImageSelect($feature, $userid);		
		}

	
	public function fhpxInsert($feature){
		$combined=$this->fhpxApiArray($this->fhpxApiConnect($this->fhpxEndpoint($feature)));
		foreach($combined as $key => $value){
			$this->_db->insert('images_'.$feature, array(
								'photo_title'=>$key,
								'cat_id'=>$value,
								'user_id'=>self::$userid
								)
							);
		}
	}


}
?>
