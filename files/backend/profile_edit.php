<?php
$error="";
$uid=$_REQUEST['id'];
$user=new User();
$result=$user->userDetails($uid);

//random number generation for captcha
$num1=rand(1,5);
$num2=rand(1,5);
$ans=$num1+$num2;

if(isset($_POST['btnEditUser'])){
	$username=$_POST['txtUsername'];
	$email=$_POST['txtEmail'];

	//display captcha
	$captcha=$_POST['numCaptcha'];
	$captchaCheck=$_POST['num1']+$_POST['num2'];

	//check captcha
	if($captcha == $captchaCheck){
		$user=new User();
		$result=$user->editUser($uid, $username, $email);
		if($result===true){
			//redirect if updated
			$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your changes were saved. </div>";
			$url=$config['base_url']."admin_index.php?action=user_list";
			echo "<script>window.location='".$url."'</script>";	
		}else{
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your changes were not saved. </div>";
		}
	}else{
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! You entered the wrong captcha.</div>";     
	}
}
?>
<div class="row black admin-title-container">
	Edit user
</div>
<div  class="row content">
	<?php echo $error;?>
	<form class="col s12" method="POST" action="">
		<div class="input-field">
			<input name="txtUsername" value="<?php echo $result['username']; ?>" type="text" class="validate">
			<label for="username">Username</label>
		</div>
		<div class="input-field">
			<input name="txtEmail" type="email" value="<?php echo $result['email']; ?>" class="validate">
			<label for="email">Email</label>
		</div>
		<p class="captcha">
			<?php
			echo $num1." + ".$num2." = ?";
			?>
		</p>
		<div class="input-field row">
			<input id="numCaptcha" name="numCaptcha" type="number" class="validate" required>
			<input name="num1" value="<?php echo $num1;?>" type="number" hidden required>
			<input name="num2" value="<?php echo $num2;?>" type="number" hidden required>
			<label for="number">Solve the equation. Prove you are not a robot.</label>
		</div>

		<div class="input-field row">
			<div class="right">
				<a class="btn waves-effect waves-light" href="<?php echo $config['base_url'];?>admin_index.php?action=user_list">Cancel</a>
				<button name="btnEditUser" class="btn waves-effect waves-light" type="submit">Save changes
				</button>
			</div>
		</div>
	</form>
</div>
