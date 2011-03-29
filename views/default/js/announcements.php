<?php
/**
 * Announcements JS
 */
?>
//<script>
elgg.provide('elgg.announcements');

elgg.announcements.init = function() {
	// ajaxify the close and remove button
	$('a.elgg-announcement-close').click(elgg.announcements.close);
}

/**
 * Close an announcement and remove it from the dom.
 */
elgg.announcements.close = function(e) {
	e.preventDefault();

	if (confirm(elgg.echo('announcements:confirmation:close'))) {
		var $announcement = $(this).closest('.elgg-announcement');
		var url = $(this).attr('href');

		elgg.action(url, {
			success: function(json) {
				if (json.result) {
					$announcement.fadeOut('slow');
				}
			}
		});
	}
}

elgg.register_hook_handler('init', 'system', elgg.announcements.init);
//</script>