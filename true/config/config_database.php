<?php
	interface Config_database_runnable{
		public function get_db_one();
	}
	class Config_database_abstract implements Config_database_runnable{
		/**
		 * @var unknown_type
		 */
		private $db_one;	
		public  function get_db_one(){
			return $this->db_one;
		}
	}
	
	class Config_database_development extends Cofig_database{
		
		public $db_parameter_0;
		
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