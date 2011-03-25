<?php
/**
 * Announcements view page
 */

$guid = get_input('guid');
$announcement = get_entity($guid);
if (!elgg_instanceof($announcement, 'object', 'announcement')) {
	register_error(elgg_echo('announcements:error:invalid'));
	forward(REFERER);
}

$title = $announcement->title;

elgg_push_breadcrumb($title);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'buttons' => '',
	'content' => elgg_view_entity($announcement),
	'title' => $title,
));

echo elgg_view_page($title, $body);