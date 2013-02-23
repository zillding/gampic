<?php
/**
 * view for the disconnectButton
 * @var serviceName Twitter/Facebook
 */
?>
<button href='/settings/disconnect<?php echo $serviceName; ?>' class='btn btn-danger disconnect<?php echo $serviceName; ?>'>
	<i class='icon-remove-sign icon-white'></i> Disconnect
</button>
<script>
$(function() {
	$button = $(".disconnect<?php echo $serviceName; ?>");
	$button.click(function() {
		$.getJSON("/settings/disconnect<?php echo $serviceName; ?>", function(data) {
			if (data) {
				// disconnect success!
				alert('Disconnect to <?php echo $serviceName; ?>!');
				$(".<?php echo strtolower($serviceName); ?>-connection-status").html('<span class="label label-important">Not Connected</span>')
				$button.parent().html('<a href="/<?php echo strtolower($serviceName); ?>" class="zocial <?php echo strtolower($serviceName); ?>">Connect</a>');
			};
		});
	});
})
</script>
