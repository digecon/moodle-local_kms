<?php

/**
* KMS external web services
*
* @package KMS
* @copyright 2014 miptcloud.com
* @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/
require_once($CFG->libdir . "/externallib.php");
class local_kms_external extends external_api {
	
	/**
	* Returns description of method parameters
	* @return external_function_parameters
	*/
	public static function update_profile_picture_parameters() 
	{
		return new external_function_parameters(
			array('email' => new external_value(PARAM_EMAIL, 'User`s email')),
			array('picture' => new external_value(PARAM_FILE, 'New user`s picture'))
		);		
	}
	
	/**
	* Returns welcome message
	* @return string welcome message
	*/
	public static function update_profile_picture($email, $picture) {
		
		global $USER, $DB;
		
		//Parameter validation
		$params = self::validate_parameters(self::update_profile_picture_parameters(),
		array('email' => $email,'picture' => $picture));
		
		$user = $DB->get_record('user', array('email' => $email), "id, picture", MUST_EXISTS);
				
		$context = context_user::instance($user->id, MUST_EXISTS);
		self::validate_context($context);
		
		$new_picture = (int)process_new_icon($context, 'user', 'icon', 0, $picture);
		
		if($new_picture > 0)
		{
			$DB->set_field('user','picture', $newpicture, array('id' => $user->id));
			return true;
		}
		
		return false;		
	}
	
	/**
	* Returns description of method result value
	* @return external_description
	*/
	public static function update_profile_picture_returns() {		
		return new external_value(PARAM_BOOL, 'Is picture updating success');
	}
}