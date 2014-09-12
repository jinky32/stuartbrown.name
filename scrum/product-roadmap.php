<!DOCTYPE php>
<php lang="">
	<head>
	<?php include('../scrum/includes/gcs.php');?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Product Roadmap</title>
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
			<h1 class="text-center">Product Roadmap</h1>
			<div class="row">
			<div class="col-sm-8 blog-main">
			<p>It contains the main features and objectives for ht enext releases (and is possibly an outcome of the <a href="release-planning.php">Release Planning Workshop</a>.  There might be a <a href="release-goal.php">Release Goal</a> stated for each marker on the Product Roadmap and maybe a list of <a href="product-backlog.php">Product Backlog Items</a>for each.</p>
			<p>check out http://www.romanpichler.com/blog/product-roadmap-product-backlog/ and http://www.romanpichler.com/tools/product-roadmap/</p>
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