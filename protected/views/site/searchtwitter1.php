 <?php
require_once YiiBase::getPathOfAlias("webroot") . '/twitteroauth/twitteroauth.php';
$this->pageTitle=Yii::app()->name;
?>

<h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php
define('CONSUMER_KEY', 'Avr29V0jGRAtHaOMpaVypfw10');
define('CONSUMER_SECRET', 'WBItWNYDdHXgthG8elxsrDA16ZcFiPVQupm3UcRUZAOjz9WXcB');
define('ACCESS_TOKEN', '260617426-ky61qCXivWLp4yUyXfGACMwy24mtrBUx305RIf7E'); 
define('ACCESS_TOKEN_SECRET', 'RFePz3oat3MZxYHD2arN0Dm68Zt6kMhIFtnXhyD4QHmj6');
?>

<div class="container">
<div class="row">
 <h3>Searching Twitter By Keyword</h3>
 
 
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'searchtwitter-form',
	'enableClientValidation'=>true,
	'htmlOptions' => array('class'=>well),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="row">
	
		<?php echo $form->labelEx($model,'searchtweet'); ?>
		<?php echo $form->textField($model,'searchtweet'); ?>
		<?php echo $form->error($model,'searchtweet') ; ?>
		
	
</div>
<div style="padding-left:125px">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Search')); ?>
</div>
</div>
<div class="row">
 <?php
 $this->endWidget(); 
 
 $this->widget(
    'bootstrap.widgets.TbBox',
    array(
    'title' => 'Searching Result (Set 20 Record)',
	 'headerIcon' => 'icon-search',
     'content' => $this->renderPartial('searchtwitter',array('results'=>$results),true)

    )
    );
		
?>
</div>
</div>