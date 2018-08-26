<?php
//magic function
	function __autoload($className){
		if(file_exists("classes/".$className.".php")){
			require_once("classes/".$className.".php");
		}else{
			throw new Exception("Cannot load class ".$className.".");
		}
	}
?>