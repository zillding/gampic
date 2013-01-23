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
						<a class="imgLink">
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
						<a class="imgLink">
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
				$likeButtonStatement = '<button class="btn btn-small topButtons likeButton"><i class="icon-thumbs-up"></i> Like</button>';
			} else {
				$likeButtonStatement = '<button class="btn btn-small topButtons likeButton likeButtonDown">Unlike</button>';
			}

			$commentSection = '
				<div class="convo attribution clearfix">' .
					$comment.'
					<div class="comment writeComment">
						<a class="imgLink" href="">
							<img alt="Profile picture of you" src="'.Yii::app()->getGlobalState('userGravatar').'">
						</a>
						<form method="POST" action="">
							<textarea class="gridComment" placeholder="Add a comment..." maxlength="1000"></textarea>
							<button class="btn btn-small commentButton" type="button"><i class="icon-comment"></i> Comment</button>
						</form>
					</div>
				</div>';

		} else {
			$commentSection = '<div class="convo attribution clearfix">'.$comment.'</div>';
			$likeButtonStatement = '<button class="btn btn-small topButtons likeButton">Like</button>';
		}

		$this->content = '<div class="pin">
			<div class="topButtonArea">
				<button class="btn btn-small topButtons shareButton"><i class="icon-share"></i> Share</button>'.$likeButtonStatement.'
			</div>
			<div class="PinHolder">
				<a href="'.Yii::app()->baseUrl.'/images/upload/orig/'.$data['image_id'].'.'.$data['extension'].'" rel="lightbox" class="imgLink bigImgLink" title="'.$data['title'].'">
					<img alt="'. $data['image_id'].'" src="'.Yii::app()->baseUrl.'/images/upload/thumb/'.$data['image_id'].'.'.$data['extension'].'" class="PinImageImg" height="'.$data['thumb_height'].'" />
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