<?php
/**
 * Announcements start.php
 * 
 * @package Announcements
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

register_elgg_event_handler('init', 'system', 'announcements_init');

function announcements_init() {
	// Include lib
	include elgg_get_plugin_path() . 'announcements/lib/announcements.php';
	
	// Page handler
	register_page_handler('announcements', 'announcements_page_handler');
	
	// Extend CSS
	elgg_extend_view('css/screen', 'announcements/css');
	
	// Extend river dashboard container
	elgg_extend_view('riverdashboard/container', 'announcements/announcement_container', 350);
	
	// Extend shared_
	elgg_extend_view('shared_access/shared_access_topbar', 'announcements/announcement_container', 9999);
	
	// Register actions
	$action_base = elgg_get_plugin_path() . 'announcements/actions/announcements';
	elgg_register_action('announcements/close', "$action_base/close.php");
	elgg_register_action('announcements/add', "$action_base/add.php");
	elgg_register_action('announcements/edit', "$action_base/edit.php");
	elgg_register_action('announcements/delete', "$action_base/delete.php");
	
	// Register URL handler
	register_entity_url_handler('announcement_url','object', 'announcement');
	
	// Check if we're allowed to see announcements
	if (can_user_manage_announcements()) {
		// Add to main menu
		add_menu(elgg_echo('announcements'), elgg_get_site_url() . 'pg/announcements');
	}
}

/**
 * Dispatches announcements pages
 * URLs take the form of
 *  All announcements:       pg/announcements/all
 *  View announcement:       pg/announcements/view/<guid>/<title>
 *  New announcement:        pg/announcements/add/<guid>
 *  Edit announcement:       pg/announcements/edit/<guid>
 *
 * Title is ignored
 *
 * @param array $page
 * @return NULL
 */
function announcements_page_handler($page) {
	
	// Initial breadcrumb
	elgg_push_breadcrumb(elgg_echo('announcements:site'), elgg_get_site_url() . 'pg/announcements');
	
	$page_type = $page[0];
	switch ($page_type) {
		case 'edit':
			announcement_gatekeeper();
			$title = elgg_echo('announcements:title:edit');
			elgg_push_breadcrumb($title);
			$announcement = get_entity($page[1]);
			if ($announcement && $announcement->getSubtype() == 'announcement') {
				$content_info['content'] = elgg_view_title($title) . elgg_view('forms/announcements/edit', array('entity' => $announcement));
			} else {
				register_error(elgg_echo('announcements:error:invalid'));
				forward(REFERER);
			}
			break;
		case 'add':
			announcement_gatekeeper();
			$title = elgg_echo('announcements:title:create');
			elgg_push_breadcrumb($title);
			$content_info['content'] = elgg_view_title($title) . elgg_view('forms/announcements/edit');
			break;
		case 'view':
			announcement_gatekeeper();
			$announcement = get_entity($page[1]);
			if ($announcement && $announcement->getSubtype() == 'announcement') {
				$title = $announcement->title;
				elgg_push_breadcrumb($title);
				$content_info['content'] = elgg_view_entity($announcement, true);
			} else {
				register_error(elgg_echo('announcements:error:invalid'));
				forward(REFERER);
			}
			break;
		case 'ajax_list':
			// Todo: check if we're coming from XHR
			// Might have recieved a shared_access guid
			if ($page[1] && $sac = get_entity($page[1])) {
				echo elgg_view('announcements/announcement_list', array('sac' => $sac));
			} else {
				echo elgg_view('announcements/announcement_list');
			}
			exit;
			break;
		case 'all':
		default:
			announcement_gatekeeper();
			$title = elgg_echo('announcements');
			$content_info['content'] = elgg_view('page_elements/content_header', array('tabs' => array(), 'type' => 'announcement', 'new_link' => elgg_get_site_url() . 'pg/announcements/add'));
			$announcements = elgg_list_entities(array('type' => 'object', 'subtype' => 'announcement', 'limit' => 9999, 'full_view' => false));
			if ($announcements) {
				$content_info['content'] .= $announcements;
			} else {
				$content_info['content'] .= elgg_view('announcements/noresults');
			}
			break;
	}

	$content = elgg_view('navigation/breadcrumbs') . $content_info['content'];
	$body = elgg_view_layout('one_column_with_sidebar', $content, $sidebar);
	echo elgg_view_page($title, $body);
}

/**
 * Populates the ->getUrl() method for announcement entities
 *
 * @param ElggEntity entity
 * @return string request url
 */
function announcement_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return elgg_get_site_url() . "pg/announcements/view/{$entity->guid}/$title";
}

/** 
 * Announcement Gatekeeper function, allows custom permissions
 */ 
function announcement_gatekeeper() {		
	gatekeeper();							
	if (!can_user_manage_announcements()) {
		forward();
	}
   }

/** 
 * Helper function to check if a user is allowed to create/manage announcements
 * @return bool
 */
function can_user_manage_announcements() {
	// Don't bother checking for admins
	if (isadminloggedin()) {
		return true;
	}
	// Will be true for whitelist, false for blacklist
	$access_toggle = get_plugin_setting('usertoggle', 'announcements');

	$user_list = get_plugin_setting('userlist','announcements');
	$user_list = explode("\n", $user_list);

	$user = get_loggedin_user();

	if (in_array($user->username, $user_list)) {
		$user_in_list = true;
	}

	if ($access_toggle) {
		// Whitelist
		$allowed = $user_in_list ? true:false;
	} else {
		// Blacklist
		$allowed = $user_in_list ? false:true;
	}
	
	return $allowed;
}
