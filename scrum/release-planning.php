<!DOCTYPE php>
<php lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Release Planning</title>

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
		<h1 class="text-center">Release Planning</h1>
<h2>What is Release Planning?</h2>
<p>Release Planning is the plan for the next time a customer sess a release.  It is not part of core Scrum.</p>	
<p>look at http://www.romanpichler.com/blog/release-planning-workshop/</p>
<p>Out of the Release Planning Workshop might come the <a href="product-roadmap.php">Product Roadmap</a></p>
<p>You should <a href="estimate.php">Estimate</a> team <a href="velocity.php">Velocity</a> based on <a href="user-story.php">User Story</a> points and then apply this to the <a href="product-backlog.php">Product Backlog</a>.  This will help to identify the items in the <a href="product-backlog.php">Product Backlog</a> that you can deal with within this <a href="release.php">Release</a>.</p>

<p>A <a href="release.php">Release</a> may take place in the following scenarios:</p>
<ul>
	<li>Release on <a href="sprint.php">Sprint</a></li>
	<li>Release on <a href="product-backlog.php">Product Backlog Item</a></li>
	<li>Release on value</li>
	<li>Release on plan</li>
</ul>
<p>The <a href="release.php">Release Date</a> is based on an estimated <a href="velocity.php">Velocity</a> (the count of items achieved per sprint, the <a href="estimate.php">Estimated points</a> for each of those items and the <a href="sprint.php">Sprint</a> cycle periods (i.e. how many Sprints can you get in between the start and the <a href="release.php">Release Date</a></p>.

<p><em>Read http://stackoverflow.com/questions/502731/scrum-when-do-you-estimate-the-effort-for-product-backlog-items</em></p>

<h2>Release Burndown</h2>
<p>This is a graph where the Y Axis shows the remaining <a href="estimate.php">Estimated</a> effort points (<a href="user-story.php">User Story</a> points) and the X Axis shows time (Sprint days).  The puropse is to allow you to inspect progress.</p>
</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</php>