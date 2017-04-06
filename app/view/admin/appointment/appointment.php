<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>Heure</th>
			<th>Confirmation</th>
			<th>User</th>
			<th>Liste des animaux</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<a href='/appointment/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php
		foreach ($a as $key => $value) {
			?>
			<tr>
				<td><?= $value->AppointmentsDateOfApp ?></td>
				<td><?= $value->AppointmentsTimeOfApp ?></td>
				<td><?= ($value->AppointmentsStatus == 1)? "Confirmé" : "Non Confirmé" ; ?></td>
				<td><?= $value->UsersName ?></td>
				<td>
					<ul>
						<li>asa</li>
						<li>asa</li>
					</ul>
					
				</td>
				<td>
					<a href="/appointment/update/<?= $value->AppointmentsId ?>" class='btn btn-primary'>Edit</a> 
					<a href="/appointment/view/delete/<?= $value->AppointmentsId ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
			<?php
		}

		?>
	</tbody>
</table>



