<?php
	class Config_true_unit{	
		
		/**
		 * path for test case.
		 */
		const test_cases_path = "test_cases/";
		const main_path = "./";
		
		const test_class_index = "_test";
		const file_extension = ".php";
		
		
		public static function get_test_list(){
			return array("True_unit");
		}
		
		public static function get_path($path){
			return self::main_path.$path;
		}
	}
?>