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

div#announcement-container {
	
}

div#announcement-container div.announcement {
	height: auto;
	width: 100%;
	margin: 8px;
	border: 2px solid #AE002D;
	background: #ededed;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
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

div.announcement-actions span.close-announcement-button {
	background: url("http://localhost/elgg-svn/mod/tgstheme/graphics/elgg_sprites.png") no-repeat scroll -200px -16px transparent;
	height: 14px;
	width: 14px;
	text-align: left;
	text-indent: -9000px;
	display: inline;
}

div.announcement-actions a.close-announcement:hover {
	cursor: pointer;
}

div.announcement-description {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;
}

div.announcement-view-stats {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;	
}

div.announcement-viewers {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;	
}

div.announcement-access-display {
	line-height:1.4em;
    font-size: 11px;
    color: #666666;
    float: right;
	margin-right: 8px;
	margin-top: -15px;
	margin-bottom: 4px;
}

span.viewers-text {
	display: block;
	margin-top: 6px;
	margin-bottom: 10px;
}