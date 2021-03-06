<?php

require_once '_/components/php/core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){

		//echo 'I have been run';

		$validate = new Validate();  //instantiate an instance of the class
		$validation=$validate->check($_POST, array( //check the values
			//set the requirements for each feld on the forms.  names (eg 'username') must match the name of the input name of the field of the form
			//these values are checked in the check method of the Validate class (validate.php)
			'username'=> array(
				'required'=> true,
				'min' => 2,
				'max' =>20,
				'unique'=>'users'
				),
			'password' => array(
				'required' => true,
				'min' => 6
				),
			'password_again'=> array(
				'required'=> true,
				'matches' => 'password'
				),
			'name' => array(
				'required'=> true,
				'min'=>2,
				'max'=>50
				),
			//I don't think YT nad 500px should be required but below is just testing
			'youtube'=>array(
				'required'=>true
				),
			'500px'=>array(
				'required'=>true
				)
			));

		if($validation->passed()){
			$user=new User();

			$salt = Hash::salt(32);

			try { //use the create method of the User class
				$user->create(array(
				
					// 'youtube' => Input::get('youtube'),
					// '500px' => Input::get('500px'),
					// 'group' => 1	
					'username' => Input::get('username'),
					'name'=>Input::get('name'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,		
					'joined' => date('Y-m-d H:i:s'),
					'youtube'=>Input::get('youtube'),
					'fivehundredpx'=>Input::get('500px'),
					'fivehundredpxconsumerkey' => Input::get('500px_consumerkey'),
					'group' => 1	
					));

				Session::flash('home','You have been registered and can now log in');
				Redirect::to('index.php'); //based on video at https://www.youtube.com/watch?v=VEzJHww-QwM

			} catch (Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br />';
			}
		}
	}
}

?>
<!--form mostly based on https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc-->
<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off">

	<div>

	<div class="field">
		<label for="password">Choose a password</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password_again">Choose a password</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<div class="field">
		<label for="name">Enter your name</label>
		<input type="text" name="name" value="<?php echo escape(Input::get('name'))?>" id="name">
	</div>
	<div class="field">
		<label for="youtube">Enter your YouTube username</label>
		<input type="text" name="youtube" id="youtube">
	</div>
	<div class="field">
		<label for="500px">Enter your 500px username</label>
		<input type="text" name="500px" id="500px">
	</div>
	<div class="field">
		<label for="500px_consumerkey">Enter your 500px consumer key</label>
		<input type="text" name="500px_consumerkey" id="500px_consumerkey">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>"/> <!--this generates a token used by Token class token.php-->
	<input type="submit" value="Register">

</form>