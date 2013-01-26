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

	public function init()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/setupScrollToTop.js');
		// Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/script.js'); 
		parent::init();
	}

}
