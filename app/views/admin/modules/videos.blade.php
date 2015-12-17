<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $mp4s as $mp4 )
			<tr>
				<td>
					<span class="glyphicon glyphicon-music"></span>
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
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
				<td>

					<a
						href="/mp4/delete/{{ $mp4->id }}"
						onclick='return confirm("Ou Vle Efase {{ $mp4->name }} tout bon?")'
						class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>