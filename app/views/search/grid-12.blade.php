@foreach ( $results as $type )

<div class="col-sm-12">
	<a href="/{{ $type->type }}/{{ $type->id }}">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="row box-shadow">
					<div class="col-sm-4 col-xs-4">
						<div class="row">
							<img
								src="/uploads/images/thumbs/{{ $type->image }}"
						  		alt="{{ $type->name }}"
								class="img-reponsive small-square">
						</div>
					</div>
					<div class="col-sm-8 col-xs-8 right">
						<h4 class="mTop6">
							@if ( $mp3->price == 'paid')
							<i class="fa fa-money"></i>
							@endif
							{{ $mp3->name }}
						</h4>
						<p class="text-muted">
				    		<span class="glyphicon glyphicon-eye-open"></span> Afichaj:
				    		{{ $type->views }} <br>
				    		<span class="glyphicon glyphicon-download-alt"></span> Telechajman:
				    		{{ $type->download }}
				    	</p>
					</div>
				</div>
			</div>
		</div>
	</a>
</div>
@endforeach