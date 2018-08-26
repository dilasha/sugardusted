<?php
//redirects user to another page
//restricted access
$url=$config['base_url'];
if(isset($_SESSION['uid'])){
	if($_SESSION['role'] == 1){
	}else{
		echo "<script>window.location='".$url."'</script>";
	}
}else{
	echo "<script>window.location='".$url."'</script>";
}
?>