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
			<img width="50" src="/images/logo.png" class="img-responsive hidden-xs" alt="{{ Config::get('site.name') }}">
			<img class="logo-mizik" src="/images/logo-mizik.png" class="img-responsive visible-xs-block" alt="{{ Config::get('site.name') }}">
		</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a
					href="#"
					class="dropdown-toggle"
					data-toggle="dropdown">
					<i class="fa fa-music"></i>
					Mizik
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					<li>
						<a
							href="/mp3">
							<i class="fa fa-music"></i>
							Tout Mizik Yo
						</a>
					</li>
					<li>
						<a href="/mp3/buy">
							<i class="fa fa-music"></i>
							Mizik Pou Vann
							<i class="fa fa-dollar"></i>
						</a>
					</li>
					<li>
						<a href="/mp3/up">
							<i class="fa fa-cloud-upload"></i>
							Mete Mizik
						</a>
					</li>
				</ul>
			</li>

			<li class="dropdown">
				<a
					href="#"
					class="dropdown-toggle"
					data-toggle="dropdown">
					<i class="fa fa-video-camera"></i>
					Videyo
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					<li>
						<a href="/mp4">
							<i class="fa fa-video-camera"></i>
							Tout Videyo Yo
						</a>
					</li>
					<li>
						<a href="/mp4/up">
							<i class="fa fa-cloud-upload"></i>
							Mete Videyo
						</a>
					</li>
				</ul>
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

					<?php $cats = Category::remember()->orderBy('name')->get(); ?>

					@foreach( $cats as $cat )
					<li>
						<a
							href="/cat/{{ $cat->slug }}">
							<i class="fa fa-chevron-right"></i>
							{{ $cat->name }}
						</a>
					</li>
					@endforeach

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
					<?php $pages = Page::all(); //Page::remember->get(); ?>

					@foreach ( $pages as $page )
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
				<?php $user = Auth::user(); ?>

				<li class="dropdown">
					<a
						href="#"
						class="dropdown-toggle"
						data-toggle="dropdown"
					>

					<i class="fa fa-user"></i>
					Alo, {{ $user->name }} <b class="caret"></b></a>
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

						@if ( $user->is_admin() )
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

					@include('login.log-reg')

				</li>

			@endif
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>