<?php
	Class True_unit_test extends True_test_case_abstract{
		
		private $begin_test_value;
		private $exit_test_value;
		
		public function begin_test(){
			$this->begin_test_value = ($begin_test="begin_test_value");
			$this->get_module()->equals($this->begin_test_value,$begin_test);
		}		
		
		public function test_equals_null(){
			$this->get_module()->equals_null(null);
		}
		public function test_equals_not_null(){
			$this->get_module()->equals_not_null("aaaa");
		}
		public function test_equals_true(){
			$this->get_module()->equals_true(true);
		}
		public function test_equals_obj(){
			$a="true";
			$this->get_module()->equals_obj($a, $a);
		}
		
		
		public function exit_test(){
			$this->exit_test_value = ($exit_test="exit_test_value");
			$this->get_module()->equals($this->exit_test_value,$exit_test);
		}
		
		
	}

?>