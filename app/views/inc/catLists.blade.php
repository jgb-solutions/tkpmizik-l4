<div class="col-sm-6">
	<table class="table table-condensed table-striped table-bordered">
		<tbody>

		@foreach ( $categories as $category )

			<tr>
				<td><a href="/cat/{{ $category->slug }}">{{ $category->name }}</a></td>
				<td>
					<a href="/cat/edit/{{$category->id}}">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
				<td>
					<a href="/cat/delete/{{$category->id}}">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
</div>