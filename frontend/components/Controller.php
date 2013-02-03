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
		// include some js which is globally shared across the site
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/scroller.js', CClientScript::POS_END);
		// to make the dropdown list show on hover
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/twitter-bootstrap-hover-dropdown.min.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScript('dropdownOnHover', '$(function() {$(".dropdown-toggle").dropdownHover();})', CClientScript::POS_END);
		parent::init();
	}

}
