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
				)
			));


		if($validation->passed()) {
					
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
		<input type="submit" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>