<?php
	/**
	 * Announcements container view
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
	
	// Check if we've got an entity, if so, we're editing.
	if (isset($vars['entity'])) {
		if (!$vars['entity']) {
			forward();
		}
		
		$action 			= "announcements/edit_announcement";
		$title 		 		= $vars['entity']->title;
		$description 		= $vars['entity']->description;	
		$access_id 			= $vars['entity']->access_id;
		$entity_hidden  = elgg_view('input/hidden', array('internalname' => 'announcement_guid', 'value' => $vars['entity']->getGUID()));
		
	} else {
	// No entity, creating new one
		$action 			= "announcements/create_announcement";
		$title 				= "";
		$description 		= "";
		$access_id			= ACCESS_LOGGED_IN;
		$return_required 	= 0;
		$is_rubric_selected = 0;
	}
	
	$submit_input = elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('save')));	
	$container_guid = get_input('container_guid', page_owner());
	$container_hidden = elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => $container_guid));
	
	// Load cached data (result of an error on create/edit action)
	$vars['user']->announcement_title ? $title 	= $vars['user']->announcement_title : ''; 
	$vars['user']->announcement_description ? $description = $vars['user']->announcement_description: '';

	// Labels/Input
	$title_label = elgg_echo('title');
	$title_input = elgg_view('input/text', array('internalname' => 'title', 'value' => $title));
	
	$description_label = elgg_echo("description");
	$description_input = elgg_view("input/longtext", array('internalname' => 'description', 'value' => $description));
	
	$access_label = elgg_echo('access');
	$access_input = elgg_view('input/access', array(
		'internalname' => 'access_id',
		'internalid' => 'access_id',
		'value' => $access_id
	));

	// Build Form Body
	$form_body = <<<EOT
	
	<div class='margin_top'>
		<div>
			<label>$title_label</label><br />
	        $title_input
		</div><br />
		<div>
			<label>$description_label</label><br />
	        $description_input
		</div><br />
		<div>
			<label>$access_label</label><br />
	        $access_input
		</div><br />
		<div>
			$submit_input
			$container_hidden
			$entity_hidden
		</div>
	</div>
	
EOT;

	echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body, 'internalid' => 'annoucement_post_forms'));
?>