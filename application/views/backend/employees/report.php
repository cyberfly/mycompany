<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Employee Report</h3>
	</div>
	<div class="panel-body">

		<!-- start filter row -->
		<div class="row">

		<form id="filter_records" method="GET" action="<?php echo site_url('employees/report'); ?>">
			
		<div class="col-md-4">

			<div class="form-group">
											
				<?php 

				echo form_label('Department', 'department_id');	
				echo form_dropdown('department_id', $department_records, set_value('department_id', $this->input->get('department_id')),'class="form-control"');
				echo form_error('department_id', '<p class="text-danger">', '</p>');
				?>

			</div>
			
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<?php echo form_hidden('filter_type','submit'); ?>

				<button type="button" class="btn btn-primary" id="filter" >Filter</button>
				<button type="button" class="btn btn-warning" id="downloadPDF" >PDF</button>
			</div>
		</div>

		</form>	

		</div> 
		<!-- end of row -->

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
	</div>
</div>
<!-- END TABLE STRIPED