<!DOCTYPE php>
<php lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sprint Review</title>
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
	
			<h1 class="text-center">Sprint Review</h1>
			<div class="row">
			<div class="col-sm-8 blog-main">
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
				<li>Product Owner declares what is done</li>
				<li>A meaasure of Team velocoty is taken (optionally)</li>
				<li>Stakeholders feedback.</li>
			</ol>
			<p>At the Sprint Review Meeting:</p>
			<ul>
				<li>There is a live demonstration by the  <a href="development-team.php">Development Team</a></li>
				<li>The <a href="product-owner.php">Product Owner</a> decides 
				<ul>
				<li>which <a href="sprint-backlog.php">Sprint Backlog Items</a> are done according to the <a href="acceptance-criteria.php">Acceptance Criteria</a> </li>
				<li>whether the <a href="sprint-goal.php">Sprint Goal</a> has been met</li>
				</ul>
			</li>
			</ul>
			<div class="alert alert-success" role="alert"><p>In your next three <a href="sprint-review.php">Sprint Reviews</a>, discuss whether
			 each <a href="product-backlog.php">Product Backlog Item</a> item included just enough detail and whether it was added just in time</p>
			</div>
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