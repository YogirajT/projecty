<!DOCTYPE html>
<html lang="en">
	<head>
		<title>To do List</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Bootstrap 101 Template</title>

		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			body{
				font-family:Calibri;
				font-size:16px;
				background: beige;
			}
			#jax{
				position:fixed;
				top: 100px;
			}
			.btn{
				border-radius:0px;
			}
			th{
				font-size:24px;
			}
			tr{
				position:relative;
			}
			.paging-nav {
			  text-align: right;
			  padding-top: 2px;
			}

			.paging-nav a {
			  margin: auto 1px;
			  text-decoration: none;
			  display: inline-block;
			  padding: 1px 7px;
			  background: #91b9e6;
			  color: white;
			  border-radius: 3px;
			}

			.paging-nav .selected-page {
			  background: #187ed5;
			  font-weight: bold;
			}
			
			#tblrow{
				height:326px;
			}
			.pager li>a, .pager li>span{
				border-radius: 0px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<section>
				<div id="tblrow" class="row">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th style="text-align:center;" class="col-md-7">Task</th>
								<th>Created</th>
								<th>Status</th>
								<th colspan="3" style="text-align:center">Actions</th>
							</tr>
						</thead>
						<tbody id="myTable">
							<?php
							include("dbcon.php");
							$query = "SELECT * FROM list";
							$result = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($result))
							{
							?>
								<tr>
									<td></td>
									<td class="col-md-6"><?php if($row['status']==0){echo '<del>';}?><?php echo $row['todo'];?><?php if($row['status']==0){echo '</del>';}?></td>
									<td class="col-md-1"><?php echo $row['created'];?></td>
									<td><?php if($row['status']==1){echo "Incomplete";}else{echo 'Done!';}?></td>
									<td>			
										<button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal">
										Update
										</button>	
									</td>
									<td><a href="completed.php?id=<?php echo $row['id'];?>" class="btn btn-default">Completed</a></td>
									<td><a class="btn btn-default">Delete</a></td>
									<td style="display:none"><?php echo $row['id'];?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>

				<div class="col-md-12 text-center">
				<ul class="pager"  id="myPager"></ul>
				</div>
			
				<form class="form-horizontal" action="addtask.php" method="POST" style="margin-left:30%">
					<strong>New Task:</strong>
					<div class="row">
						<div class="col-sm-8">
							<textarea class="form-control" rows="3" name="task" style="margin-bottom:10px; border-radius:0px;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8">
						  <button type="submit" name="addtask" class="btn btn-default">Add Task!</button>
						</div>
					</div>
				</form>
			</section>
			<footer>
				<div id="weather"></div>
			</footer>
			<div id="jax">
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Task update</h4>
				  </div>
				  <div class="modal-body">
					...
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<div id="emptydiv" style="display:none"></div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		$( "td:contains('Incomplete')" ).css( "color", "red" );
		$( "td:contains('Done!')" ).css( "color", "#67FF4F" );
		$( document ).ready(function() {
			
			var addSerialNumber = function () {
				$('table tr').each(function(index) {
					$(this).find('td:nth-child(1)').html(index+1-1);
				});
			};
			addSerialNumber();
			
			//$('td').click(function(){
			//   var row_index = $(this).parent().index();   
			//   var col_index = $(this).index();
			//});
			
			$("table tr").click(function(){
			   var value=$(this).find('td:nth-child(8)').html();
			   var link = "update.php?id="+value;
			   $(".modal-body").load(link);
			});

			//deleteanimation
			$("table tr td:nth-child(7) a").click(function(){
				var clickdel = $(this).parents("tr").find('td:nth-child(8)').html();
				var delnk = "delete.php?id="+clickdel;
				$(this).parents("tr").animate({opacity: 0}, 'slow', 'linear', function() {$(this).remove(); $("#emptydiv").load(delnk);location.reload();});
			})
		});
	</script>
	<script>
			$.fn.pageMe = function(opts){
			var $this = this,
				defaults = {
					perPage: 7,
					showPrevNext: false,
					hidePageNumbers: false
				},
				settings = $.extend(defaults, opts);
			var listElement = $this;
			var perPage = settings.perPage;
			var children = listElement.children();
			var pager = $('.pager');
			
			if (typeof settings.childSelector!="undefined") {
				children = listElement.find(settings.childSelector);
			}
			
			if (typeof settings.pagerSelector!="undefined") {
				pager = $(settings.pagerSelector);
			}
			
			var numItems = children.size();
			var numPages = Math.ceil(numItems/perPage);

			pager.data("curr",0);
			
			if (settings.showPrevNext){
				$('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
			}
			
			var curr = 0;
			while(numPages > curr && (settings.hidePageNumbers==false)){
				$('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
				curr++;
			}
			
			if (settings.showPrevNext){
				$('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
			}
			
			pager.find('.page_link:first').addClass('active');
			pager.find('.prev_link').hide();
			if (numPages<=1) {
				pager.find('.next_link').hide();
			}
			  pager.children().eq(1).addClass("active");
			
			children.hide();
			children.slice(0, perPage).show();
			
			pager.find('li .page_link').click(function(){
				var clickedPage = $(this).html().valueOf()-1;
				goTo(clickedPage,perPage);
				return false;
			});
			pager.find('li .prev_link').click(function(){
				previous();
				return false;
			});
			pager.find('li .next_link').click(function(){
				next();
				return false;
			});
			
			function previous(){
				var goToPage = parseInt(pager.data("curr")) - 1;
				goTo(goToPage);
			}
			 
			function next(){
				goToPage = parseInt(pager.data("curr")) + 1;
				goTo(goToPage);
			}
			
			function goTo(page){
				var startAt = page * perPage,
					endOn = startAt + perPage;
				
				children.css('display','none').slice(startAt, endOn).show();
				
				if (page>=1) {
					pager.find('.prev_link').show();
				}
				else {
					pager.find('.prev_link').hide();
					//pager.find('.prev_link').addClass(".disabled");
				}
				
				if (page<(numPages-1)) {
					pager.find('.next_link').show();
				}
				else {
					pager.find('.next_link').hide();
					//pager.find('.next_link').addClass(".disabled");
				}
				
				pager.data("curr",page);
				pager.children().removeClass("active");
				pager.children().eq(page+1).addClass("active");
			
			}
		};
		
		$(document).ready(function(){
			$('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:5});
		});
	</script>
	</body>
<html>