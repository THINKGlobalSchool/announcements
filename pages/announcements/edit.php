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

if (!elgg_instanceof($announcement->getContainerEntity(), 'group') || !$announcement->getContainerEntity()->canEdit()) {
	announcement_gatekeeper();
} else {
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('groups'), 'groups/all');
	elgg_push_breadcrumb($announcement->getContainerEntity()->name, $announcement->getContainerEntity()->getURL());
	elgg_push_breadcrumb(elgg_echo('announcements:group'), "announcements/group/{$announcement->getContainerGUID()}/all");
}

$title = elgg_echo('announcements:title:edit');
elgg_push_breadcrumb($title);

$vars = announcements_prepare_form_vars($announcement);
$content = elgg_view_form('announcements/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);