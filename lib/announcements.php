<?php
/**
 * Announcements library
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

/**
 * Prepare the upload/edit form variables
 *
 * @param ElggEntity $announcement
 * @return array
 */
function announcements_prepare_form_vars($announcement = null) {

	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null
	);

	if (elgg_is_sticky_form('annoucement-post-form')) {
		foreach (array_keys($values) as $field) {
			$values[$field] = elgg_get_sticky_value('annoucement-post-form', $field);
		}
	}

	elgg_clear_sticky_form('annoucement-post-form');

	if (!$announcement) {
		return $values;
	}

	foreach (array_keys($values) as $field) {
		$values[$field] = $announcement->$field;
	}

	$values['entity'] = $announcement;

	return $values;
}


/**
 * Announcement Gatekeeper function, allows custom permissions
 */
function announcement_gatekeeper() {
	gatekeeper();
	
	if (!can_user_manage_announcements()) {
		forward();
	}
}

/**
 * Helper function to check if a user is allowed to create/manage announcements
 * @return bool
 */
function can_user_manage_announcements() {
	// Don't bother checking for admins
	if (elgg_is_admin_logged_in()) {
		return true;
	}
	// Will be true for whitelist, false for blacklist
	$access_toggle = elgg_get_plugin_setting('usertoggle', 'announcements');

	$user_list = elgg_get_plugin_setting('userlist','announcements');
	$user_list = explode("\n", $user_list);

	$user = elgg_get_logged_in_user_entity();

	if (in_array($user->username, $user_list)) {
		$user_in_list = true;
	}

	if ($access_toggle) {
		// Whitelist
		$allowed = $user_in_list ? true : false;
	} else {
		// Blacklist
		$allowed = $user_in_list ? false : true;
	}

	return $allowed;
}
