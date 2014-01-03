<?php
//$months  = array('january', 'february', 'march', 'april', 'may');
//echo $months[4];

$months = array(
	'january'=>'http://www.bbc.co.uk',
	'February'=>'http://www.bbc.co.uk',
	'March'=>'http://www.bbc.co.uk',
	'April'=>'http://www.bbc.co.uk',
	'May'=>'http://www.bbc.co.uk',
	'June'=>'http://www.bbc.co.uk',
	)

?>
<html>
	<head>
		<title>My page</title>
	</head>
	<body>
		<h1>My site</h1>
		<?php
		$name = "Stuart Brown";
		echo "hello " . $name;

		?>
		<ul>
		<?php

		array_push($months, 'test');
		//foreach ($months as $month) {
			//echo "<li>$month</li>";

		foreach ($months as $month => $url)
		{
			echo "<li><a href='$url'>$month</a></li>";
		}
		?>
		</ul>
		
	</body>
</html>