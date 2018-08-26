
<?php
$error="";
$uid=$_SESSION['uid'];
$user=new User();
$result=$user->userDetails($uid);

$oldPass=$result['password'];

if(isset($_POST['btnPasswordReset'])){
	$oldPassword=$_POST['txtOldPassword'];	
	$oldPassword=md5($oldPassword); //password hash
	
	//checking current password
	if($oldPassword==$oldPass){
		$newPassword=$_POST['txtPassword'];
		$newConfPassword=$_POST['txtConfPassword'];

		//checking if new passwords match
		if($newPassword==$newConfPassword){
			$newPassword=md5($newPassword);

			//call function to change password
			$user=new User();
			$result=$user->passwordReset($newPassword,$uid);

			if($result){
				//invalid/error messages
				$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your password was reset.</div>";	

			}else{
				$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was an error. Password not changed</div>";	

			}
		}else{
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was a mismatch in your new password.</div>";	
		}
	}else{
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your current password was incorrect.</div>";
	}
}
?>

<div class="row black admin-title-container">
	Password reset
</div>
<div class="row content">
	<?php echo $error;?>

	<!-- PASSWORD RESET FORM -->
	<form class="col s12" method="POST" action="">

		<div class="input-field">
			<input name="txtOldPassword" type="password" class="validate">
			<label for="password">Current Password</label>
		</div>

		<div class="input-field">
			<input name="txtPassword" type="password" class="validate">
			<label for="password">New password</label>
		</div>

		<div class="input-field">
			<input name="txtConfPassword" type="password" class="validate">
			<label for="password">Re-enter new password</label>
		</div>
		<button name="btnPasswordReset" class="btn btn-link waves-effect waves-light right" type="submit">Reset</button>
		<a href="<?php echo $config['base_url'];?>admin_index.php?action=dashboard" class="btn btn-link waves-effect waves-light right">Back to dashboard</a>
	</form>
</div>