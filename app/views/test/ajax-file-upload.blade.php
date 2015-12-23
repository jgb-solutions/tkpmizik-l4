<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf8">
	<title>AJAX File Upload</title>
	{{ HTML::style('/css/lib/bootstrap.min.css') }}

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<h1 class="text-center">AJAX Music Uplaod</h1>
		</div>
		<div class="col-sm-8">
			{{ Form::open(['method' => 'POST', 'url' => '/mp3', 'files' => true, 'class' => 'form-horizontal', 'id' => 'mp3Form']) }}

				<div class="form-group">
					<label for="name" class="col-sm-4 control-label">Mete Non Mizik la</label>
					<div class="col-sm-8">
						<input required type="text" name="name" class="form-control" id="name" placeholder="Bay mizik la yon tit" value="{{ Input::old('name') }}" >
					</div>
				</div>

				<div class="form-group">
					<label for="mp3" class="col-sm-4 control-label">Chwazi Mizik MP3 a</label>
					<div class="col-sm-8">
						<input required name="mp3" class="form-control" type="file" >
					</div>
				</div>

				<div class="form-group">
					<label for="mp3" class="col-sm-4 control-label">Chwazi Yon Imaj</label>
					<div class="col-sm-8">
						<input required name="image" class="form-control" type="file" >
					</div>
				</div>

				<div class="form-group">
					<label for="category" class="col-sm-4 control-label">Kategori Mizik la</label>
					<div class="col-sm-8">
						<select class="form-control" name="cat">


							<option
								value="55"
								selected>
								Rap Kreyòl
							</option>


						</select>
					</div>
				</div>

				<div class="col-sm-8 col-sm-offset-4">
					<p>
						<button type="submit" class="btn btn-primary btn-lg">
							<span class="glyphicon glyphicon-upload"></span>
							Mete Mizik la
						</button>
					</p>
				</div>

				<div class="col-sm-8 col-sm-offset-4">
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					    60%
					  </div>
					</div>
					<div id="message"></div>
				</div>

			{{ Form::close() }}

		</div>
		</div>
	</div>


	<script src="/js/lib/jquery.min.js"></script>
	<script src="/js/lib/bootstrap.min.js"></script>
	<script src="/js/lib/jquery.form.min.js"></script>
	<script>

		$(document).ready(function()
		{

		    var options = {
			    beforeSend: function()
			    {
			        //clear everything
			        $('.progress').show();
			        $("#message").html("");
			        $('.progress-bar').html('0%');
			    },
			    uploadProgress: function(event, position, total, percentComplete)
			    {
			        $('.progress-bar').width(percentComplete + '%');
			        $('.progress-bar').html(percentComplete + '%');
			    },
			    success: function()
			    {
			         $('.progress-bar').width('100%');
			        $('.progress-bar').html('100%');

			    },
			    complete: function(response)
			    {
			        // $("#message").html("<font color='green'>"+response.responseText+"</font>");
			        // $("#message").html("<font color='green'>Uploaded with success</font>");
			        console.log( response );
			        // window.location = '/mp3/' + response.responseText;
			    },
			    error: function()
			    {
			        $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

			    }

			};

		    $("#mp3Form").ajaxForm(options);

		});
	</script>
</body>
</html>