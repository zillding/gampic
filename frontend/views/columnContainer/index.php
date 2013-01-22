<?php
/* @var $this ColumnContainerController */
?>
<div id="columnWrapper">
	<div class="columnContainer">
	</div>
</div>

<script>
	$(function() {
		$.get('columnContainer/load', function(data) {
			$('.columnContainer').append(data);
		});
	});
</script>