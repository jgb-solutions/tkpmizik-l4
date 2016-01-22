@include('emails.user.header')

	<h2>Felisitasyon!!! Ou fèk mete yon nouvo videyo: {{ $mp4['name'] }}</h2>

	<p>Ou fèk mete yon nouvo videyo: <b>{{ $mp4['name'] }}</b></p>

	<p>Men plizyè lyen ki pèmèt ou manipile/jere videyo ou a:</p>

	<ul>
		<li>Gade/Telechaje:
			<a href="{{ Config::get('site.url') }}/mp4/{{ $mp4['id'] }}">
				{{ Config::get('site.url') }}/mp4/{{ $mp4['id'] }}
			</a>
		</li>
		<li>Telechaje:
			<a href="{{ Config::get('site.url') }}/mp4/get/{{ $mp4['id'] }}">
				{{ Config::get('site.url') }}/mp4/get/{{ $mp4['id'] }}
			</a>
		</li>
		<li>Modifye:
			<a href="{{ Config::get('site.url') }}/mp4/{{ $mp4['id'] }}/edit">
				{{ Config::get('site.url') }}/mp4/{{ $mp4['id'] }}/edit
			</a>
		</li>
		<li>Efase:
			<a href="{{ Config::get('site.url') }}/mp4/delete/{{ $mp4['id'] }}">
				{{ Config::get('site.url') }}/mp4/delete/{{ $mp4['id'] }}
			</a>
		</li>
	</ul>

@include('emails.user.footer')
