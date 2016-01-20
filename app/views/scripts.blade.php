<script async src="{{ TKPM::asset('js/app.js') }}"></script>

@unless ( App::isLocal() )
	<script
		async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
	</script>
	{{-- Facebook Page Plugin --}}
	@include('inc.fb-script')

	{{-- Google Analytics --}}
	@include('inc.ga')

@endunless