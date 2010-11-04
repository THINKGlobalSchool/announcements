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
	/*border: 1px solid #AE002D;*/
	border: 1px solid #CCCCCC;
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
	float: left;
	margin: 10px;
}

div.announcement_content_title {
	width: 100%;
	margin-bottom: 2px;
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

div.announcement_access_display {
	line-height:1.4em;
    font-size: 11px;
    color: #666666;
    float: right;
	margin-right: 8px;
	margin-top: -15px;
	margin-bottom: 4px;
}