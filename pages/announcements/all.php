<?php
/**
 * Lists all announcements
 */

$title = elgg_echo('announcements');

$announcements = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'announcement',
	// @todo why?
	'limit' => 9999,
	'full_view' => false
));

if ($announcements) {
	$content = $announcements;
} else {
	$content = elgg_view('announcements/noresults');
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	// hide the add button if users can't add
	'buttons' => (can_user_manage_announcements()) ? null : false,
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);