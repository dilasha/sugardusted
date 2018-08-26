<?php
include ("includes/session.php");
include ("includes/session_private.php");
?>
<div class="container">
	<div class="row black title-container">
		Profile
		<p class="title-note">Welcome to your account!</p>
	</div>
	<div class="row content white content-side">
		<table class="bordered">
			<?php
			$uid=$_SESSION['uid'];
			$user=new User();
			$result=$user->userDetails($uid);
			?>
			<tr>
				<th>Username</th>
				<td><?php echo $result['username']; ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $result['email']; ?></td>
			</tr>
			<tr>
				<th>Password</th>
				<td>- - Censored for your security - -</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>
					<?php
					if($result['role']==1){
						echo "Admin";
					}else{
						echo "Customer";
					}
					?>
				</td>
			</tr>
		</table>
		<div class="input-field">
			<a class="btn btn-black btn-link waves-effect waves-light right z-index-1 rose" href="<?php echo $config['base_url'];?>index.php?action=password_reset&id=<?php echo $_SESSION['uid']; ?>">Password reset</a>

			<a class="btn btn-black waves-effect waves-light right z-index-1 rose" href="<?php echo $config['base_url'];?>?action=profile_edit&id=<?php echo $_SESSION['uid']; ?>">Edit details</a>
		</div>
	</div>
</div>
