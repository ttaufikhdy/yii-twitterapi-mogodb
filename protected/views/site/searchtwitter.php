<?php
	if(isset($results))
	{
				
		echo "<table class='table table-condensed table-bordered table-hover'> <thead> <tr class='success'><th>User</th><th>Tweet</th><th>Create at</th>  </tr></thead>";
		$data = array();
		$i=1;
		foreach ($results->statuses as $result) {
			$screen = $result->user->screen_name;
			$data[$i] = array(  
					  array(  
						"screen_name" => "$screen",  
						"tweet" => "$result->text",  
						"create_at" => "$result->created_at"  
					  )
					);  
			echo "<tr><td> $screen</td><td>$result->text</td><td>$result->created_at</td></tr>";
			$i++;
		}	
		echo "</table>"; 
		
		 Yii::app()->user->setState("tweet",$data); 

		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'contact-form',
			'enableClientValidation'=>true,
			'action'=>Yii::app()->createUrl('site/UploadMongo',array('id'=>$data)),
			
		)); 

		 
		?>
		<a href="<?php echo Yii::app()->controller->createUrl('site/UploadMongo');?>" target="_blank">
		<button type="button" class="btn btn-primary btn-primary"><i class="fa  fa-file-pdf-o "></i> Save Database</button></a> 
		<?php
			$this->endWidget(); 
	}
		
?>
	

