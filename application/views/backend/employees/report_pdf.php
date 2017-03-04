
		<h1>Employee By Departments</h1>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Department Name</th>
				</tr>
			</thead>
			<tbody>
				
				<?php 

				foreach ($records as $key => $value) {
					
				?>

				<tr>
					<td><?php echo $value->employee_id; ?></td>
					<td><?php echo $value->first_name; ?></td>
					<td><?php echo $value->last_name; ?></td>
					<td><?php echo $value->department_name; ?></td>
					
				</tr>

				<?php } ?>
				
			</tbody>
		</table>