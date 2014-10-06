<?php
	/**
	 * Interface to the test case.
	 */
	interface True_test_case_runnable{
		/**
		* @return void
		 */
		public function begin_test();
		/**
		 * To Execute at the end of the test.
	 	* @return void
		 */
		public function exit_test();
	
	}
	
	/**
	 * Interface to the unit test class.
	 */
	interface True_test_module_runnable{
		/**
		 * Check for equal.
		 * @param string $str
		 * @param string $correct　Value for objective.
		 * @return void
		 */
		public function equals($str,$correct) ;
		/**
		 * Check for null.
		 * @param mixed $object
		 * @return void
		 */
		public function equals_null($object);
		/**
		 * @param mixed $object
		 */
		public function equals_not_null($object);
		/**
		 * Check for true.
		 * @param bool $bool
		 * @return void
		 */
		public function equals_true($bool);
		/**
		 * Check for it's same object.
		 * @param mixed $obj
		 * @param mixed $obj2
		 * @return void
		 */
		public function equals_obj($obj,$obj2);
		/**
		 * Output info.
		 * @return void
		 */
		public function output_info();
	}

	/**
	 * Class of tastCase.
	 */
	abstract class True_test_case_abstract implements True_test_case_runnable{
		/**
		 * @var True_test_module_runnable
		 */
		 private $module;
		
		
		/**
		 * @param True_test_module_runnable $module
		 */
		public function  True_test_case_abstract($module){
			$this->module=$module;
	
		}
		/**
		* @return void
		 */
		public function begin_test(){}
		/**
		 * To Execute at the end of the test.
	 	* @return void
		 */
		public function exit_test(){}
	
		/**
		 * Get the controler.
		 * @return True_test_module_runnable
		 */
		protected function get_module(){
			return $this->module;
		}
	
	}
	/**
	 *Class for unit test.
	 */
	class True_test_module implements True_test_module_runnable{
		/**
		 * List for class to test.
		 * @var string[]
		 */
		private $test_case_list;
		/**
		 * List for storing the output information.
		 * @var string[]
		 */
		private $output_info_list=array();
		/**
		 * First character for method to be test.
		 * @var string
		 */
		const first_character_for_method="/^test/";
		 
		/**
		 * Constructor
		 * @param string[] $testClassList List for class to test.
		 */
		public function True_test_module($test_case_list){
			$this->test_case_list=$test_case_list;
			$this->init();
		}
		/**
		 * Initialization.
		 * @return void
		 */
		protected function init() {
			$list=$this->get_test_case_list();
			for($i=0;$i<count($list);$i++){
				require_once Config_true_unit::get_path(Config_true_unit::test_cases_path).($run_test=$list[$i].Config_true_unit::test_class_index).Config_true_unit::file_extension;
				$this->run(new $run_test($this));
			}
		}
		/**
		 * Get list for test case.
		 * @return string[]
		 */
		protected function get_test_case_list(){
			return $this->test_case_list;
		}
		/**
		 * Run the test.
		 * @param True_test_case_runnable $testCase
		 * @return void
		 */
		protected function run($testCase){
			$testCase->begin_test();
			$methods=get_class_methods($testCase);
			for($i=0;$i<count($methods);$i++){
				if(preg_match(self::first_character_for_method,$methods[$i])){
					call_user_func_array(array($testCase,$methods[$i]),array());
				}
			}
			$testCase->exit_test();
		}
		/**
		 * Output error.
		 * @param mixed $str Error target.
		 * @param String[] $trace0 0th array of it's got from debug_backtrace. debug_backtraceから得た配列
		 * @param String[] $trace1 1th array of get from debug_backtrace. debug_backtraceから得た配列
		 */
		protected function output_error($str,$correct,$trace0,$trace1) {
			$this->output_info();
			print("<p style='background-color:#ff4444'>---------- 【error】----------</p>".
					"【value】　：　".$str.
					"<br/>【corrent】　：　".$correct.
					"<br/>【file】　　　　：　".$trace0["file"].
					"<br/>【line】　　　　：　".$trace0["line"].
					"<br/>【class】　　　：　".$trace1["class"].
					"<br/>【function】　:　".$trace1["function"]."<br/>" );
			exit();
		}
		/**
		 * Success output.
		 * @param mixed $str Success value.
		 * @param string[] $trace1 1th array of get from debug_backtrace. debug_backtraceから得た配列
		 */
		protected function add_output_list($str,$trace1) {
			$this->output_info_list[] = "<p style='background-color:#00FF99'>---------- 【success】----------</p>".
				"【value】　：　".$str.
				"<br/>【method】　：　".$trace1["function"]."<br/>";
		}
		/**
		 * Get output list.
		 * @return string[]
		 */
		protected function get_out_put_list(){
			return $this->output_info_list;
		}
		 
		/**
		 * implements Lf_testRunnable
		 */
		/**
		 * Check for equal.
		 * @param string $str value.
		 * @param string $correct　Value for objective.
		 * @return void
		 */
		public function equals($str,$correct){
			$backtraces = debug_backtrace();
			if($str!==$correct){				
				$this->output_error($str, $correct, $backtraces[0],$backtraces[1]);
			}
			$this->add_output_list($str, $backtraces[1]);
		}
		/**
		 * Check for null.
		 * @param mixed $object
		 * @return void
		 */
		public function equals_null($object){
			if($object!==null){
				$backtraces = debug_backtrace();
				$this->output_error("Object is not NULL", print_r($object,true), 
					$backtraces[0], $backtraces[1]);
			}
			$backtraces = debug_backtrace();
			$this->add_output_list("Object NULL", $backtraces[1]);
		}
		/**
		 * @param mixed $object
		 */
		public function equals_not_null($object){
			if($object===null){
				$backtraces = debug_backtrace();
				$this->output_error("Object is NULL","NULL",$backtraces[0], $backtraces[1]);
			}
			$backtraces = debug_backtrace();
			$this->add_output_list("Object not null", $backtraces[1]);
		}
	
		/**
		 * Check for true.
		 * @param bool $bool
		 * @return void
		 */
		public function equals_true($bool){
			if(!$bool){//If false.
				$backtraces = debug_backtrace();
				$this->output_error("false", $bool, $backtraces[0], $backtraces[1]);
			}
			$backtraces = debug_backtrace();
			$this->add_output_list("true", $backtraces[1]);
		}
		/**
		 * Check for it's same object.
		 * @param mixed $obj
		 * @param mixed $obj2
		 * @return void
		 */
		public function equals_obj($obj,$obj2){	
			if($obj!==$obj2){
				$backtraces = debug_backtrace();
				$this->output_error(print_r($obj,true),print_r($obj2,true),
						$backtraces[0],$backtraces[1]);
			}
			$backtraces = debug_backtrace();
			$this->add_output_list("Object True", $backtraces[1]);
		}
		/**
		 * Output info.
		 * @return void
		 */
		public function output_info(){//output info.情報を出力
			$list=$this->get_out_put_list();
			for($i=0;$i<count($list);$i++){
				print($list[$i]);
			}
		}
		 
	}
	
	
	
	

?>