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

// Get inputs
$announcement_guid = get_input('announcement_guid');
$title = get_input('title');
$description = get_input('description');
$access_id = get_input('access_id');

$announcement = get_entity($announcement_guid);

// Create Sticky form
elgg_make_sticky_form('annoucement-post-form');

if ($announcement && $announcement->getSubtype() == 'announcement') {

	// Cache to users session
	$_SESSION['user']->announcement_title = $title;
	$_SESSION['user']->announcement_description = $description;

	// Check inputs
	if (!$title || !$description) {
		register_error(elgg_echo('announcements:error:requiredfields'));
		forward(REFERER);
	}

	// Set announcement fields
	$announcement->title = $title;
	$announcement->description = $description;
	$announcement->access_id = $access_id;

	// Try saving
	if (!$announcement->save()) {
		// Error.. say so and forward
		register_error(elgg_echo('announcements:error:edit'));
		forward(REFERER);
	} 
	
	// Clear Sticky form
	elgg_clear_sticky_form('annoucement-post-form');s

	system_message(elgg_echo('announcements:success:edit'));
	forward('pg/announcements/all');
}


register_error(elgg_echo('announcements:error:edit'));
forward(REFERER);
