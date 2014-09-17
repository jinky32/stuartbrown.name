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
				<h2>What is a Sprint?</h2>
				<p>A Sprint is a time boxed piece of work that delivers a product increment (a 'shipable increment') for the customer (not necessarily the same thing as an end user).  Not all Sprints result in a public <a href="release.php">Release</a> however.</p>
				<p> Agile methodologies emphasise working software as an outcome form a Sprint for three key reasons:</p>
				<ol>
					<li>Working software encourages feedback.</li>
					<li>Working software helps a team guage its progress</li>
					<li>Working software allows the product to ship early if desired.</li>
				</ol>
				<p>During the Sprint the team has two goals.</p>
				<ol>
					<li>Complete the planned work on the current Sprint</li>
					<li>Prepare for the coming Sprint</li>
				</ol>
				<h3>Keep Timeboxes Regular and Strict</h3>
				<ul>
					<li>Teams benefit from a regular cadence</li>
					<li>Sprint Planning becomes easier.  Both Sprint Planning and Release Planning are simplfied when teams stick with a constant Sprint length
					</li>
					<li>Consider starting Sprints on Fridays so that the day can be packed with the Sprint Review, Sprint Retrospective and SPrint Planning Meetings.</li>
				</ul>
				<h2>Meetings</h2>
				<h3><a name="sprint-planning"></a>Sprint Planning</h3>
				<p>There are two parts to Sprint Planning:</p>
				<ol>
					<li>What - Define the <a href="sprint-goal.php">Sprint Goal</a></li>
					<li>How - Create and Evaluate Tasks</li>
					<ul>
					<li><a href="definition-of-done.php">Definition of Done</a> and <a href="definition-of-ready.php">Defintion of Ready</a> are either defined or re-articulated based on previous versions.
					<li><a href="product-backlog.php">Product Backlog Items</a> that have met the Definition of Ready are selected for consideration in the <a href="sprint.php">Sprint</a>.
					From these <a href="tasks.php">Tasks</a>are defined by the <a href="development-team.php">Development Team</a>, Estimated and assigned a time in hours. This should be no more than a working day</li>
				</ul>
				
				</ol>
				<p>This results in the creation of the <a href="sprint-backlog.php">Sprint Backlog</a>, with Tasks groped by Story, that the Development Team commits to.</p>
				
				
				<h3><a name="daily-standup"></a>Daily Standup</h3>
				<p>During a Sprint the <a href="development-team.php">Development Team</a>, <a href="scrum-master.php">Scrum Master</a> and optionally the <a href="product-owner.php">Product Owner</a> meet every day for 15 minutes at the <a href="standup.php">Standup</a>.  At this meeting the Development Team and Scrum Master discuss:</p>
				<ol>
					<li>What you did yesterday</li>
					<li>What you are going to do today</li>
					<li>What are the impediments to you work</li>
				</ol>
				<h3><a name="product-backog-refinement-meeting"></a>Product Backlog Refinement Meeting</h3>
				<p>At least 10% of the Sprint should be spent refining and (re) estimating based on what has been learned during the Sprint</p>
				<h3><a name="sprint-review"></a>Sprint Review</h3>
				<p>The Sprint Review Meeting is atteneded by:</p>
				<ul>
					<li>The <a href="development-team.php">Development Team</a></li>
					<li>The <a href="product-owner.php">Product Owner</a></li>
					<li>The <a href="scrum-master.php">Scrum Master</a></li>
					<li>(optionally) other <a href="stakeholders.php">Stakeholder</a> such as those who will use the tool so that they can see it in action and give feedback.</li>
				</ul>
				<p>The structure (agenda) of the meeting is normally</p>
				<ol>
					<li>Demo from the Development Team</li>
					<li>Product Owner declares what is done - i.e. what has met the acceptance criteria and whether the Sprint Goal has been achieved.</li>
					<li>A measure of Team velocoty is taken (optionally)</li>
					<li>Stakeholders feedback.</li>
				</ol>
				
		<p>Each <a href="product-backlog.php">Product Backlog Item</a> needs to comply with the wider expectation set in the <a href="defintion-of-done.php">Definition of Done</a> in addition to its item-specific <a href="acceptance-criteria.php">Acceptance Criteria
	</a></p>
	<h3><a name="sprint-retrospective"></a>Sprint Retrospective</h3>
	<p>from <a href="http://www.romanpichler.com/blog/product-owner-sprint-retrospective/">Roman Pichler</a></p>
	<p>The Sprint Retrospective is an opportunity to pause for a short while and reflect on what happened during the Sprint.  This allows attendees to improve
	their collaboration and their work practices to get even better at creating a great product.</p>
	<p>The meeting takes place right at the end of the Sprint after the Sprint Review Meeting.  Its outcomes should be actioanble improvement measures.</p>
	<p>A great way to review and improve te collaboration with your partners from around the organisation is to invite tem to the retrospective
	on a regular basis.  Depending on how closely you collaborate this may range form once per month to once per major release.</p>
	<h2>Tips</h2>
	<div class="alert alert-success" role="alert"><p>Discuss the <a href="product-backlog.php">Product Backlog</a>.  Identify th e
	top five items in need of advance thinking.  For each discuss who needs to think about it (an architect, a user experience designer?) and decide how
	many sprints in advance that should begin</p>
	<h4>Tasks</h4>
</div>
<div class="alert alert-success" role="alert"><p>In your next three <a href="sprint-review.php">Sprint Reviews</a>, discuss whether
each <a href="product-backlog.php">Product Backlog Item</a> item included just enough detail and whether it was added just in time</p>
</div>
<div class="alert alert-success" role="alert"><p>For a <a href="sprint.php">Sprint</a> or two, track the amount of time spent thinking ahead.
Is it enough? too much? Remember that normally about 10% of a team's available time should be spent looking ahead.</p>
</div>
<ul>
	<li>Never extend a Sprint.  As soon as there is any inidication that not all the planned work can be completed the Product Owner meets with the rest of the team to discss what to do.
</li>
	<li>Don't chnange the <a href="sprint-goal.php">Sprint Goal</a> Nothing is allowed to change within the Sprint.  The <a href="development-team.php">Development Team</a> commits to a set of work on the first day and then expects its priorities to remain unchanged
for the length of the Sprint.</li>
	<li>Naturally different <a href="development-team.php">Development Team</a> members will spend unequal amounts of time on different goals
</li>
</ul>
<div class="alert alert-danger" role="alert"><p>User Experience Designers will likely spend the majority of their time learning about upcoming features.</p></div>
<p>However they will also spend time refining and answering questions about desings being programmed and tested in the current Sprint.</p>

<h2>Documents</h2>
<h3><a name="sprint-goal"></a>Sprint Goal</h3>
<p>Sprint goals are statements of value.  They are not items themselves although they are obviously related.</p>
<h3><a name="sprint-backlog"></a>Sprint Backlog</h3>
<p>The Sprint Backlog is derived from the <a href="product-backlog.php">Product Backlog</a>but includes only those items which meet the <a href="definition-of-ready.php">Definition of Ready</a></p>
<p>Each <a href="product-backlog.php">Product Backlog Item</a> needs to comply with the wider expectation set in the <a href="defintion-of-done.php">Definition of Done</a> in addition to its item-specific <a href="acceptance-criteria.php">Acceptance Criteria
</a></p>
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