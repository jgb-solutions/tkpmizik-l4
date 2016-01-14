@foreach ( $mp4s as $mp4 )

<div class="col-sm-12">
	<a href="/mp4/{{ $mp4->id }}">

		<div class="row box-shadow">
			<div class="col-sm-4 col-xs-4">
				<div class="row">
					<img
				  		alt="{{ $mp4->name }}"
						class="img-responsive small-square lazy"
						data-original="{{ $mp4->image }}">
				</div>
			</div>
			<div class="col-sm-8 col-xs-8 right">
				<h4 class="mTop6">
					{{ $mp4->name }}
				</h4>
				<p class="text-muted">
		    		<i class="fa fa-eye"></i> Afichaj:
		    		{{ $mp4->views }} <br>
		    		<i class="fa fa-download"></i> Telechajman:
		    		{{ $mp4->download }}
		    	</p>
			</div>
		</div>

	</a>
</div>
@endforeach