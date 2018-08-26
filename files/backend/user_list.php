<div class="row black admin-title-container">
	List of users
</div>
<div class="row content">
	<table class='responsive-table'>
		<thead>
			<th>S.N</th>
			<th>Username</th>
			<th>Email</th>
			<th>Password</th>
			<th>Role</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>

		<?php
		$user=new User();
		$result=$user->listUser();
		$sn=0;
		//display details of all customer in tabular form
		if ($result!=false) {
			foreach ($result as $key => $value) {
				echo "<tr>";
				$sn++;
				echo "<td>".$sn."</td>";
				echo "<td>".$result[$key]['username']."</td>";
				echo "<td>".$result[$key]['email']."</td>";
				echo "<td>".$result[$key]['password']."</td>";
				$r="Customer";
				if($result[$key]['role']==1){
					$r="Admin";
				}
				echo "<td>".$r."</td>";
				echo "<td><a class='list-link' href='admin_index.php?action=user_edit&id=".$result[$key]['userId']."'>Edit</a></td>";
				echo "<td><a class='list-link' href='admin_index.php?action=user_delete&id=".$result[$key]['userId']."'>Delete</a></td>";
				echo "</tr>";
			}
		}
		?>
	</table>
</div>