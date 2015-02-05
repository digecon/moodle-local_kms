<?php

// We defined the web service functions to install.
$functions = array(
	'local_kms_update_profile_picture' => array(
		'classname' => 'local_kms_external',
		'methodname' => 'update_profile_picture',
		'classpath' => 'local/kms/externallib.php',
		'description' => 'Update user`s profile picture',
		'type' => 'read',
	)
);

// A pre-build service is not editable by administrator.
$services = array(
	'KMS update profile picture' => array(
		'functions' => array ('local_kms_update_profile_picture'),
		'restrictedusers' => 0,
		'enabled'=>1,
	)
);