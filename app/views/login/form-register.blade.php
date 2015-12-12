{{ Form::open(['url' => '/register', 'method' => 'post', 'class' => 'form-horizontal']) }}
	<div class="form-group">
		<label for="regname" class="col-sm-3 control-label">Kòman Ou Rele?</label>
		<div class="col-sm-9">
			<input name="name" type="name" class="form-control" id="regname" placeholder="Antre Non Ou" required value="{{ Input::old('name') }}">
		</div>
	</div>
	<div class="form-group">
		<label for="regemail" class="col-sm-3 control-label">Ki Adrès Imel Ou?</label>
		<div class="col-sm-9">
			<input name="email" type="email" class="form-control" id="regemail" placeholder="Enter Your Email" required value="{{ Input::old('email') }}">
		</div>
	</div>
	<div class="form-group">
		<label for="regpassword" class="col-sm-3 control-label">Chwazi Yon Modpas</label>
		<div class="col-sm-9">
			<input name="password" type="password" class="form-control" id="regpassword" placeholder="Antre Yon Modpas" required>
		</div>
	</div>
	<div class="form-group">
		<label for="regpasswordconfirm" class="col-sm-3 control-label">Konfime Modpas La</label>
		<div class="col-sm-9">
			<input name="password_confirm" type="password" class="form-control" id="regpasswordconfirm" placeholder="Antre Modpas Ou a Ankò" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-9 col-sm-offset-3">
			<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> Kreye Kont</button>
		</div>
	</div>
</form>