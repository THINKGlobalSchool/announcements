<?php
/**
 * Announcements view
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2014
 * @link http://www.thinkglobalschool.com/
 * 
 */

$announcement = $vars['entity'];
$close_url = elgg_get_site_url() . 'action/announcements/close?guid=' . $vars['entity']->getGUID();
$close_url = elgg_add_action_tokens_to_url($close_url);
		
switch ($announcement->access_id) {
	case -1: 
		$access_content = 'Default';
		break;
	case 0: 
		$access_content = 'Private';
		break;
	case 1: 
		$access_content = 'Logged In Users';
		break;
	case 2:
		$access_content = 'Public';
		break;
	case -2 :
		$access_content = 'Friends Only';
		break;
	default:
		$acl = get_access_collection($announcement->access_id);
		$access_content = $acl->name;
		break;
}

$close_label = elgg_echo('announcements:label:close');

$title = <<<HTML
$announcement->title
	<a class="elgg-announcement-close small" href="$close_url">&nbsp;$close_label&nbsp;<span class="elgg-icon elgg-icon-delete right"></span></a>
HTML;

$description = elgg_view('output/longtext', array(
	'value' => $announcement->description
));

$body = <<<HTML
	$description
	<span class="right clearfix elgg-announcement-access-display">$access_content</span>
HTML;

$options = array(
	'id' => 'announcement-' . $announcement->getGUID(),
	'class' => 'elgg-announcement'
);

echo elgg_view_module('aside', $title, $body, $options);