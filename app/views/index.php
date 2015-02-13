<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel and Angular Comment System</title>

	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	<style>
		body 		{ padding-top:30px; }
		form 		{ padding-bottom:20px; }
		.comment 	{ padding-bottom:20px; }
	</style>

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
		<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
		<script src="js/services/commentService.js"></script> <!-- load our service -->
		<script src="js/app.js"></script> <!-- load our application -->

</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="commentApp" ng-controller="mainController">
<div class="col-md-8 col-md-offset-2">

	<!-- PAGE TITLE -->
	<div class="page-header">
		<h2>Laravel and Angular Single Page Application</h2>
		<h4>Commenting System</h4>
	</div>

	<!-- NEW COMMENT FORM -->
	<form ng-submit="submitComment()"> <!-- ng-submit will disable the default form action and use our function -->

		<!-- AUTHOR -->
		<div class="form-group">
			<input type="text" class="form-control input-sm" name="author" ng-model="commentData.author" placeholder="Name">
		</div>

		<!-- COMMENT TEXT -->
		<div class="form-group">
			<input type="text" class="form-control input-lg" name="comment" ng-model="commentData.text" placeholder="Say what you have to say">
		</div>
		
		<!-- SUBMIT BUTTON -->
		<div class="form-group text-right">	
			<button type="submit" class="btn btn-primary btn-lg">Submit</button>
		</div>
	</form>

	<!-- LOADING ICON -->
	<!-- show loading icon if the loading variable is set to true -->
	<p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

	<!-- THE COMMENTS -->
	<!-- hide these comments if the loading variable is true -->
	<div class="comment" ng-hide="loading" ng-repeat="comment in comments" ng-init="edit[comment.id]=false">
		<h3>Comment #{{ comment.id }} <small>by {{ comment.author }}</small></h3>
		<p>{{ comment.text }}</p>
		<p>
		<button type="button" class="btn btn-default" id ="editbutton{{comment.id}}" ng-click="edit[comment.id]=true">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Comment
		</button>
		<button type="button" class="btn btn-default" id ="deletebutton{{comment.id}}" ng-click="deleteComment(comment.id)">
		  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Delete Comment
		</button>
		<!--<a href="#" ng-click="deleteComment(comment.id)">Delete Comment</a>-->
		</p>
		<form id = "comment{{comment.id}}"method="POST" action="/laravel/public/api/comments" ng-hide="!edit[comment.id]"> 
		
		<!-- ID -->
		<div class="form-group">
			<input type="hidden" class="form-control input-sm" name="id"  value="{{ comment.id }}">
		</div>
		
		<!-- AUTHOR -->
		<div class="form-group">
			<input type="hidden" class="form-control input-sm" name="author" value="{{ comment.author }}">
		</div>

		<!-- COMMENT TEXT -->
		<div class="form-group">
			<input type="text" class="form-control input-sm" name="text" ng-init="newComment = comment.text" ng-model="newComment" placeholder="Update what you have to say">
		</div>
		
		<!-- SUBMIT BUTTON -->
		<div class="form-group text-right">	
			<button type="submit" class="btn btn-primary" ng-click="$event.preventDefault(); edit[comment.id]=false; updateComment(comment, newComment);">Update</button>
		</div>
		</form>
	
		
	</div>

</div>
</body>
</html>