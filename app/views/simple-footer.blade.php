</div>
	<div class="row" id="footer">

		<div class="col-sm-12 bg-black padding1">
			<h4 class="text-center text-uppercase">Swiv Nou Sou:</h4>

			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="col-xs-3 text-center">
						<a class="btn btn-primary btn-lg" href="https://www.facebook.com/tikwenpam"  target="_blank"
						title="Facebook">&nbsp;<i class="fa fa-facebook fa-2x"></i>&nbsp;</a>
					</div>
					<div class="col-xs-3 text-center">
						<a class="btn btn-info btn-lg" href="https://twitter.com/tikwenpam" target="_blank"
						title="Twitter"><i class="fa fa-twitter fa-2x"></i></a>
					</div>
					<div class="col-xs-3 text-center">
						<a class="btn btn-danger btn-lg" href="https://google.com/+TiKwenPam" target="_blank"
						title="Google+"><i class="fa fa-google-plus fa-2x"></i></a>
					</div>
					<div class="col-xs-3 text-center">
						<a
							class="btn btn-default btn-lg bg-warning"
							href="https://instagram.com/tikwenpam"
							target="_blank"
							title="Instagram"
						>
							<i class="fa fa-instagram fa-2x"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="col-sm-6 col-sm-offset-3">
					<hr>
				</div>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
				<p class="text-center text-uppercase">
					&copy; 2012 - {{ date('Y') . ' ' . Config::get('site.name') }},
					Tout Dwa Rezève.
				</p>
				<p class="text-center text-uppercase">
					{{ Config::get('site.name') }} se yon konpayi Ti Kwen Pam.
				</p>
				<p class="text-center text-uppercase">
					Dizay ak Kòd:
					<a
						href="http://jgbnd.com"
						title="JGB! Neat Design"
						class="text-warning"
						target="_blank"
					>JGB!
					</a>
				</p>
			</div>
		</div>
	</div>


</div>

	@include('scripts')

</body>
</html>