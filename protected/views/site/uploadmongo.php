<br/><br/>
<?php  
$server = "mongodb://localhost:27017/phpmongo";  

$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));

	try {
            $connection = new MongoClient($server); 
            $database = $connection->selectDB('irsyad');
            $collection = $database->selectCollection('irsyad1');
            $result= $collection->find();
			
			echo '<pre>';
			foreach ( $result as $current )
				print_r($current);
			echo '</pre>';
       
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die($e->getMessage());
        }    

?>
