<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $users as $user )
			<tr>
				<td>
					<i class="fa fa-user"></i>
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
						<i class="fa fa-edit"></i>
					</a>
				</td>
				<td>

					<a
						href="/admin/user/delete/{{ $user->id }}"
						onclick='return confirm("Ou Vle Efase {{ $user->name }} tout bon?")'
						class="btn btn-danger">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>