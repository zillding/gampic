<?php $this->pageTitle=Yii::app()->name; ?>

<!-- <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1> -->

<div class="banner">
	<ul class="scroller">
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/diablo3.jpg" width="482" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/warcraft_1.jpg" width="333" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/starcraft_1.jpg" width="364" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/warcraft_2.jpg" width="213" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/starcraft_2.jpg" width="375" height="250"></li>
	</ul>
</div>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/banner.js"></script>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<?php

$gridDataProvider = new CArrayDataProvider(array(
	array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS'),
	array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript'),
	array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML'),
));

?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$gridDataProvider,
	'template'=>"{items}",
	'columns'=>array(
		array('name'=>'id', 'header'=>'#'),
		array('name'=>'firstName', 'header'=>'First name'),
		array('name'=>'lastName', 'header'=>'Last name'),
		array('name'=>'language', 'header'=>'Language'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data["id"]))',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["id"]))',
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data["id"]))',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>