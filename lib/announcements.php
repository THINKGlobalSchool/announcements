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
		'expiry_date' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'tags' => '',
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
	// must be logged in
	if (!elgg_is_logged_in()) {
		return false;
	}
	
	// Don't bother checking for admins
	if (elgg_is_admin_logged_in()) {
		return true;
	}
	
	$admin_role = elgg_get_plugin_setting('admin_role', 'announcements');
	
	$role = get_entity($admin_role);

	if (elgg_instanceof($role, 'object', 'role') && $role->isMember(elgg_get_logged_in_user_entity())) {
		return TRUE;
	} else {
		return FALSE;
	}
}
