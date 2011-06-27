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

$title = elgg_extract('title', $vars);
$description = elgg_extract('description', $vars);
$container_guid = elgg_extract('container_guid', $vars);
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$guid = elgg_extract('guid', $vars);

// Labels/Input
$title_label = elgg_echo('title');
$title_input = elgg_view('input/text', array('name' => 'title', 'value' => $title));

$description_label = elgg_echo("description");
$description_input = elgg_view("input/longtext", array('name' => 'description', 'value' => $description));

// Only display access input for non groups
if (!elgg_instanceof(elgg_get_page_owner_entity(), 'group')) {
	$access_label = elgg_echo('access');
	$access_input = elgg_view('input/access', array(
		'name' => 'access_id',
		'id' => 'access_id',
		'value' => $access_id
	));
}

$submit_input = elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));

$container_hidden = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
$entity_hidden = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));

// Build Form Body
$form_body = <<<HTML
<div>
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
	<div class="elgg-foot">
		$submit_input
		$container_hidden
		$entity_hidden
	</div>
</div>
HTML;

echo $form_body;