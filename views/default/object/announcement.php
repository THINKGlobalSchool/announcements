<?php
	/**
	 * Announcements Entity View
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */

	$announcement = (isset($vars['entity'])) ? $vars['entity'] : FALSE;
	
	if (!$announcement) {
		return '';
	}
	
	$owner = get_entity($announcement->owner_guid);
	$owner_icon = elgg_view('profile/icon', array('entity' => $owner, 'size' => 'tiny'));
	$owner_link = "<a href=\"{$owner->getURL()}\">{$owner->name}</a>";
	$author_text = sprintf(elgg_echo('announcements:author_by_line'), $owner_link);
	$linked_title = "<a href=\"{$announcement->getURL()}\" title=\"" . htmlentities($announcement->title) . "\">{$announcement->title}</a>";
	$date = elgg_view_friendly_time($announcement->time_updated);
	
	if ($announcement->canEdit()) {
		$edit_url = elgg_get_site_url()."pg/announcements/edit/{$announcement->getGUID()}/";
		$edit_link = "<span class='entity_edit'><a href=\"$edit_url\">" . elgg_echo('edit') . '</a></span>';

		$delete_url = elgg_get_site_url()."action/announcements/delete_announcement?announcement_guid={$announcement->getGUID()}";
		$delete_link = "<span class='delete_button'>" . elgg_view('output/confirmlink', array(
			'href' => $delete_url,
			'text' => elgg_echo('delete'),
			'confirm' => elgg_echo('deleteconfirm')
		)) . "</span>";

		$edit .= "$edit_link $delete_link";
	}

	// include a view for plugins to extend
	$edit = elgg_view("announcements/options", array("object_type" => 'announcement', 'entity' => $announcement)) . $edit;

	if ($vars['full']) {
		$announcement_viewers = elgg_view('announcements/announcement_viewers', array('entity' => $announcement));
		echo <<<___END
		<div class="clearfix">
			<div id="content_header" class="clearfix">
				<div class="content_header_title"><h2>{$announcement->title}</h2></div>
			</div>
			<div class="clearfix">
			<div class="entity_listing_icon">
				$owner_icon
			</div>
			<div class="entity_listing_info">
				<div class="entity_metadata">$edit</div>
				<p class="entity_subtext">
					$author_text
					$date
				</p>
			</div>
			</div>
			<div class='announcement_description'>$announcement->description</div>
			<div class='announcement_viewers'>$announcement_viewers</div>
		</div>
___END;
	} else {
		echo <<<___END
		<div class="announcement entity_listing clearfix">
		<div class="entity_listing_icon">
			$owner_icon
		</div>
		<div class="entity_listing_info">
			<div class="entity_metadata">$edit</div>
			<p class="entity_title">$linked_title</p>
			<p class="entity_subtext">
				$author_text
				$date
			</p>
		</div>
		</div>
___END;
	}
?>