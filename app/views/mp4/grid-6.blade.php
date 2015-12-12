@foreach ( $mp4s as $mp4 )

<div class="col-sm-6">
	<a href="/mp4/{{ $mp4->id }}">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="row box-shadow">
					<div class="col-sm-4 col-xs-4">
						<div class="row">
							<img
								src="/uploads/images/thumbs/{{ $mp4->image }}"
						  		alt="{{ $mp4->name }}"
								class="img-reponsive small-square">
						</div>
					</div>
					<div class="col-sm-8 col-xs-8 right">
						<h4 class="mTop6">{{ $mp4->name }}</h4>
						<p class="text-muted">
				    		<span class="glyphicon glyphicon-eye-open"></span> Afichaj:
				    		{{ $mp4->views }} <br>
				    		<span class="glyphicon glyphicon-headphones"></span> Ekout:
				    		{{ $mp4->play }} <br>
				    		<span class="glyphicon glyphicon-download-alt"></span> Telechajman:
				    		{{ $mp4->download }}
				    	</p>
					</div>
				</div>
			</div>
		</div>
	</a>
</div>

@endforeach