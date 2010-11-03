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
	
	$announcements = elgg_get_entities(array('type' => 'object', 'subtype' => 'announcement', 'limit' => 9999));
	foreach($announcements as $announcement) {
		if (!check_entity_relationship(get_loggedin_userid(), 'has_viewed_announcement', $announcement->getGUID())) {
			$announcements_content .= elgg_view('announcements/announcement', array('entity' => $announcement));
		}
	}
	echo $announcements_content;
?>