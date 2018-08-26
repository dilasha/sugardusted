<?php
//controlled access
$url=$config['base_url'];
if(!isset($_SESSION['uid'])){
	echo "<script>window.location='".$url."'</script>";
}else{
}
?>