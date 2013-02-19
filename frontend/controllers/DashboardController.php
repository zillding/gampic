<?php

class DashboardController extends Controller
{
	public $user; // the user cactiverecord in the db table tbl_user

	public function init()
	{
		regJsFile('dashboard');
		regLessFile('dashboard');
		regCssFile('zocial');
		if (!user()->isGuest) {
			$this->user = User::model()->findByPk(user()->id);
		}
		parent::init();
	}

	/**
	 * load the dashboard js to pass the user name
	 * @param  string $userName
	 */
	public function loadJs($userName)
	{
		// pass the user name
		cs()->registerScript('startDashboardColumnContainer', 
			'$(function() {
				Dashboard.start("'.$userName.'");
			})', CClientScript::POS_END);
	}

	public function actionIndex()
	{
		if (user()->isGuest) {
			throw new CHttpException(404, 'The page does not exist');
		} else {
			$this->render('index', array('user'=>$this->user));
		}
	}

	public function actionShow()
	{
		// get the user name and render his/her dashboard
		$userName = r()->getQuery('user');
		if (!isset($userName)) {
			throw new CHttpException(404, 'unspecified user');
		}

		$this->user = User::model()->find('user_name=?', array($userName));
		if (!$this->user) {
			throw new CHttpException(404, 'cannot find user: '.$userName);
		} else {
			$this->render('index', array('user'=>$this->user));
		}

	}

	/**
	 * add this section on the site
	 */
	public function addColumnContainer()
	{
		// create a column container controller to manage this section
		$columnContainer = new ColumnContainerController('columnContainer');
		$columnContainer->initialize('/dashboard/added', array('user'=>$this->user->user_name));
	}

	public function actionAdded()
	{
		// validate the user name
		$userName = r()->getPost("user"); 
		if (!isset($userName)) {
			throw new CHttpException(404, 'undefined user');
		} else {
			$user = User::model()->find('user_name=?', array($userName));
			if (!$user) {
				throw new CHttpException(404, 'unidentified user: '.$userName);
			} else {
				$page = r()->getPost("page");
				$page = isset($page) ? $page : 0;
				if (TypeValidator::isInt($page)) {
					// need to pass in a page param
					// load some images
					$model = new Dashboard($user);
					if ($model->hasMoreAdded($page)) {
						// there are un-displayed images
						echo $model->loadAdded($page);
					} else {
						// no more images to display
						echo $this->renderPartial('//columnContainer/_noMore', array(), true);
					}
				} else {
					throw new CHttpException(404, 'unidentified param page: '.$page);
				}
			}
		}
	}

	public function actionLikes()
	{
		// validate the user name
		$userName = r()->getPost("user"); 
		if (!isset($userName)) {
			throw new CHttpException(404, 'undefined user');
		} else {
			$user = User::model()->find('user_name=?', array($userName));
			if (!$user) {
				throw new CHttpException(404, 'unidentified user: '.$userName);
			} else {
				$page = r()->getPost("page");
				$page = isset($page) ? $page : 0;
				if (TypeValidator::isInt($page)) {
					// need to pass in a page param
					// load some images
					$model = new Dashboard($user);
					if ($model->hasMoreLikes($page)) {
						// there are un-displayed images
						echo $model->loadLikes($page);
					} else {
						// no more images to display
						echo $this->renderPartial('//columnContainer/_noMore', array(), true);
					}
				} else {
					throw new CHttpException(404, 'unidentified param page: '.$page);
				}
			}
		}
	}

	public function displayUserAvatar()
	{
		$size = 100;
		echo img($this->user->user_avatar, $this->user->user_name, $size, $size, array('class'=>'img-polaroid'));
	}

	public function editProfileButton()
	{
		$editProfileButton = "";

		if (!user()->isGuest) {
			if (user()->name == $this->user->user_name) {
				$editProfileButton = '<a class="btn btn-inverse pull-right editProfile">Edit Profile</a>';
			}
		}

		return $editProfileButton;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}