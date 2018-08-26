<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

include ("config/config.php");
include ("autoload.php");
include ("includes/admin_session.php");
include ("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset= UTF-8 />
	<title>Administrator - Sugardusted</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $config["base_url"]; ?>assets/css/materialize.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $config["base_url"]; ?>assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $config["base_url"]; ?>assets/css/admin_style.css" />
	<link rel="stylesheet" href="<?php echo $config["base_url"]; ?>assets/font/font-awesome-4.4.0/css/font-awesome.min.css" />

	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/materialize.min.js"></script>  
	<script type="text/javascript" src="<?php echo $config["base_url"]; ?>assets/js/jquery.validate.min.js"></script> 
</head>
<body>
	<?php
	include ("includes/admin_header.php");
	?>
	<div class="row">
		<div class="col s2 hide-on-med-and-down">empty</div>
		<div class="col s10">
			<div class="admin-container">
			<!-- actions -->
				<?php
				if (isset($_GET['action']) && !empty($_GET['action'])){
					$file="files/backend/".$_GET['action'].".php";
					if(file_exists($file)){
						include ($file);
					}else{
						include ("files/backend/dashboard.php");
					}
				}
				?>
			</div>
		</div>
	</div>

	<?php
	include ("includes/admin_footer.php");
	?>
</body>	
</html>