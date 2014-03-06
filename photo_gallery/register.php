<?php

require_once '_/components/php/core/init.php';

if(Input::exists()){
	if(var_dump(Token::check(Input::get('token')))){

		echo 'I have been run';

		$validate = new Validate();  //instantiate an instance of the class
		$validation=$validate->check($_POST, array( //check the values
			//set the requirements for each feld on the forms.  names (eg 'username') must match the name of the input name of the field of the form
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
				)
			));

		if($validation->passed()){
			echo 'passed';
		} else {
			print_r($validation->errors());
		}
	}
}

?>
<!--form mostly based on https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc-->
<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off">
	</form>
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
	<input type="hidden" name="token" value="<?php echo Token::generate();?>"/>
	<input type="submit" value="Register">

</form>
