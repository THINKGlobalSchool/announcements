<?php
/**
 * Lists group announcements
 */

$title = elgg_echo('announcements');

$group = get_entity(get_input('group_guid'));


// Check for group, and that we can edit
if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
	forward();
}

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('groups'), 'groups/all');
elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb(elgg_echo('announcements:group'));

$announcements = elgg_list_entities(array(
	'container_guid' => $group->guid,
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

if ($group->canEdit()) {
	elgg_register_add_button();
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);