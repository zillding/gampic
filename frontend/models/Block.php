<?php

/**
* Block class
*/
class Block
{
	public $content;
	private $_maxNoOfComments = 3;
	
	function __construct($data)
	{
		// Helper::print_arr($data);

		$comment = '<div class="otherComments">';
		if (count($data['comments']) <= $this->_maxNoOfComments) {
			for ($i=0; $i<count($data['comments']); $i++) {
				$comment .= '
					<div class="comment">
						<a class="ImgLink">
							<img src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<p class="NoImage">
							<a class="userName">'.$data['comments'][$i]['user_name'].'</a> '.
							$data['comments'][$i]['comment_content'].'
						</p>
					</div>';
			}
			$comment .= '</div>';
		} else {
			for ($i=0; $i<$this->_maxNoOfComments; $i++) {
				$comment .= '
					<div class="comment">
						<a class="ImgLink">
							<img src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<p class="NoImage">
							<a class="userName">'.$data['comment'][$i]['user_name'].'</a> '.
							$data['comment'][$i]['comment_content'].'
						</p>
					</div>';
			}
			$comment .= '</div><div class="commentMore">more comments</div>';
		}

		if (!Yii::app()->user->isGuest) {

			if ($data['liked'] == '0') {
				$likeButtonStatement = '<button class="likeButton">like</button>';
			} else {
				$likeButtonStatement = '<button class="likeButton likeButtonDown">unlike</button>';
			}

			$commentSection = '
				<div class="convo attribution clearfix">' .
					$comment.'
					<div class="comment writeComment">
						<a class="ImgLink" href="">
							<img alt="Profile picture of you" src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<form method="POST" action="">
							<textarea class="gridComment" placeholder="Add a comment..." maxlength="1000"></textarea>
							<button class="commentButton" type="button">Comment</button>
						</form>
					</div>
				</div>';

		} else {
			$commentSection = '<div class="convo attribution clearfix">'.$comment.'</div>';
			$likeButtonStatement = '<button class="likeButton">like</button>';
		}

		$this->content = '<div class="pin">
			<div class="buttons">
				<button class="shareButton">share</button>'.$likeButtonStatement.'
			</div>
			<div class="PinHolder">
				<a href="'.Yii::app()->baseUrl.'/images/upload/orig/'.$data['image_id'].'.'.$data['extension'].'" rel="lightbox" class="ImgLink bigImgLink" title="'.$data['title'].'">
					<img alt="'. $data['image_id'].'" src="'.Yii::app()->baseUrl.'/images/upload/thumb/'.$data['image_id'].'.'.$data['extension'].'" class="PinImageImg" />
				</a>
			</div>
			<p class="description">'.$data['title'].'</p>
			<p class="status">
				<span class="likeCount">'.$data['likes'].'</span> like(s)
			</p>'.
			$commentSection.'
		</div>';
	}

}