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
	$action 			= "announcements/edit";
	$entity_hidden  = elgg_view('input/hidden', array('internalname' => 'announcement_guid', 'value' => $vars['entity']->getGUID()));
	
} else {
// No entity, creating new one
	$action 			= "announcements/add";
}

// Prep values
$values = announcements_prepare_form_vars($vars['entity']);

// Map values
$title = elgg_get_array_value('title', $values, '');
$description = elgg_get_array_value('description', $values, '');
$container_guid = elgg_get_array_value('container_guid', $values);
$access_id = elgg_get_array_value('access_id', $values, ACCESS_DEFAULT);

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

$submit_input = elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('save')));	
$container_hidden = elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => $container_guid));

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
echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body, 'internalid' => 'annoucement-post-form'));
