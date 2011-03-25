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
$full_view = elgg_extract('full', $vars, false);

if (!$announcement) {
	return '';
}

$owner = get_entity($announcement->owner_guid);
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$owner_link = "<a href=\"{$owner->getURL()}\">{$owner->name}</a>";
$author_text = elgg_echo('announcements:author_by_line', array($owner_link));
$linked_title = "<a href=\"{$announcement->getURL()}\" title=\"" . htmlentities($announcement->title) . "\">{$announcement->title}</a>";
$date = elgg_view_friendly_time($announcement->time_updated);

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'announcements',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// include a view for plugins to extend
// @todo this should be extended by adding to the menu.
$metadata = elgg_view("announcements/options", array("object_type" => 'announcement', 'entity' => $announcement)) . $metadata;

if ($vars['full']) {
	$announcement_viewers = elgg_view('announcements/announcement_viewers', array('entity' => $announcement));
	echo <<<___END
	<div class="clearfix">
		<div id="content_header" class="clearfix">
			<div class="content_header_title"><h2>{$announcement->title}</h2></div>
		</div>
		<div class="clearfix">
		<div class="entity_listing_icon">
			$owner_icon
		</div>
		<div class="entity_listing_info">
			<div class="entity_metadata">$edit</div>
			<p class="entity_subtext">
				$author_text
				$date
			</p>
		</div>
		</div>
		<div class='announcement-description'>$announcement->description</div>
		<div class='announcement-viewers'>$announcement_viewers</div>
	</div>
___END;
} else {
	$content = <<<___END
	<div class="announcement entity_listing clearfix">
	<div class="entity_listing_icon">
		$owner_icon
	</div>
	<div class="entity_listing_info">
		<div class="entity_metadata">$edit</div>
		<p class="entity_title">$linked_title</p>
		<p class="entity_subtext">
			$author_text
			$date
		</p>
	</div>
	</div>
___END;

	$params = array(
		'entity' => $announcement,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => elgg_get_excerpt($announcement->description),
	);
	
	$body = elgg_view('page/components/summary', $params);
	echo elgg_view_image_block($owner_icon, $body);
}