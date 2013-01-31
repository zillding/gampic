// main funciton, called when the page finish loading
$(function(){
	ColumnContainer.init();
	ColumnContainer.setupLoader($("#more"));
	ColumnContainer.load();
})


// define the columnContainer class
// note: for this class, everything has to be global
function ColumnContainer () {
}

ColumnContainer.selector = "#columnContainer"; 
ColumnContainer.itemSelector = ".block";
ColumnContainer.blocks = [];
ColumnContainer.margin = 15;
ColumnContainer.spaceLeft = 0;

ColumnContainer.init = function() {
	console.log("column container instantiated!"); // for debug
};

ColumnContainer.setupLoader = function(loader) {

	loader.waypoint(function(direction) {
		if (direction === "down") {
			console.log("loading next page...");
		};
	}, {
		offset: "bottom-in-view"
	});
};

ColumnContainer.refreshLoader = function() {
	$.waypoints("refresh");
};

ColumnContainer.load = function() {
	$("<div class=\'chunk\' />").load("columnContainer/load", function(){
		$(this).appendTo($(ColumnContainer.selector));
		ColumnContainer.setupBlocks();
		ColumnContainer.refreshLoader(); // refresh the way point to make it more accurate
	});
};

ColumnContainer.setupBlocks = function() {
	ColumnContainer.blocks = []; // reset the array
	ColumnContainer.colWidth = $(ColumnContainer.itemSelector).outerWidth(); // get the column width
	//console.log('now starting to set up blocks!!');
	var windowWidth = $(ColumnContainer.selector).width(); // get the page width
	var colCount = Math.floor((windowWidth+15)/(ColumnContainer.colWidth+ColumnContainer.margin)); // calculate the number of columns
	ColumnContainer.spaceLeft = (windowWidth - ((ColumnContainer.colWidth*colCount)+(ColumnContainer.margin*(colCount-1)))) / 2;

	for(var i=0;i<colCount;i++) {
		ColumnContainer.blocks.push(ColumnContainer.margin);
	}
	ColumnContainer.positionBlocks($(ColumnContainer.itemSelector));
	// setupCommentTextarea();
	// $('.block').show("slow");
};

ColumnContainer.positionBlocks = function(items) {
	items.each(function(){
		var min = Array.min(ColumnContainer.blocks);
		var index = $.inArray(min, ColumnContainer.blocks);
		var leftPos = index*(ColumnContainer.colWidth+ColumnContainer.margin);
		$(this).css({
			'left':(leftPos+ColumnContainer.spaceLeft)+'px',
			'top':min+'px'
		});
		ColumnContainer.blocks[index] = min+$(this).outerHeight()+ColumnContainer.margin;
		// calculate after add the block the max height in the array to update the height of conlumncontainer
		var max = Array.max(ColumnContainer.blocks);
		$(ColumnContainer.selector).css({
			'height': max+'px'
		});
	});

};

// Function to get the Min value in Array
Array.min = function(array) {
	return Math.min.apply(Math, array);
};

// Function to get the Max value in Array
Array.max = function(array) {
	return Math.max.apply(Math, array);
};

/* * * * * */
/*
$(function() {

	// create an event to detect whether the window has done resizing
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger("resizeEnd");
		}, 500);
	});

	$(window).bind("resizeEnd", function() {
		setupBlocks();
	});

});

function setupCommentTextarea() {
	$('textarea').on('focus', function() {
		$(this).css('background', 'none repeat scroll 0 0 #FFFFFF');
	});

	$('textarea').on('blur', function() {
		$(this).css('background', 'none repeat scroll 0 0 #FCF9F9');
	});
}
*/