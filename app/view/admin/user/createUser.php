<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Création</legend>

		<div class="form-group" id="msgPass">
			
		</div>
		<div class="form-group">
			<label for="username" class="col-lg-2 control-label">User Name</label>
			<div class="col-lg-10">
				<input type="text" name="username" id="username" class="form-control" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-lg-2 control-label">First Name</label>
			<div class="col-lg-10">
				<input type="text" name="firstname" id="firstname" class="form-control" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="lastname" class="col-lg-2 control-label">Last Name</label>
			<div class="col-lg-10">
				<input type="text" name="lastname" id="lastname" class="form-control" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="enterPassword" class="col-lg-2 control-label">Password</label>
			<div class="col-lg-10">
				<input type="password" name="password" id="enterPassword" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="verifPassword" class="col-lg-2 control-label">Verification Password</label>
			<div class="col-lg-10">
				<input type="password" name="verifPassword" id="verifPassword" class="form-control" require/>
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