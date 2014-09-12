<!DOCTYPE php>
<php lang="">
	<head>
	<?php include('../scrum/includes/gcs.php');?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Product Backlog</title>
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
			<h1 class="text-center">Product Backlog</h1>
			<div class="row">
			<div class="col-sm-8 blog-main">
			<p>The Product Backlog is a list of alldesired functioanlity that is not yet in the product</p>
			<p>Items on the Product Backlog are derived from <a href="user-story.php">User Stories</a> and each item should be a step towards achieving the <a href="product-vision.php">Product Vision</a>.  Everything goes on the Product Backlog - there is not a separate bug backlog because this would make prioritisation more difficult.</p>
			<p>Each Product Backlog Item needs to comply with the expectations set in the wide <a href="definition-of-done.php">Definition of Done</a>in addition to its item-specific <a href="acceptance-criteria.php">Acceptance Criteria</a></p>
			<h2>The Product Backlog is:</h2>
			<ul>
				<li>List of requirements - items with business desires from the customer which lead to product improvement.</li>
				<li>A means to reach the <a href="product-vision.php">Product Vision</a></li>
				<li>Items are ordered be development priority.</li>
				<li>It is an incomplete and dynamic list - it is in constant evolution.</li>
			</ul>
			<p>Product Backlog Items should state problems not solutions.  For example if building a cooking application and PBI should be "I need to know when to prepare each item" rather than "I need an audio reminder for each step."</p>
			<h2>The Product Backlog should be:</h2>
			<ol>
				<li>Ordered</li>
				<li>Estimable (it can be <a href="estimate.php">Estimated</a>)</li>
				<li>Emergent</li>
				<li>Gradually Refined.</li>
			</ol>
			<h2>Refining the Product Backlog</h2>
			<ul>
				<li>Product Backlog needs regular attention and care</li>
				<li>Ongoing process and ensures the Product Backlog is ordered, estimable, emergent and gradually refined.</li>
				<li>Done collaboratively by the <a href="product-owner.php">Product Owner</a> and <a href="development-team.php">Development Team</a></li>
				<li>Every <a href="scrum-team.php">Scrum Team</a> has it's own process - little daily sessions, weekly sessions, grooming session.</li>
			</ul>
			<p>A good rule of thumb is that about ten percent of the effort in each <a href="sprint.php">Sprint</a> should be spent grooming the Product Backlog in preparation for future <a href="sprint.php">Sprints</a>.  The goal is not te begin each Sprint with a perfect understanding of the PBIs that will be developed during the Sprint. Rather the feature needs only to be sufficiently understood that the <a href="development-team.php">Development Team</a> has a reasonably strong chance of finishing it during the Sprint.</p>
			<p><a href="user-story.php">User Stories</a>at the top of the Product Backlog are small and reasonably well understood.  Those further down are larger and understood in less detail.  These <a href="epics.php">Epics</a> are left large, often only known in enough detail that each can be <a href="estimate.php">Estimated</a> approximately and then prioritised.</p>
			<p>Product Backlog Items must be ready (according to the <a href="definition-of-ready.php">Definition of Ready</a>) to be consumed by the <a href="development-team.php">Development Team</a> so that they can be added to the <a href="sprint-backlog.php">Sprint Backlog</a> if necessary.</p>
			<h2>Estimating Backlog Items</h2>
			<ul>
				<li>Estimates help understand team <a href="velocity.php">Velocity</a></li>
				<li>Precise / precision is the level of confidence in the interval i.e. an estimate of 1-3 days is less precise than an estimate of one day but more precise than an estimate of 1-7 days</li>
				<li>Accuracy is how close you were with your estimate</li>
				<li>Through <a href="estimate.php">Estimating</a> the team creates its own baselines
				<ul>
					<li>For example you can take a small Product Backlog Item, or one that you understand well, and give it a number.  You can then use this as a guide to measure more complex items.</li>
					<li>try using <a href="fibonacci.php">Fibonacci</a> method for estimating timings.</li>
				</ul>
			</li>
			<li>If team members disagree radically on the estimated time for an item then take the highest time.</li>
		</ul>
		<div class="alert alert-success" role="alert"><p>Discuss the <a href="product-backlog.php">Product Backlog</a>.  Identify th e
			top five items in need of advance thinking.  For each discuss who needs to think about it (an architect, a user experience designer?) and decide how
			many sprints in advance that should begin</p>
			</div>
		<h2>There are three Cs invovled in creating Product Backlog items;</h2>
		<ol>
			<li>Card (on which the <a href="user-story.php">User Stories</a> are written</li>
			<li>Conversation with the <a href="development-team.php">Development Team</a> to tease out the details behind the <a href="user-story.php">User Stories</a></li>
			<li>Confirmation - Agree acceptance test criteria - the mothod of building and testing within the <a href="sprint.php">Sprint</a></li>
		</ol>
		<h2>Emergent Requirements</h2>
		<p>Features that we cannot identify in advnace are called Emergent Requirements.  When someone identifies an emergent requirement they usually start like 'seeing that makes me think....'</p>
		<p>One reason Scrum puts so much emphasis on working code at the end of each <a href="sprint.php">Sprint</a> is to create a situation where Emergent Requirements can be discovered sooner rather than later.</p>
		<p>The first step in dealing with emergent Requirements is to acknowledge that we cannot think of everything.  After acknowledgeing will emerge as we build the system it is easier to accept the idea that we don't need (and cannot have) a perfect requirements document up front that specifies all the details of the system to be built.</p>
		<h2>Epics</h2>
		<p><a href="epics.php">Epics</a> are required features (or features that might be required) for which details are not yet known.  As you learn more about an epic they are broken down into separate <a href="user-story.php">User Stories</a> and added to the Product Backlog by the <a href="product-owner.php">Product Owner</a> </p>
		<p>Epics live at the bottom of the Product Backlog until they are broken down into individual User Stories</p>
		<h2>From Backlog Items to Tasks</h2>
		<p><em>More relsearch needed on this</em></p>
		<p>Backlog items are broken down into <a href="tasks.php">Tasks</a>.  Members of the <a href="development-team.php">Development Team</a> might work together on Product Backlog Items but will ikely be assigned different <a href="tasks.php">Tasks</a> within the Product Backlog Item.</p></a>
	
	</div>
	<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
			<?php include('../scrum/includes/product-artifacts.php');?>
			<?php include('../scrum/includes/product-details.php');?>
			<?php include('../scrum/includes/product-meetings.php');?>
			<?php include('../scrum/includes/product-participants.php');?>
		</div>
	</div>
	</div>
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</php>