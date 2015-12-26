{{ Form::open(['url' => '/register', 'method' => 'post', 'class' => 'form-horizontal color-black']) }}
	<div class="form-group">
		<label for="regname" class="col-sm-4 control-label">Kòman Ou Rele?</label>
		<div class="col-sm-8">
			<input name="name" type="name" class="form-control" id="regname" placeholder="Antre Non Ou" required value="{{ Input::old('name') }}">
		</div>
	</div>
	<div class="form-group">
		<label for="regemail" class="col-sm-4 control-label">Ki Adrès Imel Ou?</label>
		<div class="col-sm-8">
			<input name="email" type="email" class="form-control" id="regemail" placeholder="Antre Imel ou" required value="{{ Input::old('email') }}">
		</div>
	</div>
	<div class="form-group">
		<label for="regpassword" class="col-sm-4 control-label">Chwazi Yon Modpas</label>
		<div class="col-sm-8">
			<input name="password" type="password" class="form-control" id="regpassword" placeholder="Antre Yon Modpas" required>
		</div>
	</div>
	<div class="form-group">
		<label for="regpasswordconfirm" class="col-sm-4 control-label">Konfime Modpas La</label>
		<div class="col-sm-8">
			<input name="password_confirm" type="password" class="form-control" id="regpasswordconfirm" placeholder="Antre Modpas Ou a Ankò" required>
		</div>
	</div>

	<div class="form-group">
		<label for="telephone" class="control-label col-sm-4">Nimewo Telefòn ou</label>
		<div class="col-sm-8">
			<input name="telephone" type="tel" class="form-control" id="telephone" placeholder="Antre nimwwo telefòn ou" value="{{ Input::old('telephone') }}">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-4">
			<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> Kreye Kont</button>
		</div>
	</div>
</form>