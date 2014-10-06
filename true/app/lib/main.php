<?php
	/**
	 * Redefinition of the Exception.
	 * Handle the exception handling of all.
	 */
	class MyException extends Exception{
		public function __construct($errno, $errstr, $errfile, $errline){
			$errlev = array(
				E_USER_ERROR   => 'FATAL',
				E_ERROR        => 'FATAL',
				E_USER_WARNING => 'WARNING',
				E_WARNING      => 'WARNING',
				E_USER_NOTICE  => 'NOTICE',
				E_NOTICE       => 'NOTICE',
				E_STRICT       => 'E_STRICT'
			);
			$add_msg= (string)$errno;
			if (isset($errlev[$errno])) {
				$add_msg = $errlev[$errno] . ' : ';
			}
			parent::__construct($add_msg . $errstr, $errno);
			$this->file = $errfile;
			$this->line = $errline;
		}
	}
	function errorHandler ($errno, $errstr, $errfile, $errline){
		throw new MyException($errno, $errstr, $errfile, $errline);
	}
	set_error_handler("errorHandler");
	
	/**
	 * database parameter
	 */
	class DatabaseParameter{
		/**
		 * @var String
		 */
		public $serverName;
		/**
		 * @var String
		 */
		public $userName;
		/**
		 * @var String
		 */
		public $password;
		/**
		 * @var String
		 */
		public $dbName;
		/**
		 * @var String
		 */
		public $caracterCode;
	}
	/**
	 * Interface for connecting to the controller from DB.
	 */
	interface DBController{
		/**
		 * Notify query error.
		 * @param string $error
		 * @param string $query
		 * @return void
		 */
		public function queryError($error,$query);
	}
	
?>