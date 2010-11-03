<?php
	/**
	 * Announcements viewers view
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */

	$announcement = $vars['entity'];
		
	// Get users who have viewed the announcement
	$viewers = elgg_get_entities_from_relationship(array(
														'relationship' => 'has_viewed_announcement',
														'relationship_guid' => $announcement->getGUID(),
														'inverse_relationship' => TRUE,
														'types' => 'user',
														'limit' => 9999,
														'offset' => 0,
														'count' => false,
													));
													

	echo "<h3>" . elgg_echo('announcements:label:usersviewed') . "</h3><br />";
	
	foreach ($viewers as $viewer) {
		echo '<a href="' . $viewer->getURL() . '">' . $viewer->name . '</a><br />';
	}
?>