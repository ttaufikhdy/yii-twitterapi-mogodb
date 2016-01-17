<?php

class UploadMongo extends CFormModel
{
  
    //define variable in 
    public $user;
    public $tweet;
	public $create_at;
	

    // rule validation
    public function rules()
    {
        return array(
            array('user, tweet,create_at', 'required'),
        );
    }

    //attribute label in form
    public function attributeLabels()
    {
        return array(
            'user'=>'User Twitter',
            'tweet'=>'tweet',
			'create_at'=>'Create At',s
          
        );
    }

    //run it for save data
    public function savemongo()
    {
        try {
            $connection = new Mongo();
            $database = $connection->selectDB('dbujian');
            $collection = $database->selectCollection('collectujian');
            $var = array(
                'user' => new MongoId($this->user),
                'tweet' => new MongoId($this->tweet),
				'create_at' => new MongoId($this->create_at),
            );
            $collection->insert($var,array('safe'=>true));
            return true;
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die('Failed to insert data '.$e->getMessage());
        }
    }

    //run it for update data
    public function editmongo($id)
    {
        try {
            $connection = new Mongo();
            $database = $connection->selectDB('dbujian');
            $collection = $database->selectCollection('collectujian');
            $var = array(
                'user' => $this->user,
                'tweet' => $this->tweet,
                'create_at'=>$this->create_at
            );
            $collection->update(array('_id' => new MongoId($id)),$var);
            $collection->insert($var,array('safe'=>true));
            return true;
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die('Failed to insert data '.$e->getMessage());
        }
    }

    //run it for delete data
    public function deletemongo($id)
    {    
        try {
            $connection = new Mongo();
            $collection = $connection->dbujian->collectujian;
            $collection->remove(array('_id'=>new MongoId($id)));
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die('Failed to do operation '.$e->getMessage());
        }
    }

    // this will return all data from document nilai
    public function findallmongo()
    {
        try {
            $connection = new Mongo();
            $database = $connection->selectDB('dbujian');
            $collection = $database->selectCollection('collectujian');
            $result= $collection->find();

            return $result;
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die($e->getMessage());
        }    
    }

    public function findOneById($id)
    {
        try 
        {
            $connection = new Mongo();
            $database = $connection->selectDB('dbujian');
            $collection = $database->selectCollection('collectujian');
            return $collection->findOne(array('_id'=>new MongoId($id)));
        }
        catch(MongoConnectionException $e) {
            die("Failed to connect to database ".$e->getMessage());
        }
        catch(MongoException $e) {
            die($e->getMessage());
        }    
    }
}

