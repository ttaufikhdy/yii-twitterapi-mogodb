<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SearchtwitterForm extends CFormModel
{
	public $searchtweet;
	

	public function rules()
	{
		return array(
			// username and password are required
			array('searchtweet', 'required'),
		
		);
	}

				
	public function search($query)
	{
	
				require_once YiiBase::getPathOfAlias("webroot") . '/twitteroauth/twitteroauth.php';
			

				   define('CONSUMER_KEY', 'Avr29V0jGRAtHaOMpaVypfw10');
					define('CONSUMER_SECRET', 'WBItWNYDdHXgthG8elxsrDA16ZcFiPVQupm3UcRUZAOjz9WXcB');
					define('ACCESS_TOKEN', '260617426-ky61qCXivWLp4yUyXfGACMwy24mtrBUx305RIf7E'); 
					define('ACCESS_TOKEN_SECRET', 'RFePz3oat3MZxYHD2arN0Dm68Zt6kMhIFtnXhyD4QHmj6');
					$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
					$credentials = $connection->get("account/verify_credentials");
					
				    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
				    return $connection->get('search/tweets', $query);
					 	
	}

			
			
	public function attributeLabels()
	{
		return array(
			'searchtweet'=>'Searching',
		);
	}
}
