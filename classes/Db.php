<?php
	class Db{
		private static $connection;
		//database connection
		public static function connect(){
			if(!isset(self::$connection)){
				global $config;
				//connection establish
				self::$connection= new mysqli($config['host'],$config['username'],$config['password'],$config['db']);
			}
			if(self::$connection===false){
				return false;
			}
			return self::$connection;
		}
	}
?>