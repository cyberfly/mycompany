<!-- TABLE STRIPED -->
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Employee List</h3>
	</div>
	<div class="panel-body">

	    <a class="btn btn-primary" href="<?php echo site_url('employees/create'); ?>" >New Employee</a>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Department Name</th>
					<th>Action</th>
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
					<td>
						
					<a class="btn btn-warning" href="<?php echo site_url('employees/edit/'.$value->employee_id); ?>">Edit</a>

					
					<?php echo form_open('employees/delete'); ?>

					<button type="submit" class="btn btn-danger delete">Delete</button>
					
					<?php echo form_hidden('employee_id',$value->employee_id); ?>
					
					<?php echo form_close(); ?>



					</td>
				</tr>

				<?php } ?>
				
			</tbody>
		</table>
	</div>
</div>
<!-- END TABLE STRIPED -->