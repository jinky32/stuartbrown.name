<?php

class Fivehundredpx {
	private $_db,
			$_userFavourites,
			$_userFavouritesEnd;
	public static $consumer_key;
	public static $fivehundredpx;
	public static $username;
	public static $userid;
	public static $nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.
	public static $photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array
	public static $categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.
	//public static $combined ='foo';


//I THINK THE CONSTRUCTOR ONLY NEEDS TO ESTABLISH DB CONNECTION.
	//THE OTHER VALUES CAN BE SET IN A METHOD BELOW USING CASE / SWITCH IN ORDER TO DETERMINE WHICH API ENDPOINT TO CALL
	public function __construct($user = null){//define if we want to pass in a user value or not.
			$this->_userFavourites = 'https://api.500px.com/v1/photos?feature=user_favorites&username=';
			$this->_userFavouritesEnd ='&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=';
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
		print_r($data);
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
		//return 'AND HERE I AM';
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

// public function apiString(){
// 	return $apistring = $this->_userFavourites.self::$fivehundredpx.$this->_userFavouritesEnd.self::$consumer_key;

// 	}

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
	    $categories[]=$photos_500px->category;
	    $nonunique[]=$photos_500px->category;
	    $photoname[]=$photos_500px->name;
	 
	    }
	   return $combined=array_combine($photoname, $nonunique); 
	   print_r($combined);
	}

//this method allows me to set the api endpoint to conenct to using $feature (e.g user_favourites), and also allows me to set
// a duplicate key to avpid the same image being inserted twice
//HOWEVER HOW WILL THIS WORK IF THE SAME IMAGE NEEDS TO BE INSERTED FOR TWO DIFFERENT USERS? DOES DUPICATE KEY NEED TO BE AN 
//ARRAY OF USER AND IMAGE_NAME?

	public function fhpxInsert($feature, $duplicateKey=''){
		print 'HELLO' . self::$userid;
		$combined=$this->fhpxApiArray($this->fhpxApiConnect($this->fhpxEndpoint($feature)));
		foreach($combined as $key => $value){
			$this->_db->insert('images', array(
								'photo_title'=>$key,
								'cat_id'=>$value,
								'user_id'=>self::$userid
								), $duplicateKey
							);
							}
	}



}

// add something so that I can say 
// $500 = new Fivehundredpx
// Fivehundredpx::API($user)  //which gives me their api string

// so there needs to be a function in this class which connects to the db and gets the users 500px id and combines it with the private variables above
?>
