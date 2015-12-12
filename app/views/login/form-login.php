<form role="form" action="/login" method="post" class="form-horizontal">
	<div class="form-group">
		<label for="email" class="col-sm-3 control-label">Adrès Imel</label>
		<div class="col-sm-9">
			<input name="email" type="email" class="form-control" id="email" placeholder="Antre Imel Ou" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-3 control-label">Modpas</label>
		<div class="col-sm-9">
			<input name="password" type="password" class="form-control" id="password" placeholder="Antre Modpas Ou" required>
		</div>
	</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember"> Sonje M
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary btn-lg">
		<span class="glyphicon glyphicon-log-in"></span> Koneksyon
	</button>
    </div>
  </div>
</form>