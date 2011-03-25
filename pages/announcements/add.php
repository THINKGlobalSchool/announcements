<?php
/**
 * Announcements add page
 */

$title = elgg_echo('announcements:title:create');
elgg_push_breadcrumb($title);

$vars = announcements_prepare_form_vars();
$content = elgg_view_form('announcements/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'buttons' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);