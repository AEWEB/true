<?php
	define("true_unit_config_file","./config_true_unit.php");
	require_once true_unit_config_file;	
	require_once Config_true_unit::main_path."true_unit.php";
	$test=new True_test_module(Config_true_unit::get_test_list());
	$test->output_info();
?>