<div class="col-sm-4">
	<div class="list-group">
	  	<li class="list-group-item active">
	    	<h4><span class="glyphicon glyphicon-th"></span> Kategori</h4>
	  	</li>

		<?php $cats = Category::remember(60)->orderBy('name')->get(); ?>

		@if ( $cats && count( $cats ) > 0 )

			<ul class="list-unstyled">

				@foreach( $cats as $cat )

				<strong>

					<a class="list-group-item" href="/cat/{{ $cat->slug }}">
						<span class="glyphicon glyphicon-chevron-right"></span> {{ $cat->name }}
					</a>
				</strong>

				@endforeach

			</ul>
		@endif
	</div>
</div>