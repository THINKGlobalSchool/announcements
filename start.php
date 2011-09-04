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
elgg_register_event_handler('init', 'system', 'announcements_init');

function announcements_init() {
	$plugin_root = dirname(__FILE__);
	
	// register and use the lib
	$lib_path = "$plugin_root/lib/announcements.php";
	elgg_register_library('announcements', $lib_path);
	elgg_load_library('announcements');
	
	// Page handler
	elgg_register_page_handler('announcements', 'announcements_page_handler');
	
	// Extend CSS
	elgg_extend_view('css/elgg', 'announcements/css');

	// Extend JS
	elgg_extend_view('js/elgg', 'js/announcements');
	
	// Extend river dashboard container
	//elgg_extend_view('riverdashboard/container', 'announcements/announcement_list', 350);
	
	// also extend the core activity
	//elgg_extend_view('core/river/filter', 'announcements/announcement_list', -1);
	
	// Extend groups summary 
	elgg_extend_view('groups/profile/summary', 'announcements/announcement_list', -1);
	
	// Register actions
	$action_base = $plugin_root . '/actions/announcements';
	elgg_register_action('announcements/close', "$action_base/close.php");
	elgg_register_action('announcements/save', "$action_base/save.php");
	elgg_register_action('announcements/delete', "$action_base/delete.php");
	
	// Register URL handler
	elgg_register_entity_url_handler('object', 'announcement', 'announcement_url');
	
	// Group announcements owner block 
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'announcements_owner_block_menu');
	
	// add the group announcements option
    add_group_tool_option('announcements',elgg_echo('groups:enableannouncements'),true);
	
	// Check if we're allowed to see announcements
	if (can_user_manage_announcements()) {
		// Add to main menu
		$item = new ElggMenuItem('announcements', elgg_echo('announcements'), 'announcements');
		elgg_register_menu_item('site', $item);
	}
}

/**
 * Dispatches announcements pages
 * URLs take the form of
 *  All announcements:       announcements/all
 *  View announcement:       announcements/view/<guid>/<title>
 *  New announcement:        announcements/add/<guid>
 *  Edit announcement:       announcements/edit/<guid>
 *
 * Title is ignored
 *
 * @param array $page
 * @return NULL
 */
function announcements_page_handler($page) {
	
	// Initial breadcrumb
	elgg_push_breadcrumb(elgg_echo('announcements'), 'announcements');
	elgg_push_context('announcements');

	$pages_root = dirname(__FILE__) . '/pages/announcements';
	$page_type = $page[0];
	
	switch ($page_type) {
		case 'edit':
			$guid = $page[1];
			set_input('guid', $guid);
			include "$pages_root/edit.php";
			break;

		case 'add':
			include "$pages_root/add.php";
			break;

		case 'view':
			$guid = $page[1];
			set_input('guid', $guid);
			include "$pages_root/view.php";
			break;
		case 'group':
			$guid = $page[1];
			set_input('group_guid', $guid);
			include "$pages_root/group.php";
			break;
			
		case 'all':
		default:
			announcement_gatekeeper();
			include "$pages_root/all.php";
			break;
	}

	elgg_pop_context();
	return true;
}

/**
 * Populates the ->getUrl() method for announcement entities
 *
 * @param ElggEntity entity
 * @return string request url
 */
function announcement_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return elgg_get_site_url() . "announcements/view/{$entity->guid}/$title";
}

/**
 * Plugin hook to add polls's to groups profile block
 * 	
 * @param unknown_type $hook
 * @param unknown_type $type
 * @param unknown_type $return
 * @param unknown_type $params
 * @return unknown
 */
function announcements_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'group') && $params['entity']->announcements_enable == 'yes' && $params['entity']->canEdit()) {
		$url = elgg_get_site_url() . "announcements/group/{$params['entity']->guid}/all";
		$item = new ElggMenuItem('announcements', elgg_echo('announcements:group'), $url);
		$return[] = $item;
	} 

	return $return;
}
