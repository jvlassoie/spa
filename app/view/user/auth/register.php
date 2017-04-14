<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Inscription</legend>

		<div class="form-group">
			<label for="name" class="col-lg-2 control-label">Nom</label>
			<div class="col-lg-10">
				<input type="text" name="name" id="name" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-lg-2 control-label">Password</label>
			<div class="col-lg-10">
				<input type="text" name="password" id="password" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="verifPassword" class="col-lg-2 control-label">Password</label>
			<div class="col-lg-10">
				<input type="text" name="verifPassword" id="verifPassword" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-lg-2 control-label">Email</label>
			<div class="col-lg-10">
				<input type="email" name="email" id="email" class="form-control" require/>
			</div>
		</div>
	

	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary">Inscription</button>
	</div>
</fieldset>
</form>