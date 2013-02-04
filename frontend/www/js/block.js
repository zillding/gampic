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
		button = $(this);
		image_id = button.attr("data-id");
		comment = button.parentsUntil('.chunk').find('form textarea').val(); // get the comment
		requestData = "image_id="+image_id+"&comment="+comment;
		$.post("/block/comment", requestData, function(data) {
			if (data) {
				// comment successfully, update the view
				console.log(data);
				// define comment
				commentSection = '\
						<div class="comment">\
							<a class="ImgLink">\
								<img src="">\
							</a>\
							<p class="NoImage">\
								<a class="userName"></a> ' + data.comment + '\
							</p>\
						</div>';

				// append the comment after all other comments
				button.parentsUntil('.chunk').find('.otherComments').append(commentSection);
			};
		}, "json");
	},

	share : function() {
		console.log("share");
	}

}

/*
$(document).ready(function() {

	// set up the comment button
	$('.commentButton').live('click', function() {
		$comment = $(this).parent().find('textarea').val();
		if ($comment !== "") {
			$image_id = $(this).parent().parent().parent().parent().find('.PinImageImg').attr('alt');
			$requestData = 'image_id=' + $image_id + '&comment=' + $comment;
			//console.log($(this).parent().find('textarea').serialize());
			$.post(ROOT_URL + 'all/comment', $requestData, function(data) {
				//alert(data);
			});
			// define comment
			$commentSection = '\
					<div class="comment">\
						<a class="ImgLink">\
							<img src="' + ROOT_URL + 'public/img/avatar.jpg">\
						</a>\
						<p class="NoImage">\
							<a class="userName">' + user_name + '</a> ' + $comment + '\
						</p>\
					</div>';

			// append the comment after all other comments
			$(this).parent().parent().parent().parent().find('.otherComments').append($commentSection);
			// clear the textarea
			$(this).parent().find('textarea').val('Add a comment...');
			setupBlocks();
		}
	});

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
