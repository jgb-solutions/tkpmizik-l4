<nav class="navbar navbar-inverse" role="navigation">
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
					<span class="glyphicon glyphicon-music"></span>
					Mizik
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					<li>
						<a
							href="/mp3">
							<span class="glyphicon glyphicon-music"></span>
							Tout Mizik Yo
						</a>
					</li>
					<li>
						<a href="/mp3/up">
							<span class="glyphicon glyphicon-upload"></span>
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
					<span class="glyphicon glyphicon-facetime-video"></span>
					Videyo
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					<li>
						<a href="/mp4">
							<span class="glyphicon glyphicon-facetime-video"></span>
							Tout Videyo Yo
						</a>
					</li>
					<li>
						<a href="/mp4/up">
							<span class="glyphicon glyphicon-upload"></span>
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
					<span class="glyphicon glyphicon-th"></span>
					Kategori
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">

					<?php $cats = Category::orderBy('name')->get(); ?>

					@foreach( $cats as $cat )
					<li>
						<a
							href="/cat/{{ $cat->slug }}">
							<span class="glyphicon glyphicon-chevron-right"></span>
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
					<span class="glyphicon glyphicon-th"></span>
					Paj
					<b class="caret"></b>
				</a>

				<ul class="dropdown-menu">
					<?php $pages = Page::all(); //Page::remember->get(); ?>

					@foreach ( $pages as $page )
					<li>
						<a
							href="/p/{{ $page->slug }}">
							<span class="glyphicon glyphicon-flash"></span>
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

					<span class="glyphicon glyphicon-user"></span>
					Alo, {{ Auth::user()->name }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="/user">
								<span class="glyphicon glyphicon-user"></span>
								Ale Sou Pwofil Ou
							</a>
						</li>
						<li>
							<a href="/user/mp3">
								<span class="glyphicon glyphicon-music"></span>
								Mizik Ou Yo
							</a>
						</li>
						<li>
							<a href="/user/mp4">
								<span class="glyphicon glyphicon-facetime-video"></span>
								Videyo ou Yo
							</a>
						</li>
						<li>
							<a href="/user/edit">
								<span class="glyphicon glyphicon-edit"></span>
								Modifye Pwofil Ou
							</a>
						</li>
						<li>
							<a href="/logout">
								<span class="glyphicon glyphicon-log-out"></span>
								Dekoneksyon
							</a>
						</li>
					</ul>
				</li>
			@else

				<li>
					<a data-toggle="modal" href='#log-reg-id'>
					<span class="glyphicon glyphicon-user"></span>
					Koneksyon --|-- Kreye Kont</a>

					@include('login.log-reg')

				</li>

			@endif
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>