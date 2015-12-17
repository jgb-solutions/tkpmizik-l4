<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $mp3s as $mp3 )
			<tr>
				<td>
					<span class="glyphicon glyphicon-music"></span>
				</td>
				<td>
					<strong>
						<a href="/mp3/{{ $mp3->id }}">
						{{ $mp3->name }}</a>
					</strong>
				</td>
				<td>
					<a
						class="btn btn-default"
						href="/mp3/{{ $mp3->id }}/edit">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
				<td>

					<a
						href="/mp3/delete/{{ $mp3->id }}"
						onclick='return confirm("Ou Vle Efase {{ $mp3->name }} tout bon?")'
						class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>