var colCount = 0;
var colWidth = 0;
var margin = 15;
var windowWidth = 0;
var blocks = [];
var spaceLeft = 0;


$(function() {

	$("<div class=\'chunk\' />").load("columnContainer/load", function(){
		$(this).appendTo("#columnContainer");
		setupBlocks();
	});

	$("#more").waypoint(function(direction) {
		if (direction === "down") {
			// do something
		};
	}, {
		offset: window.innerHeight
	});

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

function setupBlocks() {
	//console.log('now starting to set up blocks!!');
	windowWidth = $('#columnContainer').width();
	colWidth = $('.block').outerWidth();
	blocks = [];
	colCount = Math.floor((windowWidth+15)/(colWidth+margin));
	spaceLeft = (windowWidth - ((colWidth*colCount)+(margin*(colCount-1)))) / 2;

	for(var i=0;i<colCount;i++) {
		blocks.push(margin);
	}
	positionBlocks();
	setupCommentTextarea();
	// $('.block').show("slow");
}

function setupCommentTextarea() {
	$('textarea').on('focus', function() {
		$(this).css('background', 'none repeat scroll 0 0 #FFFFFF');
	});

	$('textarea').on('blur', function() {
		$(this).css('background', 'none repeat scroll 0 0 #FCF9F9');
	});
}

function positionBlocks() {
	//console.log('now starting to position blocks!');
	$('.block').each(function(){
		var min = Array.min(blocks);
		var index = $.inArray(min, blocks);
		var leftPos = index*(colWidth+margin);
		$(this).css({
			'left':(leftPos+spaceLeft)+'px',
			'top':min+'px'
		});
		blocks[index] = min+$(this).outerHeight()+margin;
		// calculate after add the block the max height in the array to update the height of conlumncontainer
		var max = Array.max(blocks);
		$('#columnContainer').css({
			'height': max+'px'
		});
	});
}

// Function to get the Min value in Array
Array.min = function(array) {
	return Math.min.apply(Math, array);
};

// Function to get the Max value in Array
Array.max = function(array) {
	return Math.max.apply(Math, array);
};

// usually time = 1
function wait(time) {
	setTimeout("setupBlocks()", time * 1000);
}

// a trial function load at start of page for future use
function counter(){
}
