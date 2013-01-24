<?php

/**
* Block class
*/
class Block
{
	public $imageId; // id of the image
	public $title; // title of the image
	public $extension; // the extension of the image file
	public $thumbHeight;
	public $likes; // the number of likes this image got
	public $liked; // whether this image has been 'liked' by the current user
	public $comments; // an array storing all the comments on this image

	private $_dataKeyMap = array(
		'imageId' => 'image_id',
		'title' => 'image_title',
		'extension' => 'image_extension',
		'thumbHeight' => 'image_thumb_height',
	);

	private $_maxNoOfComments = 3; // set the max no of comments displayed

	/**
	 * construct a block
	 */
	function __construct()
	{
	}

	/**
	 * create create a new block based on passed in image id
	 * @param int the image id
	 * @return boolean whether successfully created the block
	 */
	public function create($imageId='')
	{
		if ($imageId=='') {
			return false;
		}

		$this->getDbData($imageId);
		// Helper::print_arr($data);


		return true;

	}

	/**
	 * getDbData get the data from the database and set the attributes
	 * @param int the image id in the db
	 */
	private function getDbData($imageId)
	{
		$image = Image::model()->find('image_id=:image_id', array(':image_id'=>$imageId));
		$this->imageId = $image[$this->_dataKeyMap['imageId']];
		$this->title = $image[$this->_dataKeyMap['title']];
		$this->extension = $image[$this->_dataKeyMap['extension']];
		$this->thumbHeight = $image[$this->_dataKeyMap['thumbHeight']];
		$this->likes = Like::model()->count('image_id=:image_id', array(':image_id'=>$imageId));
		if (!Yii::app()->user->isGuest) {
			$this->liked = Like::model()->count('user_id=:user_id AND image_id=:image_id', 
				array(':user_id'=>Yii::app()->user->id, ':image_id'=>$imageId));
		}
		$this->comments = Comment::model()->findAll('image_id=:image_id', array(':image_id'=>$imageId));
	}

	/**
	 * displayLikeButton print the like/unlike button
	 */
	public function displayLikeButton()
	{
		if (Yii::app()->user->isGuest or !$this->liked) {
			echo '<button class="btn btn-small topButtons likeButton" data-id="'.$this->imageId.'"><i class="icon-thumbs-up"></i> Like</button>';
		} else {
			echo '<button class="btn btn-small topButtons likeButton likeButtonDown" data-id="'.$this->imageId.'"><i class="icon-thumbs-down"></i> Unlike</button>';
		}
	}

	/**
	 * displayCommentSection print the comment section including other comments and the comment form
	 */
	public function displayCommentSection()
	{
		$comment = '<div class="otherComments">';

		if (count($this->comments) <= $this->_maxNoOfComments) {
			for ($i=0; $i<count($this->comments); $i++) {
				$comment .= '
					<div class="comment">
						<a class="imgLink">
							<img src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<p class="NoImage">
							<a class="userName">'.$this->comments[$i]['user_name'].'</a> '.
							$this->comments[$i]['comment_content'].'
						</p>
					</div>';
			}
			$comment .= '</div>';
		} else {
			for ($i=0; $i<$this->_maxNoOfComments; $i++) {
				$comment .= '
					<div class="comment">
						<a class="imgLink">
							<img src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<p class="NoImage">
							<a class="userName">'.$this->comments[$i]['user_name'].'</a> '.
							$this->comments[$i]['comment_content'].'
						</p>
					</div>';
			}
			$comment .= '</div><div class="commentMore">more comments</div>';
		}

		if (!Yii::app()->user->isGuest) {
			$commentSection = '
				<div class="convo clearfix">' .
					$comment.'
					<div class="comment writeComment">
						<a class="imgLink" href="">
							<img alt="Profile picture of you" src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<form method="POST" action="">
							<textarea placeholder="Add a comment..." maxlength="1000"></textarea>
							<button class="btn btn-small commentButton" type="button"><i class="icon-comment"></i> Comment</button>
						</form>
					</div>
				</div>';

		} else {
			$commentSection = '<div class="convo clearfix">'.$comment.'</div>';
		}
		echo $commentSection;
	}

}
