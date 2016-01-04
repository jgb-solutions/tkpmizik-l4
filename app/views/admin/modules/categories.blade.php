<div class="panel panel-default">
	<table class="table table-striped table-hover table-bordered table-condensed">

		<tbody>

		@foreach ( $categories as $category )
			<tr>
				<td>
					<i class="fa fa-th-list"></i>
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
						<i class="fa fa-edit"></i>
					</a>
				</td>
				<td>

					<a
						href="/admin/cat/delete/{{ $category->id }}"
						onclick='return confirm("Ou Vle Efase {{ $category->name }} tout bon?")'
						class="btn btn-danger">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>