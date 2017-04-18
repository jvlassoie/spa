<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Modifier</legend>

		<div class="form-group">
			<label for="username" class="col-lg-2 control-label">User Name</label>
			<div class="col-lg-10">
				<input type="text" name="username" id="username" class="form-control" value="<?= $donnees[0]->UsersUsername ?>" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="firstname" class="col-lg-2 control-label">First Name</label>
			<div class="col-lg-10">
				<input type="text" name="firstname" id="firstname" class="form-control" value="<?= $donnees[0]->UsersFirstname ?>" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="lastname" class="col-lg-2 control-label">Last Name</label>
			<div class="col-lg-10">
				<input type="text" name="lastname" id="lastname" class="form-control" value="<?= $donnees[0]->UsersLastname ?>" require/>
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-lg-2 control-label">Password</label>
			<div class="col-lg-10">
				<input type="password" name="password" id="password" class="form-control" value="<?= $donnees[0]->UsersPassword ?>" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-lg-2 control-label">Email</label>
			<div class="col-lg-10">
				<input type="email" name="email" id="email" class="form-control" value="<?= $donnees[0]->UsersEmail ?>" require/>
			</div>
		</div>


		<div class="form-group">
			<label for="idRole" class="col-lg-2 control-label">Role</label>
			<div class="col-lg-10">
				<select name="idRole" class="form-control" id="idRole">
					<option value="<?= $donnees[0]->RolesId ?>"><?= $donnees[0]->RolesName ?></option>
					<?php
					foreach ($role as $key => $value):
						?>
					<?php if ($value->id != $donnees[0]->RolesId): ?>
						<option value=<?= $value->id ?> ><?= $value->name ?></option>
					<?php endif; ?>
				<?php endforeach ?>
			</select>
			<br>
		</div>
	</div>		

	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary">Modifier</button>
	</div>
</fieldset>
</form>