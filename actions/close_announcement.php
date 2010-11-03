<?php
	/**
	 * Announcements close action
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
	
	// Logged in users
	gatekeeper();
	
	// Actions
	action_gatekeeper();
	
	// Get inputs
	$announcement_guid = get_input('guid');
	
	$announcement = get_entity($announcement_guid);

	if ($announcement && $announcement->getSubtype() == 'announcement') {
		$user = get_loggedin_user();
		$success = true;
		if (!check_entity_relationship($user->getGUID(), 'has_viewed_announcement', $announcement->getGUID())) {
			$success = add_entity_relationship($user->getGUID(), 'has_viewed_announcement', $announcement->getGUID());
		}
		echo json_encode(array('result' => $success));
		exit;
	}
	
	echo json_encode(array('result' => 0, 'description' => 'invalid entity'));
	exit;
?>
