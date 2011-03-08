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
$action_url = elgg_get_site_url() . 'action/announcements/close?guid=' . $vars['entity']->getGUID();
$action_url = elgg_add_action_tokens_to_url($action_url);
		
switch ($announcement->access_id) {
	case -1: 
		$access_content = 'Default';
		break;
	case 0: 
		$access_content = 'Private';
		break;
	case 1: 
		$access_content = 'Logged In Users';
		break;
	case 2:
		$access_content = 'Public';
		break;
	case -2 :
		$access_content = 'Friends Only';
		break;
	default:
		$acl = get_access_collection($announcement->access_id);
		$access_content = $acl->name;
		break;
}
	
$close_text = elgg_echo('announcements:label:close')

?>
<div class='announcement' id='announcement-<?php echo $vars['entity']->getGUID(); ?>'>
	<div class='announcement-content'> 
		<div class='announcement-content-title'>
			<h3><?php echo $announcement->title; ?></h3>
		</div>
		<div class='announcement-actions'>
			<a class='close-announcement' id='<?php echo $vars['entity']->getGUID(); ?>'><?php echo $close_text; ?> <span class='close-announcement-button'>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
		</div>
		<div style='clear: both;'></div>
		<div class='announcement-content-body'><?php echo $announcement->description; ?></div>
	</div>
	<div style='clear: both;'></div>
	<div class='announcement-access-display'>
		<?php echo $access_content; ?>
	</div> 
	<div style='clear: both;'></div>
</div>


<script type='text/javascript'>
$(function() {
	$(".announcement-actions #<?php echo $vars['entity']->getGUID(); ?>").click(function() {
		remove_and_close_announcement("<?php echo $vars['entity']->getGUID(); ?>");
	});
});
</script>
