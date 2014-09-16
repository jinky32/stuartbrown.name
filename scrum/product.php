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
		
		<h1 class="text-center">Product</h1>
		<div class="row">
			<div class="col-sm-8 blog-main">
				<h2>What is set at the Product level?</h2>
				<h3><a name="product-vision"></a>Product Vision</h3>
				<p>The Product Vision is a shared goal - it provides context and guidance.</p>
				<h3><a name="user-story"></a>User Stories</h3>
				<p>User Stories are normally written at a <a href="user-story-writing-workshop.php">Story Writing Workshop</a>.</p>
				<p>A User Story is a short, simple description of a feature told from the perspective of the person who desires the new capability, usually a user or a customer of the system. </p>
				<ul>
					<li>Who</li>
					<li>What</li>
					<li>Why</li>
					<li>"As a *role* I would like/want/should *function* so that *value*."</li>
				</ul>
				<p>The User Story card is not meant to be a complete feature description but is rather a two-way promise between the <a href="development-team.php">Development Team</a> and the <a href="product-owner.php">Product Owner</a></p>
				<ul>
					<li>Development Team members promise that they will talk to the Product Owner before beginning work on the User Story.  This is important because it frees the Product Owner from concerns that every last detail needs to be put on the User Story card</li>
					<li>The Product Owner promises to be available when the Development Team is ready to talk.  This is important because it allows the Development Team to consider the User Story in <a href="sprint-planning.php">Sprint Planning</a>knowing that the Product Owner can provide more details as required to enable accurate <a href="estimate.php">Estimation</a>.</li>
				</ul>
				<p>User Stories should be INVEST:</p>
				<ul>
					<li>Independant (from other stories)</li>
					<li>Negotiable (details are negotiated)</li>
					<li>Valuable (to the customer)</li>
					<li>Estimable (by the <a href="development-team.php">Development Team</a>)</li>
					<li>Small (in implementation effort</li>
					<li>Testable (to allow for confirmation)</li>
				</ul>
				<p>The <a href="product-owner.php">Product Owner</a> should also provide <a href="acceptance-criteria.php">Acceptance Criteria</a> for each User Story.</p>
				
				<h3><a name="release-plan"></a>Release Plan</h3>
				<h4>What is Release Planning?</h4>
				<p>Release Planning is the plan for the next time a customer sees a release.  It is not part of core Scrum.</p>
				<p>Out of the Release Planning Workshop might come the Product Roadmap.</p>
				<p><a href="release.php">Release Dates</a> are based on an estimated <a href="velocity.php">Velocity</a> (the count of items achieved per sprint, the <a href="estimate.php">Estimated points</a> for each of those items and the <a href="sprint.php">Sprint</a> cycle periods (i.e. how many Sprints can you get in between the start and the <a href="release.php">Release Date</a></p>.
				<p><em>Read http://stackoverflow.com/questions/502731/scrum-when-do-you-estimate-the-effort-for-product-backlog-items</em></p>
				
				<p>A <a href="release.php">Release</a> may take place in the following scenarios:</p>
				<ul>
					<li>Release on <a href="sprint.php">Sprint</a></li>
					<li>Release on <a href="product-backlog.php">Product Backlog Item</a></li>
					<li>Release on value</li>
					<li>Release on plan</li>
				</ul>
				
				<h3><a name="definition-of-done">Defintion of Done</a></h3>
				<p>Definition of Done and <a href="definition-of-ready.php">Defintion of Ready</a> are either defined or re-articulated based on previous versions. The Defintion of Done may be that what has been produced is 'coded, tested, checked-in, well-written, integrated, and has automated tests.'
					Each <a href="product-backlog.php">Product Backlog Item</a> needs to comply with these expectations in addition to its item-specific <a href="acceptance-criteria.php">Acceptance Criteria</a></p>
				
				<div class="alert alert-success" role="alert"><p>The Definition of Done defines a potentially shippable product increment appropritae for its environment.  In many ways the elements
					that comprise a team's Definition of Done are like <a href="acceptance-criteria.php">Acceptance Criteria</a> applied across all
					<a href="user-story.php">User Stories</a> on the <a href="product-backlog.php">Product Backlog</a></p></div>
					
					
				
					<h4>Defining Potentially Shippable</h4>
					<ul>
						<li>Potentially shippable means tested.</li>
						<li>Potetnially shippable mean integrated</li>
					</ul>
					<h2>Meetings</h2>
					<h3><a name="user-story-writing-workshop"></a>Story Writing Workshops</h3>
					<p>Used to:</p>
					<ol>
						<li>Write <a href="user-story.php">User Stories</a> </li>
						<li>Brainstorm / rapid prototype</li>
					</ol>
					<p>From all of this the <a href="product-owner.php">Product Owner</a> builds the <a href="product-backlog.php">Product Backlog</a></p>
					
					
				
					<h3><a name="product-backlog-refinement-meeting"></a>Product Backlog Refinement Meeting</h3>
					<p>An objective of the Product Backlog Refinement Meeting is to create <a href="product-backlog.php">Product Backlog Items that are</a>:</p>
					<ul>
						<li>Independent</li>
						<li>Negotiable</li>
						<li>Valuable</li>
						<li>Estimable</li>
						<li>Small</li>
						<li>Testable</li>
					</ul>
					<p>In this meeting Product Backlog Items are <a href="estimate.php">Estimated</a> and given Story Points by the Development Team.  This might be done using <a href="estimation-cards.php">Estimation Cards</a> or using <a href="planning-poker.php">Planning Poker</a></p>
					<p>In this meeting the Definition of Ready is also defined (http://www.romanpichler.com/blog/the-definition-of-ready/).</p>
					<h4><a name="definition-of-ready">Defintion of Ready</a></h4>
					<p>The Definition of Ready is the definition of a <a href="product-backlog.php">Product Backlog Item</a> that is ready to be considered for <a href="sprint-planning.php">Sprint Planning</a>.</p>
					<p>A Definition of Ready might be that the item is <a href="estimated.php">Estimated</a>, small enough, and there is enough information about it.</p>
					<p>Only Product Backlog Items that meet the requirements set in the Defintion of Ready will be considered in the Sprint Planning Meeting</p>
					
					<h4>Estimating Backlog Items</h4>
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
				<h4>Acceptance Criteria</h4>
				<p>Acceptance Criteria are applied to <a href="user-story.php">User Stories</a> by the <a href="product-owner.php">Product Owner</a>.</p>
				<ol>
					<li>Acceptance criteria need not constitute an exhaustive list; they should be sufficient to get the game moving forward.</li>
					<li>Acceptance criteria are temporal in nature. That is, they help the team validate the story based on the functionality the product owner had in mind at a distant time in the past.</li>
					<li>Because acceptance criteria are temporal artifacts, they add no intrinsic value to future deliveries.</li>
					<li>As the Sprints progress, acceptance criteria become refined through each story iteration to create a workable product.</li>
					<li>Acceptance criteria can never be complete, as they embody expectations that change over time.</li>
				</ol>
				<h3><a name="release-planning-workshop"></a>Release Planning Workshop</h3>
				<p>look at http://www.romanpichler.com/blog/release-planning-workshop/</p>
				<p>Release Goals are statements of value.  They are not items themselves althugh they are obviously related.</p>
				<p>Release Goals sit between <a href="sprint-goal.php">Sprint Goals</a> and the <a href="product-vision.php">Product Vision</a>, even if there is a <a href="release.php">Release</a> for every <a href="sprint.php">Sprint</a>.  The Release Goal signals the direction of travel</p>
				
				<h2>Tips</h2>
				
				
				
				<h2>Documents</h2>
				<h3><a name="product-roadmap"></a>Product Roadmap</h3>
				<p>It contains the main features and objectives for the next releases (and is possibly an outcome of the <a href="release-planning.php">Release Planning Workshop</a>.  There might be a <a href="release-goal.php">Release Goal</a> stated for each marker on the Product Roadmap and maybe a list of <a href="product-backlog.php">Product Backlog Items</a>for each.</p>
				<p>check out http://www.romanpichler.com/blog/product-roadmap-product-backlog/ and http://www.romanpichler.com/tools/product-roadmap/</p>
				<h3><a href="product-backlog.php">Product Backlog</a></h3>
				<h3><a href="release-burndown.php">Release Burndown</a></h3>
				<p>This is a graph where the Y Axis shows the remaining <a href="estimate.php">Estimated</a> effort points (<a href="user-story.php">User Story</a> points) and the X Axis shows time (Sprint days).  The puropse is to allow you to inspect progress.</p>
			</div>
			
			<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
				<?php include('../scrum/includes/product-artifacts.php');?>
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