<?php
/**
 * Announcements Settings
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

// View all students role (users in this role will see all users in the student role as children)
$admin_label = elgg_echo('announcements:label:adminrole');
$admin_input = elgg_view('input/roledropdown', array(
	'name' => 'params[admin_role]',
	'id' => 'view-students-role',
	'value' => $vars['entity']->admin_role,
	'show_hidden' => TRUE,
));

$content = <<<HTML
	<div>
		<label>$admin_label</label><br />
		$admin_input
	</div>
HTML;

echo $content;