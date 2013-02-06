// main function called at the page load
$(function() {
	Block.setupSocialButtons();
})

// create the block class
var Block = {
	setupSocialButtons: function() {
		this.setupLikeButton();
		this.setupShareButton();
		this.setupCommentButton();
	},

	setupLikeButton: function() {
		$(document).on("click", ".block .likeButton", this.like);
	},
	setupShareButton: function() {
		$(document).on("click", ".block .shareButton", this.share);
	},
	setupCommentButton: function() {
		$(document).on("click", ".block .commentButton", this.comment);
	}	,

	like : function() {
		button = $(this);
		// 'this' refer to the button object
		image_id = $(this).attr("data-id");
		$.getJSON("/block/like/?image_id="+image_id, function(data) {
			if (data) {
				button.toggleClass('likeButtonDown'); // change the css style of the button
				likeCount = button.parentsUntil('.chunk').find('.likeCount'); // get the like count element
				if (data.liked == 1) {
					// this image has successfully been liked
					button.html('<i class="icon-thumbs-down"></i> Unlike');
					likeCount.html(parseInt(likeCount.html()) + 1);
				} else{
					// this image is unliked successfully
					button.html('<i class="icon-thumbs-up"></i> Like');
					likeCount.html(parseInt(likeCount.html()) - 1);
				};
			};
		});
	},

	comment : function() {
		image_id = $(this).attr("data-id");
		block = $(this).parentsUntil('.chunk');
		comment = block.find('form textarea').val(); // get the comment
		requestData = "image_id="+image_id+"&comment="+comment;
		$.post("/block/comment", requestData, function(data) {
			if (data) {
				// comment successfully, update the view
				// define comment
				commentSection = '\
						<div class="comment">\
							<a class="imgLink">\
								<img src="' + data.user_avatar + '">\
							</a>\
							<p class="NoImage">\
								<a class="userName">' + data.user_name + '</a> ' + data.comment + '\
							</p>\
						</div>';

				// append the comment after all other comments
				block.find('.otherComments').append(commentSection);
			};
			ColumnContainer.setupBlocks();
		}, "json");
	},

	share : function() {
		console.log("share");
	}

}

/*
$(document).ready(function() {
	// set up the share button
	$('.shareButton').live('click', function() {
		if (fb_loggedIN != true) {
			alert('Please log in with your facebook first!');
		} else {
			var imageURL = $(this).parent().parent().find('.bigImgLink').attr('href');
			graphStreamPublish(imageURL);
		}
	});
});
*/
