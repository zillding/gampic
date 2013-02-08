// create the block class
var Block = {
	// for guest only
	setupGuest : function() {
		$(document).on("click", ".block .commentMore button", this.showMoreComments)
			.on("click", ".block .btn .btn-small", function() {
				alert("Please log in first!");
			});
	},

	// for authenticated user
	setupAll: function() {
		$(document).on("click", ".block .likeButton", this.like)
			.on("click", ".block .shareButton", this.share)
			.on("click", ".block .commentButton", this.comment)
			.on("click", ".block .commentMore button", this.showMoreComments);
	},

	like : function() {
		$button = $(this);
		// 'this' refer to the button object
		image_id = $(this).attr("data-id");
		$.getJSON("/block/like/?image_id="+image_id, function(data) {
			if (data) {
				$button.toggleClass('likeButtonDown'); // change the css style of the $button
				likeCount = $button.parentsUntil('.chunk').find('.likeCount'); // get the like count element
				if (data.liked == 1) {
					// this image has successfully been liked
					$button.html('<i class="icon-thumbs-down"></i> Unlike');
					likeCount.html(parseInt(likeCount.html()) + 1);
				} else{
					// this image is unliked successfully
					$button.html('<i class="icon-thumbs-up"></i> Like');
					likeCount.html(parseInt(likeCount.html()) - 1);
				};
			};
		});
	},

	comment : function() {
		image_id = $(this).attr("data-id");
		$block = $(this).parentsUntil('.chunk');
		comment = $block.find('form textarea').val(); // get the comment
		requestData = "image_id="+image_id+"&comment="+comment;
		// show more comments
		$.post("/block/comment", requestData, function(data) {
			if (data) {
				Block.moreComments(image_id, $block);
				$block.find('textarea').val('');
			};
			ColumnContainer.setupBlocks();
		}, "json");
	},

	// bind the the button
	showMoreComments : function() {
		image_id = $(this).attr("data-id");
		$block = $(this).parentsUntil('.chunk');
		Block.moreComments(image_id, $block);
	},

	moreComments : function(image_id, $block) {
		moreComments = "";
		$.getJSON("/block/showComments", "image_id="+image_id, function(data) {
			$.each(data, function(index, comment) {
				moreComments = moreComments + '\
						<div class="comment">\
							<a class="imgLink">\
								<img src="' + comment.user_avatar + '">\
							</a>\
							<p class="NoImage">\
								<a class="userName">' + comment.user_name + '</a> ' + comment.comment + '\
							</p>\
						</div>';
			});
			$block.find('.commentMore').hide();
			$block.find('.otherComments').append(moreComments);
			ColumnContainer.setupBlocks();
		});
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
