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
	$action_url = elgg_get_site_url() . 'action/announcements/close_announcement?guid=' . $vars['entity']->getGUID();
	$action_url = elgg_add_action_tokens_to_url($action_url);
	
?>
<div class='announcement' id='announcement_<?php echo $vars['entity']->getGUID(); ?>'>
	<div class='announcement_image'></div>
		<div class='announcement_content'> 
			<div class='announcement_content_title'><h3><?php echo $announcement->title; ?></h3></div>
			<div class='announcement_content_body'><?php echo $announcement->description; ?></div>
		</div>
	<div class='announcement_actions'>
		<a class='close_announcement' id='<?php echo $vars['entity']->getGUID(); ?>'>Close [x]</a>
	</div>
	<div style='clear: both;'></div>
</div>

<script type='text/javascript'>
$(function() {
	$(".announcement_actions #<?php echo $vars['entity']->getGUID(); ?>").click(function() {
		remove_and_close_announcement("<?php echo $vars['entity']->getGUID(); ?>");
	});
});
</script>
