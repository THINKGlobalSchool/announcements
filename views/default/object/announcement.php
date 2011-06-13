<?php
/**
 * Announcements Entity View
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$announcement = elgg_extract('entity', $vars, false);
$full_view = elgg_extract('full_view', $vars, false);

if (!$announcement) {
	return '';
}

$owner = get_entity($announcement->owner_guid);
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$owner_link = "<a href=\"{$owner->getURL()}\">{$owner->name}</a>";
$author_text = elgg_echo('announcements:author_by_line', array($owner_link));
$linked_title = "<a href=\"{$announcement->getURL()}\" title=\"" . htmlentities($announcement->title) . "\">{$announcement->title}</a>";
$date = elgg_view_friendly_time($announcement->time_updated);

$subtitle = "$author_text $date";

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'announcements',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// include a view for plugins to extend
// @todo this should be extended by adding to the menu.
$metadata = elgg_view("announcements/options", array(
		"object_type" => 'announcement',
		'entity' => $announcement
	))
	. $metadata;

if ($full_view) {
	$viewers = elgg_view('announcements/announcement_viewers', array('entity' => $announcement));

	$body = elgg_view('output/longtext', array(
		'value' => $announcement->description,
		'class' => 'elgg-announcement-description'
	));

	$params = array(
		'entity' => $announcement,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$list_body = elgg_view('object/elements/summary', $params);

	$info = elgg_view_image_block($owner_icon, $list_body);

	echo <<<___HTML
$info
$body
<div class="elgg-announcement-view-stats">$viewers</div>
___HTML;

} else {

	$params = array(
		'entity' => $announcement,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => elgg_get_excerpt($announcement->description),
	);
	
	$body = elgg_view('object/elements/summary', $params);
	echo elgg_view_image_block($owner_icon, $body);
}