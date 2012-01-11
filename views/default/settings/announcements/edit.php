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
?>
<p>
    <label><?php echo elgg_echo('announcements:label:usertoggle'); ?></label><br />
    <?php 
	echo elgg_view('input/dropdown', array(
										'name' => 'params[usertoggle]', 
										'value' => $vars['entity']->usertoggle, 
										'options_values' => array(0 => elgg_echo('announcements:label:blacklist'), 1 => elgg_echo('announcements:label:whitelist')))
										);
	?>
</p>
<p>
    <label><?php echo elgg_echo('announcements:label:userlist'); ?></label><br />
    <?php 
	echo elgg_view('input/plaintext', array(
										'name' => 'params[userlist]', 
										'value' => $vars['entity']->userlist)
										); 
	?>
</p>
