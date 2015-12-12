@include('mp3s.inc.header')
<div class="row">
	<div class="col-sm-8">
		<h1 class="text-center">{{ $title }}</h1>
		<hr>

		@if( $mp3s )

			<div class="panel panel-default">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<thead>
						<th><span class="glyphicon glyphicon-music"></span> Name</th>
						<th><span class="glyphicon glyphicon-play"></span> Play</th>
						<th><span class="glyphicon glyphicon-download-alt"></span> Download</th>
					</thead>
					@foreach ( $mp3s as $mp3 )
						<tr>
							<td>
								<h4>
									<a href="/mp3/{{ $mp3->id }}">
									{{ $mp3->name }}</a>
								</h4>
							</td>
							<td>{{ $mp3->play }}</td>
							<td>{{ $mp3->download }}</td>
						</tr>
					@endforeach
				</table>
			</div>

			<div class="text-center"> {{ $mp3s->links() }}</div>

		@endif

	</div>

@include('mp3s.sidebar')

@include('mp3s.inc.footer')