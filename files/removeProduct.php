<?php
include ("includes/session.php");
?>
<?php
$pid=$_REQUEST['id'];
$uid=$_SESSION['uid'];
$prodList=new ProductList();
$result=$prodList->remove($pid, $uid);
?>