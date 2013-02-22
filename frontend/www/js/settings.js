$(function() {
	Settings.setup();
});

var Settings =  {
	disconnectTwitterButtonSelector : ".disconnectTwitter",
	disconnectFacebookButtonSelector : ".disconnectFacebook",

	setup : function() {
		$("#profile-form .controls .radio").addClass("inline");
	},

	setupDisconnectTwitter : function() {
		$button = $(this.disconnectTwitterButtonSelector);
		$button.click(function() {
			$.getJSON("/settings/disconnectTwitter", function(data) {
				if (data) {
					// disconnect success!
					alert('Disconnect to Twitter!');
					$(".twitter-connection-status").html('<span class="label label-important">Not Connected</span>')
					$button.parent().html('<a href="/twitter" class="zocial twitter">Connect</a>');
				};
			});
		});
	},

	setupDisconnectFacebook : function() {
		$button = $(this.disconnectFacebookButtonSelector);
		$button.click(function() {
			$.getJSON("/settings/disconnectFacebook", function(data) {
				if (data) {
					// disconnect success!
					alert('Disconnect to Facebook!');
					$(".facebook-connection-status").html('<span class="label label-important">Not Connected</span>')
					$button.parent().html('<a href="/facebook" class="zocial facebook">Connect</a>');
				};
			});
		});
	},


}