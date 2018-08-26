<?php
if(isset($_SESSION['uid'])){	
	$url=$config['base_url']."index.php?action=profile";
	echo "<script>window.location='".$url."'</script>";
}

$error="";

//random number for captcha
$num1=rand(1,5);
$num2=rand(1,5);
$ans=$num1+$num2;

if(isset($_POST['btnLogin'])){
	$email=$_POST['txtEmail'];

	$password=$_POST['txtPassword'];
	$password=md5($password);

	//check if user is admin
	$role=0;
	if(isset($_POST['chkAdmin'])){
		$role=1;
	}

	//captcha
	$captcha=$_POST['numCaptcha'];
	$captchaCheck=$_POST['num1']+$_POST['num2'];

	//check captcha
	if($captcha == $captchaCheck){

		//call login function
		$user=new User();
		$result=$user->login($email, $password, $role);

		if($result === "true"){
			$error="";
		}else{
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your login credentials were incorrect. </div>";		
		}
	}else{
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! You entered the wrong captcha. </div>";		
	}
}
?>

<div class="row black title-container">
	Login
	<p class="title-note">Sign into your profile!</p>
</div>
<div class="row content white content-side">
	<div class="row">
		<?php echo $error;?>
		<form id="loginForm" class="col s12" method="POST" action="">
			<div class="input-field">
				<input name="txtEmail" type="email" class="validate" required>
				<label for="email">Email</label>
			</div>
			<div class="input-field">
				<input name="txtPassword" type="password" class="validate" required>
				<label for="password">Password</label>
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
			
			<div class="input-field">
				<p>
					<input type="checkbox" name="chkAdmin" value="1" id="test6" />
					<label for="test6">I am an administrator</label>
				</p>
			</div>
			<div class="input-field">

				<button id="bLogin" name="btnLogin" class="btn btn-black waves-effect waves-light-2 right" type="submit">Sign in
				</button>
			</div>
		</form>
	</div>
</div>
