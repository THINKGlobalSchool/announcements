<?php
/**
 * Announcements view
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
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

$title = <<<___HTML
$announcement->title
<a class="elgg-announcement-close" href="$close_url">Close&nbsp;<span class="elgg-icon elgg-icon-delete right"></span></a>
___HTML;

$body = <<<___HTML
$announcement->description
<span class="right clearfix elgg-announcement-access-display">$access_content</span>
___HTML;

$options = array(
	'id' => 'announcement-' . $announcement->getGUID(),
	'class' => 'elgg-announcement elgg-output'
);

echo elgg_view_module('featured', $title, $body, $options);