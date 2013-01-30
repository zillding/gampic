// set up the scroll to top img
// function setupScrollToTop() {
// 	// auto hide the scroll to top icon
// 	// after click the button
// 	$('.scrollToTop').click(function(){
// 		$("html, body").animate({ scrollTop: 0 }, 600);
// 		return false;
// 	});
// }

// the new scroller class
function Scroller (selector) {
	// for debug
	console.log("new scroller instantiated: " + selector);
	this.selector = selector;
	this.scrollToTop(); // force to scroll to top when refresh the page
}
// install the scroll to top method
Scroller.prototype.scrollToTop = function() {
	// assume the seconds passed in is a valid number
	$("html, body").animate({ scrollTop: 0 }, 600);// todo: the scroll to top bug!
};

Scroller.prototype.fadeIn = function() {
	this.selector.fadeIn();
};

Scroller.prototype.fadeOut = function() {
	this.selector.fadeOut();
};
