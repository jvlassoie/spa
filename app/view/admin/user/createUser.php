<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Création</legend>

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
			<label for="email" class="col-lg-2 control-label">Email</label>
			<div class="col-lg-10">
				<input type="email" name="email" id="email" class="form-control" require/>
			</div>
		</div>


		<div class="form-group">
			<label for="role" class="col-lg-2 control-label">Role</label>
			<div class="col-lg-10">
				<select name="role" class="form-control" id="role">
					<?php
					foreach ($role as $key => $value):
					?>
						<option value=<?= $value->id ?> ><?= $value->name ?></option>
					<?php endforeach ?>
			</select>
			<br>
		</div>
	</div>		

	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary">Créer</button>
	</div>
</fieldset>
</form>