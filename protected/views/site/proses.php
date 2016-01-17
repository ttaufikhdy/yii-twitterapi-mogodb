<?
if(isset($_POST['keyword']))
{
		// Cek Nama Pengguna
		 $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		$credentials = $connection->get("account/verify_credentials");

		function search($query)
		{
		  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		  return $connection->get('search/tweets', $query);
		}

		$query = array(
		  "q" => "$_POST[keyword]", // bisa #jogja atau @jogja
		  "count"=>100,
		  "result_type" => "recent",
		  "include_entities" => "true"
		);
		
		$results = search($query);
		
		echo "<table class='table table-condensed table-bordered table-hover'> <thead> <tr class='success'><th>User</th><th>Tweet</th> </tr></thead>";

		foreach ($results->statuses as $result) {
			$screen = $result->user->screen_name;
			echo "<tr><td> $screen</td><td>$result->text</td></tr>";
		}	
		
		echo "</table>"; 
}

?>