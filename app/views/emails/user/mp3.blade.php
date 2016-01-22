@include('emails.user.header')

	<h2>Felisitasyon!!! Ou fèk mete yon nouvo mizik: {{ $mp3['name'] }}</h2>

	<p>Ou fèk mete yon nouvo mizik: <b>{{ $mp3['name'] }}</b></p>

	<p>Men plizyè lyen ki pèmèt ou manipile/jere mizik ou a:</p>

	<ul>
		<li>Tande/Telechaje:
			<a href="{{ Config::get('site.url') }}/mp3/{{ $mp3['id'] }}">
				{{ Config::get('site.url') }}/mp3/{{ $mp3['id'] }}
			</a>
		</li>
		<li>Telechaje dirèk:
			<a href="{{ Config::get('site.url') }}/mp3/get/{{ $mp3['id'] }}">
				{{ Config::get('site.url') }}/mp3/get/{{ $mp3['id'] }}
			</a>
		</li>
		<li>Modifye:
			<a href="{{ Config::get('site.url') }}/mp3/{{ $mp3['id'] }}/edit">
				{{ Config::get('site.url') }}/mp3/{{ $mp3['id'] }}/edit
			</a>
		</li>
		<li>Efase:
			<a href="{{ Config::get('site.url') }}/mp3/delete/{{ $mp3['id'] }}">
				{{ Config::get('site.url') }}/mp3/delete/{{ $mp3['id'] }}
			</a>
		</li>
	</ul>

@include('emails.user.footer')
