<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actionSearchtwitter()
	{
		$model=new SearchtwitterForm;
		
		if(isset($_POST['SearchtwitterForm']))
		{
			$model->attributes=$_POST['SearchtwitterForm'];
			
			if($model->validate())
			{
				
				$query = array(
					  "q" => $_POST['SearchtwitterForm']['searchtweet'], 
					  "count"=>10,
					  "result_type" => "recent",
					  "include_entities" => "true"
					);
					
					$results = $model->search($query);	
				
			}
		}
		$this->render('searchtwitter1',array('model'=>$model,'results'=>$results));
	}
	
	public function actionUploadmongo()
	{
		
		$tweet = Yii::app()->user->getState("tweet");
		
		$server = "mongodb://localhost:27017/phpmongo";  
		
	
			try{  
			  //konek ke server  
			  $koneksi = new MongoClient( $server );  
			}catch(MongoConnectionException $konekException){  
			  print $konekException;  
			  exit;  
			}  
			  
			//konek ke database phpmongo  
			try{  
			  $db = $koneksi->dbujian;  
			  //ambil data collection  
			  $collection = $db->twitterapi;  
			}catch(MongoException $mongoException){  
			  print $mongoException;  
			  exit;  
			  exit;  
			}  
			
			$count = count($tweet);
			
			for($i=1;$i<=$count;$i++)
			{
				  $ret = $collection->Insert($tweet[$i]);  
			}
			
			
				if(is_array($ret)) {  
				  if($ret["ok"])  
						Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully input to mongo database');
				  else  
						Yii::app()->user->setFlash('error', '<strong>Upload failed!</strong> Your upload  database was failed');
				}else {  
				  if($ret)  
				  		Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully input to mongo database');
				  else  
					Yii::app()->user->setFlash('error', '<strong>Upload failed!</strong> Your upload  database was ');
				}  
			
			Yii::app()->user->tweet = null;
			
			$this->render('uploadmongo');
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	 

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}