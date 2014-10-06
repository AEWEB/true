<?php
	class Config_app{
		/**
		 *  core part.
		 */
			// mail address for system.
			const system_mail_add = "sohara_contact9022@jcom.home.ne.jp";
			// application name
			const application_name = "True";
			// character
			const character = "UTF-8";
			// cookie params.
			const cookie_params = "/";
			// cookie params from ssl.
			const ssl_cookie_params = "/";
		
		/**
		 * resource
		 */
			// menu bar for file
			const default_menu = "menu.php";
			
		/**
		 * init
		 */
			/**
			 * @return void
			 */
			public static function init_php(){
				date_default_timezone_set('Asia/Tokyo');
				ini_set('session.gc_maxlifetime', '1800');
				ini_set('session.gc_probability','1');
				ini_set('session.gc_divisor', '100');
				ini_set('session.save_path',Const_app::get_path(Main_app::resource).'session');
				ini_set( 'display_errors' , 1 );
			}
			
		
		/**
		 * setup server.
		 */
			
			/**
			 * @return string
			 */
			public static function get_host(){
				return "http://".$_SERVER['HTTP_HOST']."/";
			}
			/**
			 * @return string
			 */
			public static function get_host_ssl(){
				return "https://".$_SERVER['HTTP_HOST']."/";
			}
			/**
			 * @return boolean true=>ssl
			 */
			public static function is_ssl(){//breaks
				//	return self::$ssl;
				//if (isset($_SERVER['HTTP_VIA'])&&strpos($_SERVER['HTTP_VIA'], 'ss1.coressl.jp:3128') !== false ) {
				if ( (false === empty($_SERVER['HTTPS']))&&('off' !== $_SERVER['HTTPS']) ) {
					return true;
				}
				return false;
			}
			
			
	}

?>