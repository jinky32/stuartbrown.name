<?php
	//based on video at https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
	require_once '_/components/php/core/init.php';
	
	if(Input::exists()){//check that something has been submitted
		if(Token::check(Input::get('token'))){//validate the token
			//validate the form using hte Validate class
			$validate=new Validate();
			$validation = $validate->check($_POST,array(
				'username'=>array('required'=>true),
				'password'=>array('required'=>true)
			));

			if($validation->passed()){
				//instantiate new user
				$user = new User();
				//create login var and pass the username form teh form via nput Class to the login method
				$login=$user->login(Input::get('username'), Input::get('password'));
			
				if($login){
					echo 'success!';
				} else {
					echo '<p>sorry login failed</p>';
				}

			} else {
				foreach ($validation->errors() as $error) {
					echo $error, '<br />';
				}
			}
		}
		
	}
?>

<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" autocomplete="off">
	</div>
	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" autocomplete="off">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" value="log in">
</form>