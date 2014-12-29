<?php
function local_kms_extends_navigation(global_navigation $nav) {
	
	$config_file = __DIR__."/config.php";
	
	if(false == file_exists($config_file))
	{
		return;
	}
	
	$config = include $config_file;
	
	$navigation_node = new navigation_node(array(
		"text" => get_string("kms","local_kms"),
		"action" => $config['url']
	));
	
	$nav->add_node($navigation_node, 0);
}
