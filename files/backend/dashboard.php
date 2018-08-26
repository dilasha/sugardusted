<div class="row black admin-title-container">
	Dashboard
</div>
<div class="row content">
	Welcome to the dashboard, <?php echo $_SESSION['user'] ?> !
</div>
<div class="row black admin-title-container">
	Your Account
</div>
<div class="row content">
	<table class="bordered">
		<?php
			//retrieving details of current user

			$uid=$_SESSION['uid'];

			$user=new User();
			$result=$user->userDetails($uid);
		?>
		<!-- displaying details of current user -->
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
	<div class="input-field row">
		<div class="right">
			<a class="btn btn-link waves-effect waves-light right z-index-1 rose" href="<?php echo $config['base_url'];?>admin_index.php?action=profile_edit&id=<?php echo $_SESSION['uid']; ?>">Edit details</a>
			
			<a class="btn btn-link waves-effect waves-light right z-index-1 rose" href="<?php echo $config['base_url'];?>admin_index.php?action=password_reset&id=<?php echo $_SESSION['uid']; ?>">Password reset</a>

		</div>
		
	</div>
</div>