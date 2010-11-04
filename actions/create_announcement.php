<?php
	/**
	 * Announcements create action
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
	$title = get_input('title');
	$description = get_input('description');
	$access_id = get_input('access_id');
	
	// Cache to users session
	$_SESSION['user']->announcement_title = $title;
	$_SESSION['user']->announcement_description = $description;
	$_SESSION['user']->announcement_access_id = $access_id;
	
	// Check inputs
	if (!$title || !$description) {
		register_error(elgg_echo('announcements:error:requiredfields'));
		forward(REFERER);
	}
	
	// New announcement
	$announcement = new ElggObject();
	$announcement->subtype = 'announcement';
	$announcement->title = $title;
	$announcement->description = $description;
	$announcement->access_id = $access_id;
	
	// Try saving
	if (!$announcement->save()) {
		// Error.. say so and forward
		register_error(elgg_echo('announcements:error:create'));
		forward(REFERER);
	} 
	
	// Success
	remove_metadata($_SESSION['user']->guid,'announcement_title');
	remove_metadata($_SESSION['user']->guid,'announcement_description');
	remove_metadata($_SESSION['user']->guid,'announcement_access_id');
	system_message(elgg_echo('announcements:success:create'));
	forward(elgg_get_site_url() . 'pg/announcements');
	
	
?>
