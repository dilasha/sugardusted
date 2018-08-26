
<?php
$error="";
$uid=$_REQUEST['id'];
$user=new User();
$result=$user->userDetails($uid);

//random num for captcha
$num1=rand(1,5);
$num2=rand(1,5);
$ans=$num1+$num2;

if(isset($_POST['btnEditUser'])){
	$username=$_POST['txtUsername'];	
	$username=filter_var($username, FILTER_SANITIZE_STRING);

	//filter/validate/saintize email
	$email=$_POST['txtEmail'];
	$email=filter_var($email, FILTER_SANITIZE_EMAIL);
	if ($_POST['txtEmail']!=$email) {
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your email address contained invalid characters </div>";              
	}else{

		//fr captcha
		$captcha=$_POST['numCaptcha'];
		$captchaCheck=$_POST['num1']+$_POST['num2'];

		//check captcha
		if($captcha == $captchaCheck){
			//check if username is available
			$chkUsername=new User();
			$resUsername=$chkUsername->availableUsername($username,$uid);
			if ($resUsername==0) {
				//check if email is available
				$chkEmail=new User();
				$resEmail=$chkEmail->availableEmail($email,$uid);

				if ($resEmail==0) {
					//edit data
					$user=new User();
					$result=$user->editUser($uid, $username, $email);
					if($result===true){
						//success
						$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your changes were saved. </div>";
						$url=$config['base_url']."admin_index.php?action=user_list";
						echo "<script>window.location='".$url."'</script>";	
					}else{
						//error messages
						$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your changes were not saved. </div>";
					}
				}else{    
					$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That email is already taken.</div>"; 
				}
			}else{
				$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That username is already taken.</div>"; 
			}
		}else{
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! You entered the wrong captcha.</div>";     
		}
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
				<a class="btn btn-link waves-effect waves-light" href="<?php echo $config['base_url'];?>admin_index.php?action=user_list">Cancel</a>
				<button name="btnEditUser" class="btn btn-link waves-effect waves-light" type="submit">Save changes
				</button>
			</div>
		</div>
	</form>
</div>
