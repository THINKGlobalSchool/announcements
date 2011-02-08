<?php
/**
 * Announcements english translation
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

/**
 * Prepare the upload/edit form variables
 *
 * @param ElggEntity $announcement
 * @return array
 */
function announcements_prepare_form_vars($announcement = null) {

	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		//'entity' => $file, -> Not using elgg_view_form yet..
	);

	if ($announcement) {
		foreach (array_keys($values) as $field) {
			$values[$field] = $announcement->$field;
		}
	}

	if (elgg_is_sticky_form('annoucement-post-form')) {
		foreach (array_keys($values) as $field) {
			$values[$field] = elgg_get_sticky_value('annoucement-post-form', $field);
		}
	}

	elgg_clear_sticky_form('annoucement-post-form');

	return $values;
}
