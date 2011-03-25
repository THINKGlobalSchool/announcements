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

$english = array(
	
	// Generic
	'announcement' => 'Announcements',
	'announcements' => 'Announcements',
	'announcements:site' => 'All Site Announcements',
	'announcement:new' => 'Create New Announcement',
	
	// Page titles 
	'announcements:title:create' => 'Create New Announcement',
	'announcements:title:edit' => 'Edit Announcement',
	
	// Menu items

	// Labels 
	'announcements:label:usersviewed' => 'Viewed By:',

	// Messages
	'announcements:success:save' => 'Successfully saved the announcement',
	'announcements:success:delete' => 'Successfully deleted announcement',
	'announcements:error:save' => 'There was an error saving the announcement',
	'announcements:error:delete' => 'There was an error deleting the announcement',
 	'announcements:error:requiredfields' => 'One or more required fields are missing',
	'announcements:error:invalid' => 'Invalid announcement',
	'announcements:label:usertoggle' => 'User List Toggle (List behaves as either a whitelist or blacklist)',
	'announcements:label:blacklist' => 'Blacklist',
	'announcements:label:whitelist' => 'Whitelist',
	'announcements:label:userlist' => 'User List',
	'announcements:label:viewstats' => 'Stats:',
	'announcements:label:close' => 'Close',
	
	// Other content
	'announcements:author_by_line' => 'By %s',
	'announcements:viewed_by' => "%s of %s %s users have viewed this announcement (%s)",
);

add_translation('en', $english);
