<?php
	
	interface Config_database{
		public static function get_db_one();
	}
	
	class Config_database_development extends Cofig_database{
		
		public static function get_db_one(){
			$db_parameter_0=new DatabaseParameter(
					"localhost",
					"root",
					"sohara",
					"slc",
					"utf8");
		}
		
	}

?>