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
	$(".disconnect<?php echo $serviceName; ?>").click(function() {
		$button = $(this);
		$.getJSON("/settings/disconnect<?php echo $serviceName; ?>", function(data) {
			if (data) {
				// disconnect success!
				alert('Disconnect to <?php echo $serviceName; ?>!');
				// if ($alert = $(".alert-success")) {
				// 	$alert.removeClass('.alert-success').addClass('alert-info').html('<a class="close" data-dismiss="alert">×</a>You have disconnected to <strong><?php echo $serviceName; ?></strong>');
				// };
				$(".<?php echo strtolower($serviceName); ?>-connection-status").html('<span class="label label-important">Not Connected</span>')
				$button.parent().prepend('<a href="/<?php echo strtolower($serviceName); ?>" class="zocial <?php echo strtolower($serviceName); ?>">Connect</a>');
				$button.remove();
			};
		});
	});
})
</script>
