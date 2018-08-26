<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

include ("config/config.php");
include ("autoload.php");
include ("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset= UTF-8 />
	<title>Sugardusted - Cakes, Cookies, More</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $config["base_url"]; ?>assets/css/materialize.min.css" />
	<!--<link rel="stylesheet" href="<?php echo $config["base_url"]; ?>assets/css/materialdesignicons.min.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo $config["base_url"]; ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?php echo $config["base_url"]; ?>assets/font/font-awesome-4.4.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />


	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/materialize.min.js"></script>  
	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/jquery.validate.min.js"></script> 
</head>
<body>
	<?php
	include ("includes/header.php");
	?>
	<?php
	//action requested
	if (isset($_GET['action']) && !empty($_GET['action'])){
		$file="files/".$_GET['action'].".php";
						//var_dump(file_exists($file));die;
		if(file_exists($file)){
			include ($file);
		}else{
			include ("files/home.php");
		}
	}else{
		include ("files/home.php");
	}
	?>
	<?php
	if (isset($_GET['action']) && !empty($_GET['action'])){
		if ($_GET['action']=="home") {		
		}else{
		include ("includes/footer.php");
		}
	}else{
	}
	?>
</body>	
</html>