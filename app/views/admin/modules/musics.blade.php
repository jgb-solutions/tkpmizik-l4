<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $mp3s as $mp3 )
			<tr>
				<td>
					<i class="fa fa-music"></i>
				</td>
				<td>
					<strong>
						<a href="/mp3/{{ $mp3->id }}">
							{{ $mp3->name }}
							@if ( $mp3->price == 'paid')
							- <i class="fa fa-dollar"></i>
							@endif
						</a>
					</strong>
				</td>
				<td>
					<a
						class="btn btn-default"
						href="/mp3/{{ $mp3->id }}/edit">
						<i class="fa fa-edit"></i>
					</a>
				</td>
				<td>

					<a
						href="/mp3/delete/{{ $mp3->id }}"
						onclick='return confirm("Ou Vle Efase {{ $mp3->name }} tout bon?")'
						class="btn btn-danger">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>