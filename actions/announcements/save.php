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
$access_id = get_input('access_id');

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

$announcement->title = $title;
$announcement->description = $description;
$announcement->access_id = $access_id;

if ($announcement->save()) {
	system_message(elgg_echo('announcements:success:save'));
	forward('announcements/all');
} else {
	register_error(elgg_echo('announcements:error:save'));
	forward(REFERER);
}



