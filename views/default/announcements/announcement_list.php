<?php
/**
 * Announcements list
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

// don't show to logged out users
if (!elgg_is_logged_in()) {
	return '';
}

$options = array(
	'type' => 'object',
	'subtype' => 'announcement',
	'limit' => 25,
);

$page_owner = elgg_get_page_owner_entity();

// If we're viewing as a group
if (elgg_instanceof($page_owner, 'group')) {
	$options['container_guid'] = elgg_get_page_owner_guid();
} else if ($vars['container_guid']) { // Or supplied
	$options['container_guid'] = $vars['container_guid'];
}


// Grab announcements
$announcements = elgg_get_entities($options);

foreach($announcements as $announcement) {	
	
	$container = get_entity($announcement->container_guid);
	
	// Don't show group announcements unless we're viewing a group
	if (elgg_instanceof($container, 'group') && $page_owner->guid != $container->guid) {
		continue;
	}
	
	// Check if the announcement has been viewed
	if (!check_entity_relationship(elgg_get_logged_in_user_guid(), 'has_viewed_announcement', $announcement->getGUID())) {
		$announcements_content .= elgg_view('announcements/announcement', array('entity' => $announcement));
	}
}

echo $announcements_content;
