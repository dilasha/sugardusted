<?php
$pid=$_REQUEST['id'];
$product=new Product();
$result=$product->deleteProduct($pid);
if($result===true){
	$url=$config['base_url']."admin_index.php?action=product_list";
	echo "<script>window.location='".$url."'</script>";	
}
?>