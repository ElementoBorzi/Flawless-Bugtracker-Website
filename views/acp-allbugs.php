<?php
$Common->protect("admin-is-logged");
?>

<link rel="stylesheet" href="theme/default/css/acp-home.css">
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<?php include("includes/acp-header.php"); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard - New Bugs</h1>
    </div>
    <table id='bugsTable' class='display dataTable'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Post Date</th>
				<th>Category</th>
				<th>Tags</th>
				<th>Status</th>
			</tr>
		</thead>   
	</table>

	<script>
	$(document).ready(function()
	{
		$('#bugsTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
				'url':'views/ajax/acp-all-bugs.php'
			},
			'columns': [
				{ data: 'id' },
				{ data: 'title' },
				{ data: 'description' },
				{ data: 'post_date' },
				{ data: 'category' },
				{ data: 'tags' },
				{ data: 'status' },
			]
		});
	});
	</script>
</main>

<?php 
include("includes/acp-footer.php");
?>