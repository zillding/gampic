<?php
/**
 * Controller.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:55 AM
 */
class Controller extends CController {

	// public $breadcrumbs = array();
	// public $menu = array();

	public function beforeAction($action)
	{
		Yii::app()->clientScript->registerScriptFile('js/setupScrollToTop.js');
		return parent::beforeAction($action);
	}

}
