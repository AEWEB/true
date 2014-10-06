<?php
	class Const_app{
		/**
		 * path.
		 */
		const lib="lib/";
		const app="app/";
		const resource="resource/";
		const config="config/";
		const view="view/";
		const model="model";
		
		
		
		/**
		 * @return string
		 */
		public static function get_app_home(){
			return appHome;
		}
		/**
		 * @param String $path
		 * @return String
		 */
		public static function get_path($path){
			return static::get_app_home().$path;
		}
		
		
		/**
		 * @param String[] $list
		 * @return String
		 */
		public static function includeModel($list){
			for($i=0;$i<count($list);$i++){
				require_once static::get_path(self::model).$list[$i].".php";
			}
		}
	}


?>