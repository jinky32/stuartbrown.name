<!DOCTYPE php>
<php lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">Estimating</h1>
			<h2>Estimating Backlog Items</h2>
			<p><a href="development-team.php">Development Team</a> members estimate PBIs.  <a href="product-owners.php">Product Owners</a> user these Estimates to plan and keep track of how delivery is going.  There are various tools to help Estimating, for example <a href="planning-poker.php">Planning Poker</a></p>
			<ul>
				<li>Estimates help understand team <a href="velocity.php">Velocity</a></li>
				<li>Precise / precision is the level of confidence in the interval i.e. an estimate of 1-3 days is less precise than an estimate of one day but more precise than an estimate of 1-7 days</li>
				<li>Accuracy is how close you were with your estimate</li>
				<li>Through <a href="estimate.php">Estimating</a> the team creates its own baselines
				<ul>
					<li>For example you can take a small <a href="product-backlog.php">Product Backlog</a> Item, or one that you understand well, and give it a number.  You can then use this as a guide to measure more complex items.</li>
					<li>try using <a href="fibonacci.php">Fibonacci</a> method for estimating timings.</li>
				</ul>
			</li>
			<li>If team members disagree radically on the estimated time for an item then take the highest time.</li>
		</ul>
		<p>You should <a href="estimate.php">Estimate</a> team <a href="velocity.php">Velocity</a> based on <a href="user-story.php">User Story</a> points and then apply this to the <a href="product-backlog.php">Product Backlog</a>.  This will help to identify the items in the <a href="product-backlog.php">Product Backlog</a> that you can deal with within this <a href="release.php">Release</a>.</p>
		<p><em>Read http://stackoverflow.com/questions/502731/scrum-when-do-you-estimate-the-effort-for-product-backlog-items</em></p>
	<h2>Estimating Tasks</h2>
	<p>Development Team will Estimate Tasks in hours</p>
	</div>
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</php>