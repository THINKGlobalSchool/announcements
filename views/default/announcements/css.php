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

div#announcement_container {
	
}

div#announcement_container div.announcement {
	height: auto;
	width: 100%;
	margin: 8px;
	border: 2px solid #AE002D;
	background: #ededed;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
}

div#announcement_container div.announcement:hover {
	background: #ffffff;
}

div.announcement_image {
	background-image: url('<?php echo elgg_get_site_url() . 'mod/announcements/images/alert_2.png' ?>');
	width: 60px;
	height: 60px;
	float: left;
	margin: 10px;
}

div.announcement_content {
	margin: 10px;
	padding-bottom: 5px;
}

div.announcement_content_title {
	margin-bottom: 2px;
	float: left;
}

div.announcement_content_body {
	font-size: 90%;
}

div.announcement_content_body img {
	max-width: 470px;
}

div.announcement_actions {
	float: right;
	margin-top: -8px;
}

div.announcement_actions a.close_announcement {
	font-size: 85%;
}

div.announcement_actions a.close_announcement:hover {
	cursor: pointer;
}

div.announcement_description {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;
}

div.announcement_view_stats {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;	
}

div.announcement_viewers {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;	
}

div.announcement_access_display {
	line-height:1.4em;
    font-size: 11px;
    color: #666666;
    float: right;
	margin-right: 8px;
	margin-top: -15px;
	margin-bottom: 4px;
}

span.viewers_text {
	display: block;
	margin-top: 6px;
	margin-bottom: 10px;
}