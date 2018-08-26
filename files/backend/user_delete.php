<?php
$uid=$_REQUEST['id'];
$user=new User();
$result=$user->deleteUser($uid);
if($result){
	$url=$config['base_url']."admin_index.php?action=user_list";
	echo "<script>window.location='".$url."'</script>";	
}else{
	echo "<script>alert('We could not process your request')</script>";
}
?>