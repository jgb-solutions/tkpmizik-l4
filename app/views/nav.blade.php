<nav class="navbar navbar-inverse bg-black" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/" title="{{ Config::get('site.name') }}">
			<img width="50" src="{{ TKPM::asset('images/logo.png') }}" class="img-responsive hidden-xs" alt="{{ Config::get('site.name') }}">
			<img class="logo-mizik lazy" src="{{ TKPM::asset('images/logo-mizik.png') }}" class="img-responsive visible-xs-block" alt="{{ Config::get('site.name') }}">
		</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li>
				<a
					href="/mp3"
					<i class="fa fa-music"></i>
					Mizik
				</a>
			</li>

			<li>
				<a
					href="/mp4"
					<i class="fa fa-video-camera"></i>
					Videyo
				</a>
			</li>

			<li class="dropdown">
				<a
					href="#"
					class="dropdown-toggle"
					data-toggle="dropdown">
					<i class="fa fa-th-list"></i>
					Kategori
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					@include('cats.list-cats', ['role' => 'nav'])
				</ul>
			</li>

			<li class="dropdown">
				<a
					href="#"
					class="dropdown-toggle"
					data-toggle="dropdown">
					<i class="fa fa-file"></i>
					Paj
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">

					@foreach ($pages as $page)
					<li>
						<a
							href="/p/{{ $page->slug }}">
							<i class="fa fa-file"></i>
							{{ $page->title }}
						</a>
					</li>
					@endforeach

				</ul>
			</li>

		</ul>

		<ul class="nav navbar-nav navbar-right">
			@if ( Auth::check() )
				<li class="dropdown">
					<a
						href="#"
						class="dropdown-toggle"
						data-toggle="dropdown"
					>

					<i class="fa fa-user"></i>
					Alo, {{ $cUser->name }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="/user">
								<i class="fa fa-user"></i>
								Ale Sou Pwofil Ou
							</a>
						</li>
						<li>
							<a href="/user/mp3">
								<i class="fa fa-music"></i>
								Mizik Ou Yo
							</a>
						</li>
						<li>
							<a href="/user/mp4">
								<i class="fa fa-video-camera"></i>
								Videyo ou Yo
							</a>
						</li>
						<li>
						    <a href="/user/my-bought-mp3s">
						    	<i class="fa fa-music"></i>
						    	Mizik Ou Achte
						    	<i class="fa fa-money"></i>
						    </a>
						<li>
							<a href="/user/edit">
								<i class="fa fa-edit"></i>
								Modifye Pwofil Ou
							</a>
						</li>

						@if ( $cUser->is_admin() )
						<li>
							<a href="/admin">
								<i class="fa fa-bar-chart-o"></i>
								Administrasyon
							</a>
						</li>
						@endif

						<li>
							<a href="/logout">
								<i class="fa fa-sign-out"></i>
								Dekoneksyon
							</a>
						</li>
					</ul>
				</li>
			@else

				<li>
					<a data-toggle="modal" href='#log-reg-id'>
					<i class="fa fa-user"></i>
					Koneksyon --|-- Kreye Kont</a>

					@if ( Auth::guest() )
						@include('login.log-reg')
					@endif

				</li>

			@endif
		</ul>
	</div>
</nav>