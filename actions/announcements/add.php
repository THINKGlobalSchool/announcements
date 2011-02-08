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
	
// Get inputs
$title = get_input('title');
$description = get_input('description');
$access_id = get_input('access_id');

// Create Sticky form
elgg_make_sticky_form('annoucement-post-form');

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

// Clear Sticky form
elgg_clear_sticky_form('annoucement-post-form');

system_message(elgg_echo('announcements:success:create'));
forward(elgg_get_site_url() . 'pg/announcements/all');
