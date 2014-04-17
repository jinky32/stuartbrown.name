<?php

// taken from https://www.youtube.com/watch?v=KL4oviBqnQk

require_once '_/components/php/core/init.php';

//instantiate a new user - from this you can tell if they are logged in or not
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

if(Input::exists()){

	if(Token::check(Input::get('token'))){

$validate = new Validate();  //instantiate an instance of the class
		$validation=$validate->check($_POST, array( //check the values
			//set the requirements for each feld on the forms.  names (eg 'username') must match the name of the input name of the field of the form
			//these values are checked in the check method of the Validate class (validate.php)
			'name' => array(
				'required'=> true,
				'min'=>2,
				'max'=>50
				),
			'youtube' => array(
				'required'=> true
				)
			));


		if($validation->passed()) {

			try {
				$user->update(array(
					'name'=>Input::get('name'),
					'youtube'=>Input::get('youtube'),
					'fivehundredpx'=>Input::get('500px')
					));

				//session flash taken from https://www.youtube.com/watch?v=KL4oviBqnQk
				Session::flash('home', 'Your details have been updated');
				Redirect::to('index.php');

			} catch(Exception $e) {
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

<form action="" method="post">
	<div class="field">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?php echo escape($user->data()->name);?>">
		<label for="name">Youtube</label>
		<input type="text" name="youtube" value="<?php echo escape($user->data()->youtube);?>">
		<label for="name">500px</label>
		<input type="text" name="500px" value="<?php echo escape($user->data()->fivehundredpx);?>">
		<input type="submit" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>