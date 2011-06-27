<?php
/**
 * Lists all announcements
 */

$title = elgg_echo('announcements');

$announcements = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'announcement',
	'limit' => 0,
	'full_view' => false
));

if ($announcements) {
	$content = $announcements;
} else {
	$content = elgg_view('announcements/noresults');
}

// Add button 
if (can_user_manage_announcements()) {
	elgg_register_add_button();
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);