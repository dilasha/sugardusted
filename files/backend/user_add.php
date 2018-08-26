<?php
$error="";

if(isset($_POST['btnUserAdd'])){
	$username=$_POST['txtUsername'];
	$username=filter_var($username, FILTER_SANITIZE_STRING);

	//sanitize email
	$email=$_POST['txtEmail'];
	$email=filter_var($email, FILTER_SANITIZE_EMAIL);

	if ($_POST['txtEmail']!=$email) {
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your email address contained invalid characters </div>";              
	}else{
		//hash passwords
		$password=$_POST['txtPassword'];
		$password=md5($password);

		$confPassword=$_POST['txtConfPassword'];
		$confPassword=md5($confPassword);

		$role=0;

		//check if user entered username already in use
		$chkUsername=new User();
		$resUsername=$chkUsername->availableUsername($username,0);
		if ($resUsername==0) {
			//check if user entered email is already in use
			$chkEmail=new User();
			$resEmail=$chkEmail->availableEmail($email,0);

			if ($resEmail==0) {
				//check for password mismatch
				if($password==$confPassword){

					$user=new User();
					$result=$user->register($username, $email, $password, $role);
					if($result===true){
						//success
						$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your account was created. </div>";
					}else{
						//error messages
						$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! some thing went wrong. </div>";
					}
					
				}else{
					$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was a password mismatch.</div>"; 
				}
			}else{    
				$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That email is already taken.</div>"; 
			}
		}else{
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That username is already taken.</div>"; 
		}
	}
}
?>

<div class="row black admin-title-container">
	Add user
</div>
<div class="row content">
	<?php echo $error;?>
	<form class="col s12" method="POST" action="">
		<div class="input-field">
			<input name="txtUsername" type="text" class="validate">
			<label for="username">Username</label>
		</div>
		<div class="input-field">
			<input name="txtEmail" type="email" class="validate">
			<label for="email">Email</label>
		</div>
		<div class="input-field">

			<input name="txtPassword" type="password" class="validate">
			<label for="password">Password</label>
		</div>
		<div class="input-field">
			<input name="txtConfPassword" type="password" class="validate">
			<label for="password">Confirm Password</label>
		</div>
		<div class="role">  
			<label class="left">Role</label>  
			<p>
				<input class="with-gap" name="chkRole" type="radio" checked value=0 id="test2" />
				<label for="test2">Customer</label>
			</p>
			<p>
				<input class="with-gap" name="chkRole" type="radio" value=1 id="test3"  />
				<label for="test3">Admin</label>
			</p>
			
		</div>
		<div class="input-field">
			<button name="btnUserAdd" class="btn waves-effect waves-light right" type="submit">Add user</button>
		</div>
	</form>
</div>
