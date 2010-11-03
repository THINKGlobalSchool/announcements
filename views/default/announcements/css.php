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
	margin: 6px;
	border: 2px solid #AE002D;
	background: #ededed;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-box-shadow: 1px 1px 10px #333333;
	-moz-box-shadow: 1px 1px 10px #333333;
}

div#announcement_container div.announcement:hover {
	background: #ffffff;
}

div.announcement_image {
	background-image: url('<?php echo elgg_get_site_url() . 'mod/announcements/images/alert.png' ?>');
	width: 60px;
	height: 60px;
	float: left;
	margin: 10px;
}

div.announcement_content {
	float: left;
	margin: 10px;
}

div.announcement_content_title {
	
}

div.announcement_content_body {
	font-size: 90%;
}

div.announcement_actions{
	float: right;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 5px;
}

div.announcement_description {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;
}

div.announcement_viewers {
	border-top: 1px solid #CCCCCC;
	margin-top: 10px;
	padding-top: 10px;	
}
