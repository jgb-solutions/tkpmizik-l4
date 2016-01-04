<form role="search" action="/search" id="mainSearchForm" class="mainSearchForm">
	<div class="input-group">
		<input
			id="q"
			name="q"
			type="text"
			class="form-control"
			placeholder="Chèche Mizik ak Videyo"
			value="{{ Input::get('q') }}"
		>
		<input id="typeInput" type="hidden" name="type" value="">
		<span class="input-group-btn">
			<button class="btn btn-success" type="submit">
				<i class="fa fa-search"></i>

			</button><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span></button>
	        <ul class="dropdown-menu dropdown-menu-right" role="menu">
				<li>
					<a href="MP3" data-type="MP3">
						<i class="fa fa-music"></i>
						Chèche Mizik Sèlman
					</a>
				</li>
				<li>
					<a href="MP4" data-type="MP4">
						<i class="fa fa-video-camera"></i>
						Chèche Videyo Sèlman
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="all" data-type="">
						<i class="fa fa-search"></i>
						Chèche Mizik ak Videyo
					</a>
				</li>
	        </ul>

		</span>
	</div>


</form>