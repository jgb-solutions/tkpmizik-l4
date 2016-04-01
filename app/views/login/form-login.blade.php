<form role="form" action="/login" method="post" class="form-horizontal color-black">
	<div class="form-group">
		<label for="email" class="col-sm-4 control-label">Adrès Imel</label>
		<div class="col-sm-8">
			<input name="email" type="email" class="form-control" id="email" placeholder="Antre Imel Ou" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-4 control-label">Modpas</label>
		<div class="col-sm-8">
			<input name="password" type="password" class="form-control" id="password" placeholder="Antre Modpas Ou" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
		  	<button type="submit" class="btn btn-primary btn-lg">
				<i class="fa fa-sign-in"></i> Koneksyon
			</button>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<p>
				<a href="{{ action('RemindersController@postRemind') }}">
					Ou bliye modpas ou?
				</a>
			</p>

		</div>
	</div>
</form>