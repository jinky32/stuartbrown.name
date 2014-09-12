<!DOCTYPE php>
<php lang="">
<head>
	<?php include('../scrum/includes/gcs.php');?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sprint Planning</title>
	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../scrum/css/custom.css" rel="stylesheet">
	<!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<h1 class="text-center">Sprint Planning</h1>
		<div class="row">
			<div class="col-sm-8 blog-main">
				<p>There are two parts to Sprint Planning:</p>
				<ol>
					<li>What - Define the <a href="sprint-goal.php">Sprint Goal</a></li>
					<li>How</li>
				</ol>
				<p>At the end of each <a href="sprint.php">Sprint</a> there is a usesable output (a 'shipable increment') for the customer (not necessarily the same thing as an end user.  Not all Sprints result in a public <a href="release.php">Release</a> however.</p>
				<p>At the Sprint Planning Meeting the:</p>
				<ul>
					<li><a href="definition-of-done.php">Definition of Done</a> and <a href="definition-of-ready.php">Defintion of Ready</a> are either defined or re-articulated based on previous versions.
					The Definition of Done defines a potentially shippable product increment appropritae for its environment.  In many ways the elements 
					that comprise a team's Definition of Done are like <a href="acceptance-criteria.php">Acceptance Criteria</a> applied across all
					<a href="user-story.php">User Stories</a> on the <a href="product-backlog.php">Product Backlog</a>.</li>
					<li><a href="product-backlog.php">Product Backlog Items</a> are selected for consideration in the <a href="sprint.php">Sprint</a>.</li>
					<li>From the selected PBIs <a href="tasks.php">Tasks</a>are defined by the <a href="development-team.php">Development Team</a> (with discussion / clarification form the <a href="product-owner.php">Product Owner</a>).  These Tasks are then <a href="estimate.php">Estimated</a> by the Development Team and assigned a time in hours.</li>
				</ul>
				<p>This results in the creation of the <a href="sprint-backlog.php">Sprint Backlog</a> that the Development Team commits to.</p>
			<p>Make sure that you plan in this <a href="sprint.php">Sprint</a> for the next one.</p>
			<div class="alert alert-success" role="alert"><p>Discuss the <a href="product-backlog.php">Product Backlog</a>.  Identify th e
			top five items in need of advance thinking.  For each discuss who needs to think about it (an architect, a user experience designer?) and decide how
			many sprints in advance that should begin</p>
			</div>
			<div class="alert alert-success" role="alert"><p>In your next three <a href="sprint-review.php">Sprint Reviews</a>, discuss whether
			 each <a href="product-backlog.php">Product Backlog Item</a> item included just enough detail and whether it was added just in time</p>
			</div>
			<div class="alert alert-success" role="alert"><p>For a <a href="sprint.php">Sprint</a> or two, track the amount of time spent thinking ahead.
			Is it enough? too much? Remember that normally about 10% of a team's available time should be spent looking ahead.</p>
			</div>
			</div>
			<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
			<?php include('../scrum/includes/sprint-artifacts.php');?>
			<?php include('../scrum/includes/sprint-details.php');?>
			<?php include('../scrum/includes/sprint-meetings.php');?>
			<?php include('../scrum/includes/sprint-participants.php');?>
		</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</php>