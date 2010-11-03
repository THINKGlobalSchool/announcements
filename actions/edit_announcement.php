<?php
	/**
	 * Announcements edit action
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
	$announcement_guid = get_input('announcement_guid');
	$title = get_input('title');
	$description = get_input('description');
	
	$announcement = get_entity('announcement_guid');
	
	if ($announcement && $announcement->getSubtype() == 'announcement') {
	
		// Cache to users session
		$_SESSION['user']->announcement_title = $title;
		$_SESSION['user']->announcement_description = $description;
	
		// Check inputs
		if (!$title || !$description) {
			register_error(elgg_echo('announcements:error:requiredfields'));
			forward($_SERVER['HTTP_REFERER']);
		}
	
		// Set announcement fields
		$announcement->title = $title;
		$announcement->description = $description;
	
		// Try saving
		if (!$announcement->save()) {
			// Error.. say so and forward
			register_error(elgg_echo('announcements:error:edit'));
			forward($_SERVER['HTTP_REFERER']);
		} 
	
		// Success
		remove_metadata($_SESSION['user']->guid,'announcement_title');
		remove_metadata($_SESSION['user']->guid,'announcement_description');
		system_message(elgg_echo('announcements:success:edit'));
		forward($_SERVER['HTTP_REFERER']);
	}
	
	register_error(elgg_echo('announcements:error:edit'));
	forward($_SERVER['HTTP_REFERER']);
	
?>
