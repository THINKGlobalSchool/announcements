<?php
/**
 * Announcements edit page
 */

$guid = get_input('guid');
$announcement = get_entity($guid);
if (!elgg_instanceof($announcement, 'object', 'announcement')) {
	register_error(elgg_echo('announcements:error:invalid'));
	forward(REFERER);
}

$title = elgg_echo('announcements:title:edit');
elgg_push_breadcrumb($title);

$vars = announcements_prepare_form_vars($announcement);
$content = elgg_view_form('announcements/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'buttons' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);