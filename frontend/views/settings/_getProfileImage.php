<?php
/**
 * @var serviceName Gravatar/Twitter/Facebook
 */
?>
<script>
	$(function() {
		$(".get<?php echo $serviceName; ?>Image button").click(function() {
			$.get("/settings/get<?php echo $serviceName; ?>ProfileImage", function(data) {
				if (data) {
					$(".profileImage .img-polaroid").attr("src", data);
				};
			});
		});
	})
</script>