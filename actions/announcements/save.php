<?php
/**
 * Announcements save action
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$guid = get_input('guid');
$title = get_input('title');
$description = get_input('description');
$expiry_date = strtotime(get_input('expiry_date'));
$access_id = get_input('access_id');
$container_guid = get_input('container_guid');
$tags = string_to_tag_array(get_input('tags'));

elgg_make_sticky_form('annoucement-post-form');

if (empty($expiry_date)) {
	$expiry_date = ANNOUNCEMENTS_NEVER_EXPIRE;
}

if ($guid) {
	$announcement = get_entity($guid);
	if (!elgg_instanceof($announcement, 'object', 'announcement') || !$announcement->canEdit()) {
		register_error(elgg_echo('announcements:error:save'));
		forward(REFERER);
	}
} else {
	$announcement = new ElggObject();
	$announcement->subtype = 'announcement';
}

if (!$title || !$description) {
	register_error(elgg_echo('announcements:error:requiredfields'));
	forward(REFERER);
}

// If we are creating a group announcement
$container = get_entity($container_guid);
if ($container != elgg_get_logged_in_user_entity() && elgg_instanceof($container, 'group') && $container->canEdit()) {
	// Only set the container guid when creating a new announcement
	if (!$guid) {
		$announcement->container_guid = $container_guid;
	}
	// Set access to group
	$announcement->access_id = $container->group_acl;
} else {
	$announcement->access_id = $access_id;
}

$announcement->title = $title;
$announcement->description = $description;
$announcement->expiry_date = $expiry_date;
$announcement->tags = $tags;

if ($announcement->save()) {
	elgg_clear_sticky_form('annoucement-post-form');

	system_message(elgg_echo('announcements:success:save'));
	if (elgg_instanceof($container, 'group')) {
		forward("announcements/group/{$container->guid}/all");
	} else {
		forward('announcements/all');
	}
	
} else {
	register_error(elgg_echo('announcements:error:save'));
	forward(REFERER);
}



