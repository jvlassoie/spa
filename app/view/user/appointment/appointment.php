<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Confirmation</th>
			<th>Animal</th>
		</tr>
	</thead>
	<tbody>
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
				<td><?= $value->AnimalsName ?></td>
				
			</tr>
			<?php
		}

		?>
	</tbody>
</table>


<?php
include('../app/view/public/pagination.php');
?>


