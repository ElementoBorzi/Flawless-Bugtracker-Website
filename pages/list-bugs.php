<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
	<h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Known bugs</li>
		</ol>
	</nav>
	<hr />


	<div class="card" style="margin-bottom: 30px;">
		<div class="card-body">
			<h5 class="card-title">Can't find the bug you want to report?</h5>
			<p class="card-text">If you wish to submit a bug report that you can't find on the list, please click on the button bellow.</p>
			<a href="?page=bugreport" class="btn btn-primary">Report a new bug</a>
		</div>
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
				'url':'pages/ajax/list-all-bugs.php'
			},
			/*"columnDefs": [
				{ "width": "10px", "targets": 0 },
				{ "width": "70px", "targets": 1 },
				{ "width": "150px", "targets": 2 },
				{ "width": "100px", "targets": 3 },
				{ "width": "50px", "targets": 4 },
				{ "width": "30px", "targets": 5 },
				{ "width": "70px", "targets": 6 }
			],*/
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
</div>
