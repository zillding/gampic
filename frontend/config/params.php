<?php
/**
 * params.php
 *
 * Holds frontend specific application parameters.
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 1:38 PM
 */

$paramsLocalFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'params-local.php';
$paramsLocalFileArray = file_exists($paramsLocalFile) ? require($paramsLocalFile) : array();

$paramsEnvFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'params-env.php';
$paramsEnvFileArray = file_exists($paramsEnvFile) ? require($paramsEnvFile) : array();

$paramsCommonFile = $frontendConfigDir . DIRECTORY_SEPARATOR  . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
		'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'params.php';

$paramsCommonArray = file_exists($paramsCommonFile) ? require($paramsCommonFile) : array();

return CMap::mergeArray(
	$paramsCommonArray,
	// merge frontend specific with resulting env-local merge *override by local
	CMap::mergeArray(
		array(
			'originalImagePath' => dirname(dirname(__FILE__)).'/www/images/upload/orig',
			'thumbnailImagePath' => dirname(dirname(__FILE__)).'/www/images/upload/thumb',
			// 'originalImageDirUrl' => Yii::app()->baseUrl.'/www/images/upload/orig',
			// 'thumbnailImageDirUrl' => Yii::app()->baseUrl.'/www/images/upload/thumb',
			'url.rules' => array(
				/* for REST please @see http://www.yiiframework.com/wiki/175/how-to-create-a-rest-api/ */
				/* other @see http://www.yiiframework.com/doc/guide/1.1/en/topics.url */
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
			// add here all frontend-specific parameters
		),
		// merge environment parameters with local *override by local
		CMap::mergeArray($paramsEnvFileArray, $paramsLocalFileArray)
	)
);