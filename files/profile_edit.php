<?php
include ("includes/session.php");
include ("includes/session_private.php");
?>
<?php
$error="";
$uid=$_REQUEST['id'];
$user=new User();
$result=$user->userDetails($uid);

$num1=rand(1,5);
$num2=rand(1,5);
$ans=$num1+$num2;
if(isset($_POST['btnEditUser'])){

	$username=$_POST['txtUsername'];
	$username=filter_var($username, FILTER_SANITIZE_STRING);

	//email sanitization
	$email=$_POST['txtEmail'];
	$email=filter_var($email, FILTER_SANITIZE_EMAIL);

	//validation of email
	if ($_POST['txtEmail']!=$email) {
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your email address contained invalid characters </div>";              
	}else{
		//for captcha
		$captcha=$_POST['numCaptcha'];
		$captchaCheck=$_POST['num1']+$_POST['num2'];

		//check captcha
		if($captcha == $captchaCheck){

			$id=$_SESSION['uid'];
			//check if username is already in use
			$chkUsername=new User();
			$resUsername=$chkUsername->availableUsername($username,$id);
			if ($resUsername==0) {

				//check if email is already in use
				$chkEmail=new User();
				$resEmail=$chkEmail->availableEmail($email,$id);

				if ($resEmail==0) {

					//user edit
					$user=new User();
					$result=$user->editUser($uid, $username, $email);
					if($result===true){
						//success
						$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your changes were saved. </div>";
						$url=$config['base_url']."admin_index.php?action=user_list";
						echo "<script>window.location='".$url."'</script>";	
					}else{
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

<div class="row black title-container">
	Edit Profile
	<p class="title-note">Change your account details!</p>
</div>
<div class="row content white content-side">
	<div  class="row">
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
</div>