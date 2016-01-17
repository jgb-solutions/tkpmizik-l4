<div
	class="row audio-image"
	style="background-image:url('{{ TKPM::asset($mp3->image, 'thumbs') }}')">

	<div class="col-sm-12 audio-content">
		<div class="ui360 ui360-vis">
			<a href="/mp3/play/{{ $mp3->id }}" type="audio/mpeg"></a>
		</div>
		{{-- <audio src="/mp3/play/{{ $mp3->id }}" controls></audio> --}}
	</div>
</div>
<hr>