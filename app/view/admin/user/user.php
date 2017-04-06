<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Password</th>
			<th>Email</th>
			<th>Rôle</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<a href='/user/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php
		foreach ($a as $key => $value) {
			?>
			<tr>
				<td><?= $value->UsersId ?></td>
				<td><?= $value->UsersName ?></td>
				<td><?= $value->UsersPassword ?></td>
				<td><?= $value->UsersEmail ?></td>
				<td><?= $value->RolesName ?></td>
				<td>
					<a href="/user/update/<?= $value->UsersId ?>" class='btn btn-primary'>Edit</a> 
					<a href="/user/view/delete/<?= $value->UsersId ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
			<?php
		}

		?>

	</tbody>
</table>



