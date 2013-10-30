<?php
	/**
	 * Announcements CSS
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
?>


span.elgg-announcement-access-display {
	line-height:1.4em;
    font-size: 11px;
    color: #666666;
    float: right;
	margin-bottom: -5px;
}

.elgg-widget-instance-announcements span.elgg-announcement-access-display {
	margin-bottom: 0px;
}

div.elgg-announcement-description {
	border-top: 1px solid #CCCCCC;
	border-bottom: 1px solid #CCCCCC;

	margin: 10px auto;
	padding: 10px 0;
}

.elgg-announcement-close {
	float: right;
}

/*

@todo this is left in so life will be easier for retheming.

.elgg-announcement {
	border: 2px solid #AE002D;
	background: #ededed;
}

div#announcement-container div.announcement:hover {
	background: #ffffff;
}

div.announcement-image {
	background-image: url('<?php echo elgg_get_site_url() . 'mod/announcements/graphics/alert_2.png' ?>');
	width: 60px;
	height: 60px;
	float: left;
	margin: 10px;
}


div.announcement-content {
	margin: 10px;
	padding-bottom: 5px;
}

div.announcement-content-title {
	margin-bottom: 2px;
	float: left;
}

div.announcement-content-body {
	font-size: 90%;
}

div.announcement-content-body img {
	max-width: 470px;
}

div.announcement-actions {
	float: right;
	margin-top: -8px;
}

div.announcement-actions a.close-announcement {
	font-weight: bold;
	font-size: 90%;
}

div.announcement-actions a.close-announcement:hover {
	cursor: pointer;
}
*/