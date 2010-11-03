<?php
	/**
	 * Announcements container view
	 * 
	 * @package Announcements
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
	
	$announcement_list_url = elgg_get_site_url() . 'pg/announcements/ajax_list';
	$announcement_close_url = elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/announcements/close_announcement');
?>
<div id="announcement_container"></div>
<script type='text/javascript'>
	function stripJunk(text) {
		return text.replace("amp;", '');
	}

	function load_announcements() {
		$.ajax({
			type: "GET",
			url: "<?php echo $announcement_list_url ?>",
			cache: false,
			success: function(data){
				$("#announcement_container").html(data);
			}
		});
	}
	
	function remove_and_close_announcement(guid) {
		$("#announcement_" + guid).fadeOut('slow', function() {
			$.ajax({
				url: stripJunk("<?php echo $announcement_close_url ?>"),
				type: "POST",
				data: "guid=" + guid,
				cache: false,
				dataType: "json",
				error: function() {
					console.log('There was an error');
				},
				success: function(data){
					load_announcements();					
				}
			});
		  });
	}
	
	$(document).ready(function() {
			load_announcements();
	});
</script>