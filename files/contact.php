<?php
$error="";
if(isset($_POST['btnContact'])){

	$to = "shahdilasha@gmail.com";
	//sanitize email
	$from=$_POST['txtEmail'];
	$from=filter_var($from, FILTER_SANITIZE_EMAIL);

	//email valid check
	if ($from != $_POST['txtEmail']) {
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Error! Your email address contained invalid characters.</div>";
	}else{
		$subject="Email from customer";

		$message=$_POST['taMessage'];
		$message=filter_var($message, FILTER_SANITIZE_STRING);

		$header = "From: " .$from."\r\n";

		//using PHP MAIL function
		//only runs when a the website is hosted
		//SMTP server required
		if(mail($to, $subject, $message, $header)) {
			$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your message was sent in an email. </div>";

			$confirmTo=$from;
			$confirmFrom=$to;
			$confirmSubject="Email recieved";
			$confirmMessage= "Your message has been sent to SUGARDUSTED.COM";
			$confirmHeader = "From: " .$confirmFrom."\r\n";

			//mail sent notification sent to user's email
			if(mail($confirmTo, $confirmSubject, $confirmMessage, $confirmHeader)) {

			}else{

			}
		} else {
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Error! Your message was not sent. </div>";
		}
	}
}
?>
<div class="container">
	<div class="row black title-container">
		Contact us
		<p class="title-note">For inquiries email us at OR fill up the form below and send us a message!</p>
	</div>
	<div class="row content white content-side">

		<?php echo $error; ?>
		<form class="col s12" method="post" action="">
			<div class="row">
				<div class="input-field col s12">
					<input name="txtEmail" id="email" type="email" class="validate" required="" aria-required="true">
					<label for="email" data-error="Please enter a valid email address.">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<textarea name="taMessage" id="textarea1" class="validate materialize-textarea"  required="" aria-required="true"></textarea>
					<label  data-error="Invalid" for="textarea1">Message</label>
				</div>
			</div>
			<div class="input-field">
				<button name="btnContact" class="btn btn-black waves-effect waves-light-2 right" onclick="" type="submit">Send Message
				</button>
			</div>
		</form>
	</div>
</div>
