<!DOCTYPE html>
<html lang="ht_HT">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 style="text-align:center;">
			<a href="{{ Config::get('site.url') }}">
				<img src="{{ TKPM::asset(Config::get('site.logo_small')) }}" style="max-width:100%" /></a>
		</h1>
		<h2>Byenvini sou {{ Config::get('site.name') }} {{ $user['name'] }}</h2>

		<p>Ou fèk kreye yon kont avèk imel <b>{{ $user['email'] }}</b> epi modpas ou chwazi a. Nou kontan ou rejwenn nou. Men plizyè avantaj ou genyen lè w kreye kont ou:</p>

		<ul>
			<li>Ou ka modifye <a href="{{Config::get('site.url')}}/mp3/up">mizik</a> ak <a href="{{Config::get('site.url')}}/mp4/up">videyo</a> ou mete yo.</li>
			<li>Ou ka efase <a href="{{Config::get('site.url')}}/mp3/up">mizik</a> ak <a href="{{Config::get('site.url')}}/mp4/up">videyo</a> ou mete yo.</li>
			<li>Ou ka <a href="{{Config::get('site.url')}}/mp3/buy">vann mizik</a> ou si w vle.</li>
			<li>Ou ka vote <a href="{{Config::get('site.url')}}/mp3">mizik</a> ak <a href="{{Config::get('site.url')}}/mp4">videyo</a> pa w oubyen pa lòt moun.</li>
			<li>W'ap jwenn lyen <a href="{{Config::get('site.url')}}/user/mp3">mizik</a> ak <a href="{{Config::get('site.url')}}/user/mp4">videyo</a> ou mete yo sou imel ou.</li>
			<li>Ak lòt mesaj enpòtan nou gen pou kominike w lè sa nesesè.</li>
		</ul>

		<p>Tou pwofite swiv nou sou rezo sosyal yo:<br>
			<ul>
				<li><a href="https://www.facebook.com/tikwenpam">FB / Ti Kwen Pam</a></li>
				<li><a href="https://twitter.com/tikwenpam">Twitter / Ti Kwen Pam</a></li>
				<li><a href="https://twitter.com/tkpmizik">Twitter / {{ Config::get('site.name') }}</a></li>
				<li><a href="https://google.com/+TiKwenPam">Google + / Ti Kwen Pam</a></li>
				<li><a href="tel:+50936478199">WhatsApp / +509 3647 8199</a></li>
				<li><a href="https://pin.bbm.com/58F62DED">BBM / 58F62DED</a></li>
				<li><a href="https://instagram.com/tikwenpam">Instagram / Ti Kwen Pam</a></li>
			</ul>
		</p>
		<p>&copy; 2012 - {{ date('Y') . ' ' . Config::get('site.name') }}, Tout Dwa Rezève</p>
		<p>{{ Config::get('site.name') }} se yon sèvis konpayi Ti Kwen Pam</p>
	</body>
</html>