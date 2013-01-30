// this is the main.js
// should contain the js which is utilized across the entire site

$(function() {
	// create a new scroller
	var scroller = new Scroller($(".scrollToTop"));
	// define when the scroller shows up
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			scroller.fadeIn();
		} else {
			scroller.fadeOut();
		}
	});
	// prepare the "click" event to the scroller
	scroller.selector.click(scroller.scrollToTop);

});
