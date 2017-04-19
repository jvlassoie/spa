<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Confirmation</th>
			<th>User</th>
			<th>Animal</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include_once('../app/view/public/shorting.php');
		?>
		<a href='/appointment/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>
		<?php
		foreach ($a as $key => $value) {
			?>
			<tr>
				<td><?= $value->AppointmentsId ?></td>
				<td><?= $value->AppointmentsDateOfApp ?></td>
				<td><?= $value->AppointmentsTimeOfApp ?></td>
				<td><?= ($value->AppointmentsStatus == 1)? "Confirmé" : "Non Confirmé" ; ?></td>
				<td><?= $value->UsersUsername ?></td>
				<td><?= $value->AnimalsName ?></td>
				
				<td>
					<a href="/appointment/update/<?= $value->AppointmentsId ?>" class='btn btn-primary'>Edit</a> 
					<a href="/appointment/delete/<?= $value->AppointmentsId ?>/<?= $value->AnimalsId?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
			<?php
		}

		?>
	</tbody>
</table>


<?php
include('../app/view/public/pagination.php');
?>


