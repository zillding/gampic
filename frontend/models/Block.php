<?php
/**
* Block model class
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

	public $latestComment; // string store the latestComment

	private $_dataKeyMap = array(
		'imageId' => 'image_id',
		'title' => 'image_title',
		'extension' => 'image_extension',
		'thumbHeight' => 'image_thumb_height',
	);

	private $_maxNoOfComments = 3; // set the max no of comments displayed

	/**
	 * create create a new block based on passed in image id
	 * @param int the image id
	 * @return boolean whether successfully created the block
	 */
	function __construct($imageId)
	{
		if ($imageId=='') {
			return false;
		} else {
			$this->imageId = $imageId;
			$this->getDbData($imageId);
			return true;
		}
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
		if (!user()->isGuest) {
			$this->liked = Like::model()->count('user_id=:user_id AND image_id=:image_id', 
				array(':user_id'=>user()->id, ':image_id'=>$imageId));
		}
		// need to sort the comments in the descending order of time
		$criteria = new CDbCriteria(array(
			'condition' => 'image_id='.$imageId,
			'order' => 'comment_time ASC'
		));
		$this->comments = Comment::model()->findAll($criteria);
	}

	/**
	 * used to display more comments on the front page
	 * @return array array of comments related infomation
	 */
	public function showComments()
	{
		$comments = array();
		// info needed: user_name, user_avatar, comment
		foreach (array_slice($this->comments, $this->_maxNoOfComments) as $comment) {
			$user = User::model()->findByPk($comment->user_id);
			$userName = $user->user_name;
			$userAvatar = $user->user_avatar;
			$commentContent = $comment->comment_content;
			$comments[] = array('user_name'=>$userName,'user_avatar'=>$userAvatar,'comment'=>$commentContent);
		}
		return $comments;
	}

	/**
	 * displayLikeButton print the like/unlike button
	 */
	public function displayLikeButton()
	{
		if (user()->isGuest or !$this->liked) {
			echo '<button class="btn btn-small topButtons likeButton" data-id="'.$this->imageId.'"><i class="icon-thumbs-up"></i> Like</button>';
		} else {
			echo '<button class="btn btn-small topButtons likeButton likeButtonDown" data-id="'.$this->imageId.'"><i class="icon-thumbs-down"></i> Unlike</button>';
		}
	}

	/**
	 * generate the markup for the other comments section
	 * @return string the html markup for this section
	 */
	private function otherComments()
	{
		$comment = '<div class="otherComments">';

		$end = count($this->comments) <= $this->_maxNoOfComments ? count($this->comments) : $this->_maxNoOfComments;
		for ($i=0; $i<$end; $i++) {
			$user = User::model()->findByPk($this->comments[$i]['user_id']);
			// $userName = User::model()->findByPk($this->comments[$i]['user_id'])->user_name;
			$comment .= '
				<div class="comment">
					<a class="imgLink">
						<img src="'.$user->user_avatar.'">
					</a>
					<p class="NoImage">
						<a class="userName">'.$user->user_name.'</a> '.
						$this->comments[$i]->comment_content.'
					</p>
				</div>';
		}

		$comment .= count($this->comments) <= $this->_maxNoOfComments ? '</div>' : '<div class="commentMore"><button class="btn btn-link btn-mini" data-id="'.$this->imageId.'" style="font-weight:bold;">more comments</button></div></div>';

		return $comment;

	}

	/**
	 * displayCommentSection print the comment section including other comments and the comment form
	 */
	public function displayCommentSection()
	{
		if (!user()->isGuest) {
			$commentSection = '
				<div class="convo clearfix">' .
					$this->otherComments().'
					<div class="comment writeComment">
						<a class="imgLink" href="">
							<img alt="Profile picture of you" src="'.User::model()->findByPk(user()->id)->user_avatar.'">
						</a>
						<form method="POST" action="">
							<textarea placeholder="Add a comment..." maxlength="1000"></textarea>
							<button class="btn btn-small commentButton" type="button" data-id="'.$this->imageId.'"><i class="icon-comment"></i> Comment</button>
						</form>
					</div>
				</div>';

		} else {
			$commentSection = '<div class="convo clearfix">'.$this->otherComments().'</div>';
		}
		echo $commentSection;
	}

	/**
	 * like an image
	 * @return boolean whether the like is successful
	 */
	public function like()
	{
		// like an image
		if (Image::model()->exists('image_id='.$this->imageId)) {
			// the image exists, like/unlike the image
			if (Like::model()->exists('user_id='.user()->id.' AND image_id='.$this->imageId)) {
				// already liked it, unlike it
				if (Like::model()->deleteByPk(array(array('user_id'=>user()->id, 'image_id'=>$this->imageId)))) {
					$this->liked = 0;
					return true;
				}
			} else {
				// like this image
				$like = new Like;
				$like->image_id = $this->imageId;
				$like->user_id = user()->id;
				if ($like->save()) {
					$this->liked = 1;
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * comment an image
	 * @return boolean whether the comment is successful
	 */
	public function comment()
	{
		// comment on an image
		if (Image::model()->exists('image_id='.$this->imageId)) {
			// the image exists, comment the image
			$content = r()->getPost('comment');
			if ($content) {
				$comment = new Comment;
				$comment->comment_content = $content;
				$comment->image_id = $this->imageId;
				$comment->user_id = user()->id;
				$comment->comment_id = Comment::model()->count('image_id='.$this->imageId);
				$comment->comment_time=new CDbExpression('NOW()');
				if ($comment->save()) {
					$this->latestComment = $content;
					return true;
				}
			}
		}
		return false;
	}

}
