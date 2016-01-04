<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $mp4s as $mp4 )
			<tr>
				<td>
					<i class="fa fa-video-camera"></i>
				</td>
				<td>
					<strong>
						<a href="/mp4/{{ $mp4->id }}">
						{{ $mp4->name }}</a>
					</strong>
				</td>
				<td>
					<a
						class="btn btn-default"
						href="/mp4/{{ $mp4->id }}/edit">
						<i class="fa fa-edit"></i>
					</a>
				</td>
				<td>

					<a
						href="/mp4/delete/{{ $mp4->id }}"
						onclick='return confirm("Ou Vle Efase {{ $mp4->name }} tout bon?")'
						class="btn btn-danger">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>