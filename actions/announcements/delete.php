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
	if ($announcement->delete()) {
		// Success
		system_message(elgg_echo('announcements:success:delete'));
		forward(REFERER);
		
	} else {
		// Error
		register_error(elgg_echo('announcements:error:delete'));
		forward(REFERER);
	}		
}
