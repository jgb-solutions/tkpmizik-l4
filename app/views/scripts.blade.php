<script async src="{{ TKPM::asset('js/appp.js') }}"></script>

@unless ( App::isLocal() )

	{{-- Facebook Page Plugin --}}
	@include('inc.fb-script')

	{{-- Google Analytics --}}
	@include('inc.ga')

@endunless