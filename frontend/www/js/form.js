$(function () {
	// $(".form-vertical input[type=text]")[0].focus();

	$("form").submit(function() {
		var $subButton = $(this).find(':submit');
		$subButton.attr('disabled', 'disabled').toggleClass('disabled').html('<i class="icon-upload"></i> sending...');
	});
})