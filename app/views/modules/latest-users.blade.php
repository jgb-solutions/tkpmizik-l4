<div class="list-group">
  	<a href="/users" class="list-group-item active">
    	<h4><i class="fa fa-user"></i> Itilizatè Resan</h4>
  	</a>

  	<?php $users = User::remember(120)->latest()->take(5)->get(); ?>

	@if ($users && count($users) )
		<ul class="list-unstyled">

			@foreach( $users as $user )

			<strong>
				<a
					class="list-group-item"
					href="{{ $user->username ? '/@' . $user->username : '/u/' . $user->id }}">
					<i class="fa fa-user"></i> {{ $user->name }}
				</a>
			</strong>

			@endforeach
		</ul>
	@endif
</div>