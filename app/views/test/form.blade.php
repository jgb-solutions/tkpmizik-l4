<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf8">
	<title>Test form</title>
	{{ HTML::style('/css/lib/bootstrap.min.css') }}
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1>Testing AJAX Upload</h1>

				<form method="POST" class="form-horizontal" role="form" id="form"  enctype="multipart/form-data">
						<div class="form-group">
							<label for="file" class="control-label col-sm-3">Name:</label>
							<div class="col-sm-9">
								<input type="text" name="name">
							</div>
						</div>

						<div class="form-group">
							<label for="file" class="control-label col-sm-3">File:</label>
							<div class="col-sm-9">
								<input type="file" name="file">
							</div>
						</div>

						<label class="btn btn-primary active">
					    	<input type="radio" name="price" id="option1" checked value="free">
					    	<b>
					    		<span class="glyphicon glyphicon-star"></span>
					    		Gratis
					    		<span class="glyphicon glyphicon-star-empty"></span>
					    	</b>
					  	</label>
					  	<label class="btn btn-success">
					    	<input type="radio" name="price" id="option2" value="paid">
					    	<b>
					    		<i class="fa fa-dollar"></i> Peye <i class="fa fa-money"></i></b>
					  	</label>

						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
				</form>

			</div>
		</div>
	</div>

	{{-- {{ HTML::script('/js/lib/jquery.min.js') }} --}}
	// <script>
	// $(function()
	// {
	// 	$('#form').on('submit', function(e)
	// 	{
	// 		e.preventDefault();

	// 		data = $(this).serialize();
	// 		console.log( data );
	// 		// $.post('/form', data, function(data) {
	// 		// 	alert( data );
	// 		// 	/*optional stuff to do after success */
	// 		// });
	// 	});
	// });

	// </script>
</body>
</html>