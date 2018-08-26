<?php
include ("includes/session.php");
include ("includes/session_private.php");
?>
<?php
$error="";
$uid=$_SESSION['uid'];
$user=new User();
$result=$user->userDetails($uid);

$oldPass=$result['password'];

if(isset($_POST['btnPasswordReset'])){
	//hash password
	$oldPassword=$_POST['txtOldPassword'];	
	$oldPassword=md5($oldPassword);
	
	//check current password for security
	if($oldPassword==$oldPass){
		$newPassword=$_POST['txtPassword'];
		$newConfPassword=$_POST['txtConfPassword'];

		//check if new passwords match
		if($newPassword==$newConfPassword){
			$newPassword=md5($newPassword);
			//password reset function
			$user=new User();
			$result=$user->passwordReset($newPassword,$uid);
			if($result){
				//success
				$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your password was reset.</div>";	
			}else{
				//error messages
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
<div class="row content content-side">
	<?php echo $error;?>
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
		<button name="btnPasswordReset" class="btn btn-black btn-link waves-effect waves-light right" type="submit">Reset</button>
		<a href="<?php echo $config['base_url'];?>index.php?action=profile" class="btn btn-black btn-link waves-effect waves-light right">Back to dashboard</a>
	</form>
</div>