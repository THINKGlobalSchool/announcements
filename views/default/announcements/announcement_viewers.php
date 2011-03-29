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

$ia = elgg_get_ignore_access();
elgg_set_ignore_access(true);

if ($announcement->access_id <= ACCESS_PUBLIC) {
	// Count all site users
	$viewers_count = elgg_get_entities(array(
		'type' => 'user',
		'subtype' => ELGG_ENTITIES_ANY_VALUE,
		'count' => true
	));
	
	$context_text = ' site ';
} else {
	// This is stupidly complicated.. but get_members_of_access_collection doesn't work right.
	// ... so here we are.
	$acl = get_access_collection($announcement->access_id);

	// @todo this will only work for english.
	$context = (strpos(strtolower($acl->name), 'channel') !== false) ? 'channel' : 'group';

	if ($context == 'channel') {
		$subtype = 'shared_access';
		$md_name = 'acl_id';
		$relationship = 'shared_access_member';
	} else {
		$subtype = 'group';
		$md_name = 'group_acl';
		$relationship = 'member_of';
	}

	$obj = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => $subtype,
		'metadata_name' => $md_name,
		'metadata_value' => $announcement->access_id,
	));

	$viewers_count = elgg_get_entities_from_relationship(array(
		'relationship' => $relationship,
		'relationship_guid' => $obj[0]->getGUID(),
		'inverse_relationship' => true,
		'count' => true
	));

}	
elgg_set_ignore_access($ia);
	
// Get users who have viewed the announcement
$viewers = elgg_get_entities_from_relationship(array(
													'relationship' => 'has_viewed_announcement',
													'relationship_guid' => $announcement->getGUID(),
													'inverse_relationship' => TRUE,
													'types' => 'user',
													'limit' => 9999,
												));


$percentage = number_format((count($viewers) / $viewers_count) * 100, 1);

echo '<h3 class="pbs">' . elgg_echo('announcements:label:viewstats') . '</h3>';

echo '<span class="viewers-text">'
	. elgg_echo('announcements:viewed_by', array(count($viewers), $viewers_count, $context, $percentage . '%'))
	. '</span>';
												

echo '<h3 class="ptm pbs">' . elgg_echo('announcements:label:usersviewed') . '</h3>';

if ($viewers) {
	echo '<ul>';
	foreach ($viewers as $viewer) {
		echo '<li><a href="' . $viewer->getURL() . '">' . $viewer->name . '</a></li>';
	}
	echo '</ul>';
}
