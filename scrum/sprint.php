<!DOCTYPE php>
<php lang="">
<head>
	<?php include('../scrum/includes/gcs.php');?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sprint</title>
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
		
		<h1 class="text-center">Sprint</h1>
		<div class="row">
			<div class="col-sm-8 blog-main">
				
				<h2>Deliver Working Software Each Sprint</h2>
				<p>By the end of each Sprint a Scrum Team is required to produce working software (a 'shipable increment') for the customer (not necessarily the same thing as an end user).  Not all Sprints result in a public <a href="release.php">Release</a> however.</p>
				<p> Agile methodologies emphasise working software for three key reasons:</p>
				<ol>
					<li>Working software encourages feedback.</li>
					<li>Working software helps a team guage its progress</li>
					<li>Working software allows the product to ship early if desired.</li>
				</ol>
				<p>During a Sprint the <a href="development-team.php">Development Team</a>, <a href="scrum-master.php">Scrum Master</a> and optionally the <a href="product-owner.php">Product Owner</a> meet every day for 15 minutes at the <a href="standup.php">Standup</a>.  At this meeting the Development Team and Scrum Master discuss:</p>
				<ol>
					<li>What you did yesterday</li>
					<li>What you are going to do today</li>
					<li>What are the impediments to you work</li>
				</ol>
				<p>Make sure that you make some time in the current Sprint to prepare for the next one.</p>
				<div class="alert alert-success" role="alert"><p>For a <a href="sprint.php">Sprint</a> or two, track the amount of time spent thinking ahead.
				Is it enough? too much? Remember that normally about 10% of a team's available time should be spent looking ahead.</p>
			</div>
			<p>Never extend a Sprint.  As soon as there is any inidication that not all the planned work can be completed the Product Owner meets with the rest of the team to discss what to do.
			</p>
			<p>Don't chnange the <a href="sprint-goal.php">Sprint Goal</a> Nothing is allowed to change within the Sprint.  The <a href="development-team.php">Development Team</a> commits to a set of work on the first day and then expects its priorities to remain unchanged
			for the length of the Sprint.</p>
			<h2>Replace Finish-to-start Relationships with Finish to Finish ones</h2>
			<p>One of the biggest problems with activity-specific Sprints is that they create what are known as finish-to-start relationships.
			In a finish-to-start relationship one task must finish before another one can be started.  For exampe a Gantt chart on a sequential
			project may show that analysis must finish before coding can start.</p>
			<p>What is important is not when tasks start but when they finish.  Coding cannot finish until analysis finishes and testing cannot finish
			until coding finishes.</p>
			<p>With a little experience most teams are able to see how to overlap some types of work and create finish-to-finish rleationship between them.</p>
			<h3>Overlapping User Experience Design</h3>
			<p>On a Scrum project we don't want to start with an up-front UED phase.  Instead we want user experience designers working
			alongside other team members.</p>
			<p>During a Sprint we want all team members, regardless of personal speciality, working together.  however during the Sprint the team has two goals.</p>
			<ol>
				<li>Complete the planned work on the current Sprint</li>
				<li>Prepare for the coming Sprint</li>
			</ol>
			<p>Naturally different <a href="development-team.php">Development Team</a> members will spend unequal amounts of time on different goals
			</p>
			<div class="alert alert-danger" role="alert"><p>User Experience Designers will likely spend the majority of their time learning about upcoming features.</p></div>
			<p>However they will also spend time refining and answering questions about desings being programmed and tested in the current Sprint.</p>
			<h2>Keep Timeboxes Regular and Strict</h2>
			<ul>
				<li>Teams benefit from a regular cadence</li>
				<li>Sprint Planning becomes easier.  Both Sprint Planning and Release Planning are simplfied when teams stick with a constant Sprint length
				</li>
				<li>Consider starting Sprints on Fridays so that the day can be packed with the Sprint Review, Sprint Retrospective and SPrint Planning Meetings.</li>
			</ul>
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