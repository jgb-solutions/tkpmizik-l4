<div class="row">
{{-- 	<div class="col-sm-6 col-sm-push-6 hidden-xs text-center">

	@if ( $mp3->image )

		<img
			src="/uploads/images/thumbs/{{ $mp3->image }}"
			class="img-responsive img-thumbnail img-bordered"
		>

	@endif

	</div> --}}

	<div class="col-sm-12">
		<div class="ui360 ui360-vis">
			<a href="/mp3/play/{{ $mp3->id }}" type="audio/mpeg"></a>
		</div>
		{{-- <audio src="/mp3/play/{{ $mp3->id }}" controls></audio> --}}
	</div>
</div>
<hr>