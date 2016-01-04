<div class="col-sm-12">
	<a href="/mp4/{{ $rel->id }}">
		<div class="row box-shadow">
			<div class="col-sm-4 col-xs-4">
				<div class="row">
					<img
						src="{{ $rel->image }}"
				  		alt="{{ $rel->name }}"
						class="img-responsive small-square">
				</div>
			</div>
			<div class="col-sm-8 col-xs-8 right">
				<h4 class="mTop6">
					@if ( $rel->price == 'paid')
					<i class="fa fa-money"></i>
					@endif
					{{ $rel->name }}
				</h4>
				<p class="text-muted">
		    		<i class="fa fa-eye"></i> Afichaj:
		    		{{ $rel->views }} <br>
		    		@if( $rel->price == 'free')
		    		<i class="fa fa-headphones"></i> Ekout:
		    		{{ $rel->play }} <br>
		    		@endif
		    		<i class="fa fa-download"></i> Telechajman:
		    		{{ $rel->download }}
		    	</p>
			</div>
		</div>
	</a>
</div>