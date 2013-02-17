// define the columnContainer class
// note: for this class, everything has to be global, that why use this pattern
var ColumnContainer = {
	loadLink : "",
	params : {},

	selector : "#columnContainer",  // define the container
	itemSelector : ".block", // define the items need to be arranged
	noMoreSelector: "#noMore",
	blocks : [],
	margin : 15,
	spaceLeft : 0,
	// initialize the load page variable
	page : 0,

	setupLoader : function(loader) {
		// set the loader
		ColumnContainer.loader = loader;
		$(ColumnContainer.selector).waypoint(function(direction) {
			if (direction === "down") {
				// display the loader
				loader.fadeIn();
				// waypoint reached, load next page
				params = $.extend(ColumnContainer.params, {page:++ColumnContainer.page});
				ColumnContainer.load(ColumnContainer.loadLink, params, false, ColumnContainer.finishLoad);
			};
		}, {
			// trigger when the bottom of the columnContainer come into view
			offset: "bottom-in-view"
		});
	},

	// this function is a callback function passed to load function
	// it exectutes when loading is done
	finishLoad : function() {
		// check whether there are more images to display
		// in order to display any indication
		if ($(ColumnContainer.noMoreSelector).length) {
			// no more image to display
			$.waypoints("destroy");
			$(ColumnContainer.noMoreSelector).fadeIn();
			setTimeout(function() {
				$(ColumnContainer.noMoreSelector).fadeOut();
			}, 1000);
		};
		// use fancybox to display images
		ColumnContainer.setupFancyBox();
	},

	setupFancyBox : function() {
		items = $(ColumnContainer.selector + " " + ColumnContainer.itemSelector + " .fancybox");
		items.fancybox({
			beforeShow: function () {
				title = this.title;
				if (this.title) {
					console.log(this.href);
					// New line
					this.title += '<br /><div class="social" style="margin-top:5px;">';

					// Add tweet button
					this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-text="Check out an awesome image at Gampic! ' + title + '" data-url="http://gampic.com' + this.href + '">Tweet</a>';

					// Add FaceBook like button
					this.title += '<div class="fb-like" data-href="http://gampic.com' + this.href + '" data-send="false" data-layout="button_count" data-width="500" data-show-faces="true"></div><script>$(function() {FB.XFBML.parse();})</script>';
				}
			},
			afterShow: function() {
				// Render tweet button
				twttr.widgets.load();
			},
			openEffect : 'elastic',
			closeEffect : 'elastic',
			prevEffect : 'none',
			nextEffect : 'none',
			closeBtn : false,
			helpers : {
				title : { type : 'inside' },
				buttons	: {
					position: 'top'
				},
				overlay : {
				}
			}
		});
	},

	refreshLoader : function() {
		$.waypoints("refresh");
	},
	/**
	 * load pictures
	 * @param  {string} url the link which the ajax send request to in order to get data
	 * @param  {plain object/string} params the params that is sent to the server with the request
	 * @param  {boolean} newFlag whether this is the first time to load images
	 * @param  {function} callback the call back function
	 */
	load : function(url, params, newFlag, callback) {
		$("<div class=\'chunk\' />").load(url, params, function(){
			$(this).appendTo($(ColumnContainer.selector));
			// remove the loader
			ColumnContainer.loader.fadeOut();
			if (newFlag) {
				// first time load
				ColumnContainer.setupBlocks();
			} else{
				// not the first time
				ColumnContainer.positionBlocks(ColumnContainer.selector + " .chunk:last " + ColumnContainer.itemSelector);
			};
			ColumnContainer.refreshLoader(); // refresh the way point to make it more accurate
			callback();
		});
	},
	/**
	 * arrange all the items identified by the passed-in param
	 * @param  {string} itemSelector string representation of the items which need arranging
	 */
	setupBlocks : function(itemSelector) {
		var itemSelector = (typeof itemSelector === "undefined") ? ColumnContainer.itemSelector : itemSelector;
		ColumnContainer.blocks = []; // reset the array
		ColumnContainer.colWidth = $(ColumnContainer.itemSelector).outerWidth(); // get the column width
		var windowWidth = $(ColumnContainer.selector).width(); // get the page width
		var colCount = Math.floor((windowWidth+15)/(ColumnContainer.colWidth+ColumnContainer.margin)); // calculate the number of columns
		ColumnContainer.spaceLeft = (windowWidth - ((ColumnContainer.colWidth*colCount)+(ColumnContainer.margin*(colCount-1)))) / 2;

		for(var i=0;i<colCount;i++) {
			ColumnContainer.blocks.push(ColumnContainer.margin);
		}
		ColumnContainer.positionBlocks(itemSelector);
		// setupCommentTextarea();
		// $('.block').show("slow");
	},
	/**
	 * arrange all the items in tiles
	 * @param {string} itemSelector string representation of the item which need arranging
	 */
	positionBlocks : function(itemSelector) {
		$(itemSelector).each(function(){
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
		$(ColumnContainer.itemSelector).show("slow");
	},

	start : function(loadLink, params) {
		this.loadLink = loadLink;
		this.params = params;

		ColumnContainer.load(loadLink, params, true, ColumnContainer.finishLoad);

		// create an event to detect whether the window has done resizing
		$(window).resize(function() {
			if(this.resizeTo) clearTimeout(this.resizeTo);
			this.resizeTo = setTimeout(function() {
				$(this).trigger("resizeEnd");
			}, 500);
		});
		// if the window is resized, need to re-arrange all blocks
		$(window).bind("resizeEnd", function() {
			ColumnContainer.setupBlocks();
		});

		// set up the loader
		ColumnContainer.setupLoader($("#more"));
	}
}
// Function to get the Min value in Array
Array.min = function(array) {
	return Math.min.apply(Math, array);
};

// Function to get the Max value in Array
Array.max = function(array) {
	return Math.max.apply(Math, array);
};

