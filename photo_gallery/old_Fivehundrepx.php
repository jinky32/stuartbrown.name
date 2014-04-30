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


//I THINK THE CONSTRUCTOR ONLY NEEDS TO ESTABLISH DB CONNECTION.
	//THE OTHER VALUES CAN BE SET IN A METHOD BELOW USING CASE / SWITCH IN ORDER TO DETERMINE WHICH API ENDPOINT TO CALL
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

	// public function test($obj){
	// 	foreach ($obj->photos as $photos_500px){ //loop through photos and set values of arrays
	//     print $photos_500px->user->firstname;
	    
	//     }
	// }

	public function fhpxApiArray($obj){
		foreach ($obj->photos as $photos_500px){ //loop through photos and set values of arrays
	    // $categories[]=$photos_500px->category;
	    // $nonunique[]=$photos_500px->category;
	    // $photoname[]=$photos_500px->name;
			$combined[$photos_500px->name]=$photos_500px->category;
	    }
	    return $combined;
	   //return $combined=array_combine($photoname, $nonunique); 
	   //$combined=array_combine($photoname, $nonunique);
	   print_r($combined); 
	}

//this method allows me to set the api endpoint to conenct to using $feature (e.g user_favourites), and also allows me to set
// a duplicate key to avpid the same image being inserted twice
//HOWEVER HOW WILL THIS WORK IF THE SAME IMAGE NEEDS TO BE INSERTED FOR TWO DIFFERENT USERS? DOES DUPICATE KEY NEED TO BE AN 
//ARRAY OF USER AND IMAGE_NAME?


	// 	public function get($table, $where){
	// 	return $this->action('SELECT *', $table, $where);  // 'SELECT *' here is passed to the $action param in action menthod above
	// }

	public function fhpxDbUserSelect($fivehundredpx){
		// print 'here is the DB DATA'.'images_'.$feature;
		//$data=$this->_db->get('users', array('username', '=', $fivehundredpx));
		// $this->_db->get('users', array('username', '=', $fivehundredpx))
		self::$dbUserId=$this->_db->get('users', array('username', '=', $fivehundredpx))->first()->id;
		//print_r($data);
		return self::$dbUserId;
	}


	public function fhpxDbImageSelect($feature, $userid){
		 $images=$this->_db->get('images_'.$feature, array('user_id', '=', $userid))->results(); 
		 //print_r($images);
		 for ($i=0; $i < sizeof($images); $i++) { 
		  $dbImageArray[$images[$i]->photo_title]=$images[$i]->cat_id;
  		}
  		return $dbImageArray;
  		//return true;
  		//print_r($dbImageArray);
	} 

	//public function fhpxNav($feature, $userid){
	public function fhpxNav($feature, $userid, $obj){
		//$obj = Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites));
		//return self::fhpxApiArray($obj); 
		if(!count($this->fhpxDbImageSelect($feature, $userid))){
			$this->fhpxInsert($feature);
		} else {
			//print 'GAAAAAAAHHHHH';
			//print count($this->fhpxDbImageSelect($feature, $userid));
			//dbarray first
			//try defining the arrays in array_dif_assoc as public static fhpxDbImageSelect=array() and then calling the below using self::
			 $difference = array_diff_assoc($this->fhpxDbImageSelect($feature, $userid), $this->fhpxApiArray($obj)); 
			//print_r(array_diff_assoc($this->fhpxDbImageSelect($feature, $userid), $this->fhpxApiArray($obj))) ; 
			 if($difference){ // if there is a difference use that cat_id in a delete statement
    		foreach ($difference as $key => $value) { //break apart array to get cat_id value
      		//print 'this is key ' . $key . 'and this is value ' .$value . '<br />';
      		$delete = $this->_db->delete('images_'.$feature, array('photo_title', '=', $key));
    		} 
    		} 
			
			//print $difference = array_diff_assoc($this->fhpxDbImageSelect($feature, $userid), $this->fhpxApiArray()); 
			//print_r($difference);
			// foreach($this->difference as $key => $value){
			// 	print 'this is key' . $key . 'and this is value' .$value . '<br />';
			// }


    //I SHOULD DELETE THE BELOW BECUASE I DON'T WANT TO REMOVE FROM CATGEORIES TABLE. I ACTUALLY WANT TO DELETE FROM
    //PRIMARY NAV IS THE ARRAY_INTERSECT DOESN'T CONTAIN THE VALUE.
  
		}

		return $navItems = $this->fhpxDbImageSelect($feature, $userid);
		//print_r(Fivehundredpx::fhpxNav(Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites))));
		
	}

	public function fhpxInsert($feature){
		
		//print 'HELLO' . self::$userid;
		$combined=$this->fhpxApiArray($this->fhpxApiConnect($this->fhpxEndpoint($feature)));
		//$combined=self::$fhpxApiArray(self::$fhpxApiConnect(self::$fhpxEndpoint($feature)));
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

// add something so that I can say 
// $500 = new Fivehundredpx
// Fivehundredpx::API($user)  //which gives me their api string

// so there needs to be a function in this class which connects to the db and gets the users 500px id and combines it with the private variables above
?>
