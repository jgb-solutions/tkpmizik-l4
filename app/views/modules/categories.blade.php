<div class="list-group">
  	<li class="list-group-item active">
    	<h4><i class="fa fa-th-list"></i> Kategori</h4>
  	</li>

	<?php $cats = Category::remember(999, 'categories')->orderBy('name')->get(); ?>

	@if ( $cats && count( $cats ) > 0 )

		<ul class="list-unstyled">

			@foreach( $cats as $cat )

			<strong>

				<a class="list-group-item" href="/cat/{{ $cat->slug }}">
					<i class="fa fa-chevron-right"></i> {{ $cat->name }}
				</a>
			</strong>

			@endforeach

		</ul>
	@endif
</div>
