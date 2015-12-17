<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $categories as $category )
			<tr>
				<td>
					<span class="glyphicon glyphicon-th"></span>
				</td>
				<td>
					<strong>
						<a href="/cat/{{ $category->slug }}">
						{{ $category->name }}</a>
					</strong>
				</td>
				<td>
					<a
						class="btn btn-default"
						href="/admin/cat/edit/{{ $category->id }}">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
				<td>

					<a
						href="/admin/cat/delete/{{ $category->id }}"
						onclick='return confirm("Ou Vle Efase {{ $category->name }} tout bon?")'
						class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>