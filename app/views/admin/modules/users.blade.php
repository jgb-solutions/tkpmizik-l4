<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $users as $user )
			<tr>
				<td>
					<span class="glyphicon glyphicon-user"></span>
				</td>
				<td>
					<strong>
						<a href="/u/{{ $user->id }}">
						{{ $user->name }}</a>
					</strong>
				</td>
				<td>
					<a
						class="btn btn-default"
						href="/admin/user/edit/{{ $user->id }}">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
				<td>

					<a
						href="/admin/user/delete/{{ $user->id }}"
						onclick='return confirm("Ou Vle Efase {{ $user->name }} tout bon?")'
						class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>