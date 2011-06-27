<?php
/**
 * Announcements add page
 */

$container = get_entity($page[1]);
if (!elgg_instanceof($container, 'group') || !$container->canEdit()) {
	announcement_gatekeeper();
} else {
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('groups'), 'groups/all');
	elgg_push_breadcrumb($container->name, $container->getURL());
	elgg_push_breadcrumb(elgg_echo('announcements:group'), "announcements/group/{$container->guid}/all");
}

$title = elgg_echo('announcements:title:create');
elgg_push_breadcrumb($title);

$vars = announcements_prepare_form_vars();
$content = elgg_view_form('announcements/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);