<?php $cats = Category::remember(999, 'categories')->orderBy('name')->get(); ?>

@if ($role == 'nav')
	@foreach($cats as $cat)

		<li>
			<a
				href="/cat/{{ $cat->slug }}">
				<i class="fa fa-chevron-right"></i>
				{{ $cat->name }}

				<span class="badge">
					{{ $cat->tcount }}
				</span>
			</a>
		</li>

	@endforeach
@elseif($role == 'module')
	@foreach($cats as $cat)

		<strong>
			<a class="list-group-item" href="/cat/{{ $cat->slug }}">
				<i class="fa fa-chevron-right"></i>
				{{ $cat->name }}
				<span class="badge pull-right">
					{{ $cat->tcount }}
				</span>
			</a>
		</strong>

	@endforeach
@endif