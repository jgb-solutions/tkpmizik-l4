@foreach ( $mp3s as $mp3 )

<div class="col-sm-6">
	<a href="/mp3/{{ $mp3->id }}">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="row box-shadow">
					<div class="col-sm-4 col-xs-4">
						<div class="row">
							<img
								src="/uploads/images/thumbs/{{ $mp3->image }}"
						  		alt="{{ $mp3->name }}"
								class="img-reponsive small-square">
						</div>
					</div>
					<div class="col-sm-8 col-xs-8 right">
						<h4 class="mTop6">{{ $mp3->name }}</h4>
						<p class="text-muted">
				    		<span class="glyphicon glyphicon-eye-open"></span> Afichaj:
				    		{{ $mp3->views }} <br>
				    		<span class="glyphicon glyphicon-headphones"></span> Ekout:
				    		{{ $mp3->play }} <br>
				    		<span class="glyphicon glyphicon-download-alt"></span> Telechajman:
				    		{{ $mp3->download }} <br>

				    		@if ( $mp3->description )
							<span class="visible-xs">
				    			<span class="glyphicon glyphicon-align-justify"></span>
				    			{{ $mp3->description }}
				    		</span>
				    		@endif
				    	</p>
					</div>
				</div>
			</div>
		</div>
	</a>
</div>

@endforeach