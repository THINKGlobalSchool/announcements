<?php
/**
 * Announcements delete action
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
	
// Get inputs
$announcement_guid = get_input('guid');

$announcement = get_entity($announcement_guid);

if ($announcement && $announcement->getSubtype() == 'announcement') {
	$container = $announcement->getContainerEntity();
	if ($announcement->delete()) {
		// Success
		system_message(elgg_echo('announcements:success:delete'));
		if (elgg_instanceof($container, 'group')) {
			forward("announcements/group/{$container->guid}/all");
		} else {
			forward('announcements/all');
		}
		
	} else {
		// Error
		register_error(elgg_echo('announcements:error:delete'));
		forward(REFERER);
	}		
}
