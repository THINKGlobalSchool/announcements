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
	

	echo '<h3>' . elgg_echo('announcements:label:viewstats') . '</h3>';

	$ia = elgg_get_ignore_access();
	elgg_set_ignore_access(true);
	if ($announcement->access_id == ACCESS_LOGGED_IN) {
		// Count all site users
		$viewers_count = elgg_get_entities(array('type' => 'user','count' => true));
		$context_text = ' site ';
	} else {
		if (is_plugin_enabled('shared_access')) {
			// This is stupidly complicated.. but get_members_of_access_collection doesn't work right.
			// ... so here we are. 
			$sac = elgg_get_entities_from_metadata(array(
				'type' => 'object',
				'subtype' => 'shared_access',
				'metadata_name' => 'acl_id',
				'metadata_value' => $announcement->access_id,
			));
			$viewers_count = elgg_get_entities_from_relationship(array('relationship' => 'shared_access_member', 'relationship_guid' => $sac[0]->getGUID(), 'inverse_relationship' => TRUE, 'count' => true));
			$context_text = ' channel ';
		}
	}	
	elgg_set_ignore_access($ia);
		
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
	
	$percentage = number_format((count($viewers) / $viewers_count) * 100, 1);
													
	echo '<span class="viewers_text">' . sprintf(elgg_echo('announcements:viewed_by'), count($viewers), $viewers_count, $context_text, $percentage . '%')  . '</span>';
													

	echo "<h3>" . elgg_echo('announcements:label:usersviewed') . "</h3>";
	
	foreach ($viewers as $viewer) {
		echo '<a href="' . $viewer->getURL() . '">' . $viewer->name . '</a><br />';
	}
?>