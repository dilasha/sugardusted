<?php
//users are not allowed to view/manage/access profiles of other users
$url=$config['base_url'];
if (isset($_SESSION['uid'])) {
	if ($_SESSION['role']==0) {
		if (isset($_REQUEST['id'])) {
			if ($_SESSION['uid']==$_REQUEST['id']) {

			}else{
				//echo "stops here";
				echo "<script>window.location='".$url."'</script>";
			}
		}
	}
}
?>