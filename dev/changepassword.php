<?php
//taken from https://www.youtube.com/watch?v=nhAIU-p8Tk4
require_once '_/components/php/core/init.php';

//instantiate new user and check the user is logged in.
$user=new User();

//check if the input exists
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

//check the token exists
if(Input::exists()){
	if(Token::check(Input::get('token'))){
		//validate and check values
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current'=>array(
				'required' => true,
				'min' => 6
				),
			'password_new'=>array(
				'required' => true,
				'min' => 6
				),
			'password_new_again'=>array(
				'required' => true,
				'min' => 6,
				'matches'=>'password_new'
				)
			));
		//if validation was successful change hte password otherwise loop through errors
		if($validation->passed()){

			if(Hash::make(Input::get('password_current'), $user->data()->salt)!==$user->data()->password) {
				echo 'Your current password is wrong.';
			} else {
				$salt = Hash::salt(32);
				$user->update(array(
					'password'=> Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
					));
				Session::flash('home', 'Your password has been updated');
				Redirect::to('index.php');
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
		<label for="password_current">Current Password</label>
		<input type="password" name="password_current" id="password_current">
	</div>
	<div class="field">
		<label for="password_new">New Password</label>
		<input type="password" name="password_new" id="password_new">
	</div>

	<div class="field">
		<label for="password_new_again">New Password Again</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>
	<input type="submit" value="Change">
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>