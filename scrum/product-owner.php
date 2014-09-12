<!DOCTYPE php>
<php lang="">
	<head>
	<?php include('../scrum/includes/gcs.php');?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Product Owner</title>
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
			<h1 class="text-center">Product Owner</h1>
			<div class="row">
			<div class="col-sm-8 blog-main">
			<h2>Role of the Product Owner</h2>
			<p>The Product Owner seeks to maximise the ROI for the customer.  They:</p>
			<ol>
				<li>Manage the <a href="product-backlog.php">Product Backlog</a> (modifiy and order its items) and ensure visibility.</li>
				<li>Manages the <a href="stakeholders.php">Stakeholders</a>:
				<ul>
					<li>Identifies them and their level of suport</li>
					<li>Communicates with them and understands their needs</li>
					<li>Balances different stakeholder needs</li>
					<li>Influences the stakeholders</li>
				</ul>
			</li>
			<li>Manages the <a href="product-vision.php">Product Vision</a>.  Establishes, maintains and communicates it.</li>
			<li>Manages the <a href="release-schedule.php">Release Schedule</a> for the customers</li>
			<li>Actively participates in <a href="sprint.php">Sprints</a>
			<ul>
				<li>Available for the <a href="development-team.php">Development Team</a></li>
				<li>Participates in <a href="sprint-planning.php">Sprint Planning</a>, <a href="sprint-review.php">Sprint Review</a>, and <a href="release-planning.php">Release Planning</a></li>
			</ul>
		</li>
		<li>Accepts or rejects the work done by the team at the <a href="sprint-review.php">Sprint Review</a></li>
		<li>Manages the budget and ensures that there is enough money for the project throughout delivery</li>
	</ol>
	<h2>Attributes of the Product Owner</h2>
	<ol>
		<li>There is a sinlge Product Owner</li>
		<li>They are always available</li>
		<li>They are representative</li>
		<li>They have the knowledge and power to make decisions on the product i.e. they do not need to go back to the customer to ask foropinions or permission</li>
	</ol>
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