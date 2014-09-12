<!DOCTYPE php>
<php lang="">
	<head>
	<?php include('../scrum/includes/gcs.php');?>
	<!-- 	<script>
		(function() {
		var cx = '009779544953096465337:v5t5viucpg4';
		var gcse = document.createElement('script');
		gcse.type = 'text/javascript';
		gcse.async = true;
		gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
		'//www.google.com/cse/cse.js?cx=' + cx;
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(gcse, s);
		})();
		</script>
		<gcse:search></gcse:search> -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Scrum</title>
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="../scrum/css/custom.css" rel="stylesheet">
		<!-- <link href="../scrum/css/blog.css" rel="stylesheet"> -->
		<!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
		<h1 class="text-center">Working with Scrum</h1>
			<div class="row">
				<div class="col-sm-8 blog-main">
					<!-- <h1 class="text-center">Working with Scrum</h1> -->
					<h2>Why Scrum?</h2>
					<p>The <a href="scrum-process.php">Scrum Process</a></p>
					<ol>
						<li>Scrum avoids waste - you only produce what the customer will actually use.  Normally many features go unused.</li>
						<li>A lack of early testing and customer feedback means that you lose the opportunity to hear about the other features they really want.</li>
						<li>Don't try to plain detail those things that are a long way away.  You need to be clear about a feature before you can describe its details.</li>
						<li>Blindly carrying on with a plan and refusing to accept change is bad because you end up building the wrong product</li>
					</ol>
					<h2>What is Scrum?</h2>
					<ol>
						<li>Scrum is a framework / a set of rules for working.  Other practices need to be worked into it (that are domain-specific) such as <a href="extreme-programming.php">Extreme Programming</a>.</li>
						<li>Scrum won't tell the <a href="product-owner.php">Product Owner</a> how to prioritise the <a href="product-backlog.php">Product Backlog</a>, only that it needs to be prioritised.</li>
						<li>Work takes place in a<a href="sprint.php">Sprint</a> which works against a <a href="sprint-backlog.php">Sprint Backlog</a> (taken from the <a href="product-backlog.php">Product Backlog)</a> and seeks to deliver a <a href="sprint-goal.php">Sprint Goal</a></li>
						<li>Scrum is incremental - you add thin slices of end-to-end functionality.</li>
						<li>Scrum is value-driven not plan-driven.  You should do first what delivers most value.</li>
						<li>Scrum is often associated with <a href="continuous-delivery.php">Continuous Delivery</a>.</li>
						<li><a href="acceptance-criteria.php">Acceptance Criteria</a> are applied to specific <a href="tasks.php">Tasks</a></li>
						<li><a href="definition-of-done.php">Definition of Done</a> are generic criteria that are applies to all items.</li>
						<li>The <a href="product-backlog.php">Product Backlog</a> can contain both business and technical issues.</li>
						<li>Progress can be tracked on a <a href="burndown-chart.php">Burndown Chart</a></li>
					</ol>
					<h2>Agile Project Management</h2>
					<p><a href="scrum-master.php">Scrum Master</a> - manages the <a href="scrum-process.php">Scrum Process</a>.  They are a facilitator.</p>
					<p><a href="product-owner.php">Product Owner</a> - manages the <a href="product-vision.php">Product Vision</a>, <a href="requirements.php">Requirements</a>, and <a href="stakeholder.php">Stakeholders</a>.</p>
					<p><a href="development-team.php">Development Team</a> manages the how.</p>
					<h3>Feedback is often sought from:</h3>
					<ul>
						<li><a href="product-owner.php">Product Owner</a></li>
						<li>Through customer review at the <a href="print-review.php">Sprint Review</a></li>
						<li>CFrom customer use. This is the best and most reliable kind and should be sought as often as possible</li>
					</ul>
				</div>
					<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
						<?php include('../scrum/includes/artifacts.php');?>
						<?php include('../scrum/includes/details.php');?>
						<?php include('../scrum/includes/meetings.php');?>
						<?php include('../scrum/includes/participants.php');?>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</php>