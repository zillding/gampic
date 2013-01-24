$(function() {
	// scroll to top	
	setupScrollToTop();

	// $.get('columnContainer/load', function(data) {
	// 	$('.columnContainer').append(data);
	// });
	
	// arrange all the blocks in the positions
	// wait(2);

	// create an event to detect whether the window has done resizing
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 500);
	});
	//$(window).resize(setupBlocks);
	$(window).bind('resizeEnd', function() {
		setupBlocks();
	});

});

