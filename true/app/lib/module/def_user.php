<?php
	interface Config_def_user{
		/**
		 * setting
		 */
			/**
			 * Restriction value for login.
			 */
			const restrictionLoginValue="5";
			/**
			 * usual registered career id.
			 * 通常の登録キャリア
			 * var string
			 */
			const usualCareer_id="0";
			/**
			 * usual restriction value.
			 * 通常の制限値
			 * @var　string
			 */
			const usualRestriction  = "0";
			/**
			 * Avatar for default	
			 * デフォルトのアバター
			 * @var string
			 */
			const defaultImage="default.png";
		
		/**
		 * session
		 */
			/**
			 * Security time.
			 */
			const securityTime="5 minute";
			/**
			 * index for user session.
			 */
			const userSessionIndex="slUser_index";
			/**
			 * security key.
			 */
			const fingerprint="slupFinger";	
			/**
			 * index for session variable.
			 */
			const fingerPrintIndex="slUser_finger";
		
		
	}


	class Def_user{
		
		
	}
?>